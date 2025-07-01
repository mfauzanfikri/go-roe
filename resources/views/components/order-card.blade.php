<div class="card shadow-sm mb-4">
    <div class="card-body">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h5 class="mb-1">{{ $subject }} - {{ $date }}</h5>
                <p class="mb-1 text-muted">Tutor: {{ $tutor }}</p>
                <p class="mb-1 text-muted">Murid: {{ $student }}</p>
                <p class="mb-0"><strong>Waktu:</strong> {{ $time }}</p>
            </div>
            <div class="text-end">
                @if($status === 'order')
                    <span class="badge bg-secondary">Menunggu Pembayaran</span>
                @elseif($status === 'paid')
                    <span class="badge bg-primary">Menunggu Tutor</span>
                @elseif($status === 'fee_paid')
                    <span class="badge bg-primary">Siap Belajar</span>
                @elseif($status === 'learning')
                    <span class="badge bg-warning text-dark">Sedang Belajar</span>
                @elseif($status === 'completed')
                    <span class="badge bg-success">Selesai</span>
                @endif
            </div>
        </div>

        {{-- Action Button --}}
        @if(in_array($status, ['order', 'paid', 'learning']))
            <div class="text-end">
                @switch($status)
                    @case('order')
                        <button class="btn btn-sm btn-success">Terima</button>
                        @break

                    @case('fee_paid')
                        <button class="btn btn-sm btn-primary">Bayar</button>
                        @break

                    @case('learning')
                        <button class="btn btn-sm btn-success">Selesaikan</button>
                        @break
                @endswitch
            </div>
        @endif
    </div>
</div>
