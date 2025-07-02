@props(['subject', 'date', 'time', 'tutor', 'student', 'status', 'orderId', 'userRole', 'payment'])

@php
    use Carbon\Carbon;

    $now = Carbon::now();
    $sessionDate = Carbon::parse($date);
    $isToday = $now->isSameDay($sessionDate);

    // Parse time range (misal: "13.00 - 15.00")
    [$startTimeStr, $endTimeStr] = explode(' - ', $time);
    $startTime = Carbon::parse($date . ' ' . str_replace('.', ':', $startTimeStr));
    $endTime = Carbon::parse($date . ' ' . str_replace('.', ':', $endTimeStr));

    $canStart = $isToday && $now->between($startTime, $endTime);
    $canComplete = $isToday && $now->gt($endTime);
@endphp

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h5 class="mb-1">{{ $subject }} - {{ $date }}</h5>
                <p class="mb-1 text-muted">Tutor: {{ $tutor }}</p>
                <p class="mb-1 text-muted">Murid: {{ $student }}</p>
                <p class="mb-0"><strong>Waktu:</strong> {{ $time }}</p>
            </div>
            <div class="text-end">
                @switch($status)
                    @case('order')
                        <span class="badge bg-secondary">Menunggu Pembayaran</span>
                        @break
                    @case('paid')
                        <span class="badge bg-primary">Menunggu Tutor</span>
                        @break
                    @case('fee_paid')
                        <span class="badge bg-primary">Siap Belajar</span>
                        @break
                    @case('learning')
                        <span class="badge bg-warning text-dark">Sedang Belajar</span>
                        @break
                    @case('completed')
                        <span class="badge bg-success">Selesai</span>
                        @break
                @endswitch
            </div>
        </div>

        {{-- Action hanya tutor yang bisa --}}
        <div class="text-end">
            @switch($status)

                {{-- Tutor harus bayar fee jika COD --}}
                @case('paid')
                    @if($userRole === 'tutor' && $payment->method === 'cod')
                        <button class="btn btn-sm btn-primary" onclick="payFee({{ $orderId }})">Bayar Fee</button>
                    @endif
                    @break

                    {{-- Tutor hanya bisa mulai jika fee sudah dibayar --}}
                @case('fee_paid')
                    @if($userRole === 'tutor')
                        @if($canStart)
                            <form action="{{ route('orders.start', $orderId) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Mulai</button>
                            </form>
                        @else
                            <span class="text-muted small">Belum waktunya memulai sesi.</span>
                        @endif
                    @endif
                    @break

                    {{-- Student bisa selesaikan jika waktu sudah selesai --}}
                @case('learning')
                    @if($userRole === 'student')
                        @if($canComplete)
                            <form action="{{ route('orders.complete', $orderId) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Selesaikan</button>
                            </form>
                        @else
                            <span class="text-muted small">Sesi belum selesai.</span>
                        @endif
                    @endif
                    @break

            @endswitch
        </div>
    </div>
</div>
