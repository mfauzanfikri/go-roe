@props(['subject', 'date', 'time', 'tutor', 'student', 'status', 'orderId', 'userRole', 'payment'])

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
        @if($userRole === 'tutor')
            <div class="text-end">
                @switch($status)
                    @case('paid')
                        @if($payment->method === 'cod')
                            <button class="btn btn-sm btn-primary" onclick="payFee({{ $orderId }})">Bayar Fee</button>
                        @else
                            <form action="{{ route('orders.start', $orderId) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Mulai</button>
                            </form>
                        @endif
                        @break

                    @case('fee_paid')
                        <form action="{{ route('orders.start', $orderId) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Mulai</button>
                        </form>
                        @break

                    @case('learning')
                        <form action="{{ route('orders.complete', $orderId) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Selesaikan</button>
                        </form>
                        @break
                @endswitch
            </div>
        @endif
    </div>
</div>
