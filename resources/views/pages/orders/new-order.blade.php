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
                        <label for="grade" class="form-label">Program</label>
                        <select class="form-select" id="grade" required>
                            <option selected disabled>Pilih Program</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="subject" name="subject" required>
                            <option selected disabled>Pilih Mata Pelajaran</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input class="form-control" type="date" name="date" id="date">
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label">Waktu</label>
                        <select class="form-select" id="time" required>
                            <option selected disabled>Pilih Waktu</option>
                            <option value="08.00 - 10.00">08.00 - 10.00</option>
                            <option value="13.00 - 15.00">13.00 - 15.00</option>
                            <option value="19.00 - 21.00">19.00 - 21.00</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tutor" class="form-label">Tutor</label>
                        <select class="form-select" id="tutor" required disabled>
                            <option selected disabled>Pilih Tutor</option>
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
                        <li class="list-group-item">Program: <strong id="cf-grade"></strong></li>
                        <li class="list-group-item">Mata Pelajaran: <strong id="cf-subject"></strong></li>
                        <li class="list-group-item">Tanggal: <strong id="cf-date"></strong></li>
                        <li class="list-group-item">Tutor: <strong id="cf-tutor"></strong></li>
                        <li class="list-group-item">Waktu: <strong id="cf-time"></strong></li>
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>


    <script>
        const step1Fields = ['grade', 'subject', 'date', 'tutor', 'time'];
        const step1NextBtn = document.getElementById('step1-next');

        // Tambahkan listener ke semua field
        step1Fields.forEach(id => {
            document.getElementById(id).addEventListener('change', validateStep1);
        });

        function validateStep1() {
            let valid = true;

            for (const id of step1Fields) {
                const val = document.getElementById(id).value;
                if (!val || val === 'Pilih Program' || val === 'Pilih Mata Pelajaran' || val === 'Pilih Tanggal' || val === 'Pilih Tutor' || val === 'Pilih Waktu') {
                    valid = false;
                    break;
                }
            }

            step1NextBtn.disabled = !valid;
        }

        function nextStep(step) {
            // Tidak perlu validasi ulang karena tombol hanya aktif jika semua valid
            if (step === 1) {
                document.getElementById('cf-grade').innerText = document.getElementById('grade').value;
                document.getElementById('cf-subject').innerText = document.getElementById('subject').value;
                document.getElementById('cf-date').innerText = document.getElementById('date').value;
                document.getElementById('cf-tutor').innerText = document.getElementById('tutor').value;
                document.getElementById('cf-time').innerText = document.getElementById('time').value;
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

        function getDayName(dateStr) {
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const dateObj = new Date(dateStr);
            return days[dateObj.getDay()];
        }

        const tutorSelect = document.getElementById('tutor');
        const fields = ['grade', 'subject', 'date', 'time'];

        // Dengarkan perubahan di setiap field penting
        fields.forEach(id => {
            document.getElementById(id).addEventListener('change', handleFieldChange);
        });

        function handleFieldChange() {
            const grade = document.getElementById('grade').value;
            const subject = document.getElementById('subject').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;

            const isValid = grade && subject && date && time;

            // Reset dulu select tutor
            tutorSelect.innerHTML = `<option selected disabled>Pilih Tutor</option>`;
            tutorSelect.disabled = true;

            if (!isValid) {
                validateStep1();
                return;
            }

            // Jika semua field sudah terisi, baru fetch tutor
            tutorSelect.innerHTML = `<option selected disabled>Loading tutor...</option>`;

            fetch("{{ route('api.available-tutors') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ grade, subject, date, time })
            })
                .then(res => res.json())
                .then(data => {
                    tutorSelect.innerHTML = '';

                    if (data.length === 0) {
                        tutorSelect.innerHTML = `<option selected disabled>Tidak ada tutor tersedia</option>`;
                        alert('Tidak ada tutor yang tersedia untuk jadwal tersebut.');
                    } else {
                        tutorSelect.innerHTML = `<option selected disabled>Pilih Tutor</option>`;
                        data.forEach(tutor => {
                            const option = document.createElement('option');
                            option.value = tutor.id;
                            option.textContent = `${tutor.name} - ${tutor.subject}`;
                            tutorSelect.appendChild(option);
                        });
                        tutorSelect.disabled = false;
                    }

                    validateStep1();
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal mengambil data tutor.');
                    tutorSelect.innerHTML = `<option selected disabled>Pilih Tutor</option>`;
                });
        }

        function triggerPayment() {
            fetch("{{ route('midtrans.token') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    grade: document.getElementById('grade').value,
                    subject: document.getElementById('subject').value,
                    date: document.getElementById('date').value,
                    tutor: document.getElementById('tutor').value,
                    time: document.getElementById('time').value
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.snap_token) {
                        snap.pay(data.snap_token);
                    } else {
                        alert('Token pembayaran tidak tersedia.');
                    }
                })
                .catch(err => {
                    alert('Gagal memproses pembayaran.');
                    console.error(err);
                });
        }
    </script>
@endpush
