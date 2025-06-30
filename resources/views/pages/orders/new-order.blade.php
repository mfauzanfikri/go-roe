@extends('layouts.app')

@section('title', $title)

@push('styles')
    <style>
        .step-indicator {
            flex: 1;
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            background-color: #e9ecef;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .step-indicator.active {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title position-relative"
         data-aos="fade"
         style="background-image: url({{ asset('assets/img/page-title-bg.webp') }});">
        <div class="container position-relative">
            <h1>Pesan Bimbingan <br></h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Pesan Bimbingan</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section class="section">
        <div class="container" id="progressive-form">
            <div class="card shadow-sm p-4" style="max-width: 600px; margin: auto;">
                {{-- Step Indicator --}}
                <div class="mb-4 text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="step-indicator active" id="indicator-1">1. Pilih Program</div>
                        <div class="step-indicator" id="indicator-2">2. Konfirmasi</div>
                        <div class="step-indicator" id="indicator-3">3. Pembayaran</div>
                    </div>
                </div>

                {{-- Step 1 --}}
                <div id="step-1">
                    <h4 class="mb-3">Pilih Program</h4>
                    <div class="mb-3">
                        <label for="program" class="form-label">Program</label>
                        <select class="form-select" id="program" required>
                            <option selected disabled>Pilih Program</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="subject" required>
                            <option selected disabled>Pilih Mata Pelajaran</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select class="form-select" id="hari" required>
                            <option selected disabled>Pilih Hari</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tutor" class="form-label">Tutor</label>
                        <select class="form-select" id="tutor" required>
                            <option selected disabled>Pilih Tutor</option>
                            <option value="Tutor A">Tutor A</option>
                            <option value="Tutor B">Tutor B</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <select class="form-select" id="waktu" required>
                            <option selected disabled>Pilih Waktu</option>
                            <option value="08.00 - 10.00">08.00 - 10.00</option>
                            <option value="13.00 - 15.00">13.00 - 15.00</option>
                            <option value="19.00 - 21.00">19.00 - 21.00</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button"
                                class="btn btn-primary"
                                id="step1-next"
                                onclick="nextStep(1)"
                                disabled>Selanjutnya
                        </button>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div id="step-2" class="d-none">
                    <h4 class="mb-3">Konfirmasi Pilihan Anda</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">Program: <strong id="cf-program"></strong></li>
                        <li class="list-group-item">Mata Pelajaran: <strong id="cf-subject"></strong></li>
                        <li class="list-group-item">Hari: <strong id="cf-hari"></strong></li>
                        <li class="list-group-item">Tutor: <strong id="cf-tutor"></strong></li>
                        <li class="list-group-item">Waktu: <strong id="cf-waktu"></strong></li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Kembali</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Selanjutnya</button>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div id="step-3" class="d-none">
                    <h4 class="mb-3">Pembayaran</h4>
                    <p>Biaya Les: <strong>Rp100.000</strong></p>
                    <p>Metode pembayaran akan diproses melalui Midtrans.</p>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Kembali</button>
                        <button type="button" class="btn btn-success" onclick="triggerPayment()">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Starter Section Section -->
@endsection

@push('scripts')
    {{-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script> --}}

    <script>
        const step1Fields = ['program', 'subject', 'hari', 'tutor', 'waktu'];
        const step1NextBtn = document.getElementById('step1-next');

        // Tambahkan listener ke semua field
        step1Fields.forEach(id => {
            document.getElementById(id).addEventListener('change', validateStep1);
        });

        function validateStep1() {
            let valid = true;

            for (const id of step1Fields) {
                const val = document.getElementById(id).value;
                if (!val || val === 'Pilih Program' || val === 'Pilih Mata Pelajaran' || val === 'Pilih Hari' || val === 'Pilih Tutor' || val === 'Pilih Waktu') {
                    valid = false;
                    break;
                }
            }

            step1NextBtn.disabled = !valid;
        }

        function nextStep(step) {
            // Tidak perlu validasi ulang karena tombol hanya aktif jika semua valid
            if (step === 1) {
                document.getElementById('cf-program').innerText = document.getElementById('program').value;
                document.getElementById('cf-subject').innerText = document.getElementById('subject').value;
                document.getElementById('cf-hari').innerText = document.getElementById('hari').value;
                document.getElementById('cf-tutor').innerText = document.getElementById('tutor').value;
                document.getElementById('cf-waktu').innerText = document.getElementById('waktu').value;
            }

            document.getElementById(`step-${step}`).classList.add('d-none');
            document.getElementById(`step-${step + 1}`).classList.remove('d-none');

            updateStepIndicator(step + 1);
        }

        function prevStep(step) {
            document.getElementById(`step-${step}`).classList.add('d-none');
            document.getElementById(`step-${step - 1}`).classList.remove('d-none');

            updateStepIndicator(step - 1);
        }

        function updateStepIndicator(step) {
            for (let i = 1; i <= 3; i++) {
                document.getElementById(`indicator-${i}`).classList.remove('active');
            }
            document.getElementById(`indicator-${step}`).classList.add('active');
        }

        {{--function triggerPayment() {--}}
        {{--    fetch("{{ route('midtrans.token') }}", {--}}
        {{--        method: 'POST',--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': "{{ csrf_token() }}",--}}
        {{--            'Content-Type': 'application/json'--}}
        {{--        },--}}
        {{--        body: JSON.stringify({--}}
        {{--            program: document.getElementById('program').value,--}}
        {{--            subject: document.getElementById('subject').value,--}}
        {{--            hari: document.getElementById('hari').value,--}}
        {{--            tutor: document.getElementById('tutor').value,--}}
        {{--            waktu: document.getElementById('waktu').value--}}
        {{--        })--}}
        {{--    })--}}
        {{--        .then(res => res.json())--}}
        {{--        .then(data => {--}}
        {{--            if (data.snap_token) {--}}
        {{--                snap.pay(data.snap_token);--}}
        {{--            } else {--}}
        {{--                alert('Token pembayaran tidak tersedia.');--}}
        {{--            }--}}
        {{--        })--}}
        {{--        .catch(err => {--}}
        {{--            alert('Gagal memproses pembayaran.');--}}
        {{--            console.error(err);--}}
        {{--        });--}}
        {{--}--}}
    </script>
@endpush
