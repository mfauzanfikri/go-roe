<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Tutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use function auth;
use function dd;
use function sscanf;
use function ucfirst;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $orders = Order::with(['student', 'tutor', 'payment'])
            ->when($user->role === 'tutor', fn($q) => $q->where('tutor_id', $user->id))
            ->when($user->role === 'student', fn($q) => $q->where('student_id', $user->id))
            ->latest()
            ->get();

        return view('pages.orders.index', [
            'title' => 'History Pesanan',
            'orders' => $orders,
        ]);
    }

    public function newOrder(Request $request)
    {
        $subjects = Tutor::select('subject')->distinct()->pluck('subject');

        return view('pages.orders.new-order', [
            'title' => 'Pesanan Baru',
            'subjects' => $subjects,
        ]);
    }

    public function getMidtransToken(Request $request)
    {
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = env('MIDTRANS_ORDER_ID_PREFIX', 'ORDER-') . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 100000, // fixed price for now
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name ?? 'Guest',
                'email' => auth()->user()->email ?? 'guest@example.com',
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to create Snap token'], 500);
        }
    }

    public function getAvailableTutors(Request $request)
    {
        $request->validate([
            'grade' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $day = Carbon::parse($request->date)->locale('id')->dayName;

        $occupiedTutorIds = Order::where('date', $request->date)
            ->where('time', $request->time)
            ->pluck('tutor_id')
            ->toArray();

        $tutors = Tutor::where('grade', $request->grade)
            ->where('subject', $request->subject)
            ->whereJsonContains('available_days', ucfirst($day)) // e.g., "Senin"
            // ->whereNotIn('id', $occupiedTutorIds)
            ->with('user:id,name') // untuk ambil nama dari tabel users
            ->get()
            ->map(function($tutor) {
                return [
                    'id' => $tutor->id,
                    'name' => $tutor->user->name,
                    'subject' => $tutor->subject,
                ];
            });

        return response()->json($tutors);
    }

    public function processCod(Request $request)
    {
        $request->validate([
            'grade' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'tutor' => 'required|exists:users,id',
            'payment' => 'in:cod',
        ]);

        $studentId = auth()->user()->id;
        $tutorId = $request->tutor;
        $fee = 100000; // biaya tetap
        $feePercentage = 0.05;
        $systemFee = $fee * $feePercentage;

        $order = Order::create([
            'student_id' => $studentId,
            'tutor_id' => $tutorId,
            'program' => $request->grade,
            'subject' => $request->subject,
            'date' => $request->date,
            'time' => $request->time,
            'day' => Carbon::parse($request->date)->format('l'),
            'status' => 'order',
        ]);

        // Simpan pembayaran untuk fee COD
        Payment::create([
            'order_id' => $order->id,
            'method' => 'cod',
            'amount' => $fee,
            'status' => 'success',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan COD berhasil dibuat.',
            'redirect' => route('orders.index'),
        ]);
    }

    public function processMidtrans(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'transaction_status' => 'required|in:settlement,capture',
            'payment_type' => 'required',
            'gross_amount' => 'required|numeric',
            'transaction_id' => 'required',
            'snap_token' => 'nullable',
        ]);

        $order = Order::findOrFail($request->order_id);
        $tutor = $order->tutor;

        $amount = (int)$request->gross_amount;
        $systemFee = $amount * 0.05;
        $netAmount = $amount - $systemFee;

        // Update order dan pembayaran
        $order->update(['status' => 'paid']);

        $order->payment()->create([
            'method' => 'system',
            'amount' => $amount,
            'status' => 'paid',
            'transaction_id' => $request->transaction_id,
            'snap_token' => $request->snap_token,
            'transaction_status' => $request->transaction_status,
            'fraud_status' => $request->fraud_status ?? null,
            'paid_at' => now(),
        ]);

        // Tambah saldo tutor setelah dikurangi fee
        $tutor->increment('balance', $netAmount);

        return response()->json(['success' => true]);
    }

    public function payFee(Order $order)
    {
        // Cek jika user adalah tutor dan dia yang bersangkutan
        if(auth()->user()->id !== $order->tutor_id) abort(403);

        // Hitung fee (5%)
        $fee = $order->total_amount * 0.05;

        // Generate Snap Token Midtrans
        $snapToken = Midtrans::createSnapToken([
            'transaction_details' => [
                'order_id' => 'FEE-' . $order->id . '-' . uniqid(),
                'gross_amount' => $fee,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'callbacks' => [
                'finish' => route('orders.fee-callback', $order->id),
            ]
        ]);

        return redirect()->back()->with('snap_token', $snapToken);
    }

    public function start(Order $order)
    {
        if(auth()->user()->id !== $order->tutor_id) abort(403);
        $order->update(['status' => 'learning']);
        return back();
    }

    public function complete(Order $order)
    {
        if(auth()->user()->id !== $order->tutor_id) abort(403);
        $order->update(['status' => 'completed']);
        return back();
    }

    public function getFeeSnapToken(Order $order)
    {
        if(auth()->user()->id !== $order->tutor_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $fee = $order->total_amount * 0.05;

        $params = [
            'transaction_details' => [
                'order_id' => 'FEE-' . $order->id . '-' . uniqid(),
                'gross_amount' => $fee,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function feeCallback(Request $request, Order $order)
    {
        if(auth()->user()->id !== $order->tutor_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Anggap berhasil (di real-world: seharusnya dari webhook)
        $order->update(['status' => 'paid']);

        return response()->json(['success' => true]);
    }
}
