@extends('layouts.app')

@section('title', $title)

@section('content')
    <!-- Page Title -->
    <div class="page-title position-relative"
         data-aos="fade"
         style="background-image: url({{ asset('assets/img/page-title-bg.webp') }});">
        <div class="container position-relative">
            <h1>History <br></h1>
            <p>Riwayat Pemesanan</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">History</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section class="section">
        <div class="container">
            {{-- <div class="row mb-4 justify-content-center"> --}}
            {{--     <div class="col-2 px-1"> --}}
            {{--         <input class="form-control" type="date" name="date" id="date"> --}}
            {{--     </div> --}}
            {{--     <div class="col-1 px-1"> --}}
            {{--         <button class="btn btn-primary">Filter</button> --}}
            {{--     </div> --}}
            {{-- </div> --}}

            @foreach($orders as $order)
                <div class="row">
                    <div class="col-12">
                        <x-order-card
                            :subject="$order->subject"
                            :date="\Carbon\Carbon::parse($order->date)->isoFormat('dddd, D MMMM Y')"
                            :time="$order->time"
                            :tutor="$order->tutor->name ?? '-'"
                            :student="$order->student->name ?? '-'"
                            :status="$order->status"
                            :orderId="$order->id"
                            :userRole="auth()->user()->role"
                            :payment="$order->payment"
                        />
                    </div>
                </div>
            @endforeach

        </div>
    </section><!-- /Starter Section Section -->
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        function payFee(orderId) {
            fetch(`/orders/${orderId}/fee-token`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                }
            })
              .then(res => res.json())
              .then(data => {
                  if (data.snap_token) {
                      snap.pay(data.snap_token, {
                          onSuccess: function(result) {
                              // Setelah berhasil, update status ke paid
                              fetch(`/orders/${orderId}/fee-callback`, {
                                  method: 'POST',
                                  headers: {
                                      'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                      'Content-Type': 'application/json'
                                  }
                              })
                                .then(r => r.json())
                                .then(resp => {
                                    if (resp.success) {
                                        location.reload();
                                    }
                                });
                          },
                          onError: function(err) {
                              alert('Pembayaran gagal.');
                              console.error(err);
                          }
                      });
                  } else {
                      alert('Gagal mendapatkan token pembayaran fee.');
                  }
              });
        }
    </script>
@endpush
