<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.orders.index', [
            'title' => 'History Pesanan',
        ]);
    }

    public function newOrder(Request $request)
    {
        return view('pages.orders.new-order', [
            'title' => 'Pesanan Baru',
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
        } catch (\Exception $e) {
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
            ->whereNotIn('id', $occupiedTutorIds)
            ->with('user:id,name') // untuk ambil nama dari tabel users
            ->get()
            ->map(function ($tutor) {
                return [
                    'id' => $tutor->id,
                    'name' => $tutor->user->name,
                    'subject' => $tutor->subject,
                ];
            });

        return response()->json($tutors);
    }
}
