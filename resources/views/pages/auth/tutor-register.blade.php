@extends('layouts.app')

@section('title', $title)

@section('content')
    <!-- Page Title -->
    <div class="page-title position-relative"
         data-aos="fade"
         style="background-image: url({{ asset('assets/img/page-title-bg.webp') }});">
        <div class="container position-relative">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Daftar Tutor</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="section d-flex justify-content-center align-items-center bg-light">
        <x-alert />

        <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px;">
            <h3 class="mb-3 text-center">Formulir Pendaftaran Tutor</h3>
            <form method="POST" action="{{ route('register.tutor') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="grade" class="form-label">Mengajar Tingkat Sekolah</label>
                    <select class="form-select @error('grade') is-invalid @enderror" id="grade" name="grade" required>
                        <option selected disabled>Pilih tingkat</option>
                        <option value="SD" {{ old('grade') === 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('grade') === 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('grade') === 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
                    @error('grade')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Bidang yang Diajarkan</label>
                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                        <option selected disabled>Pilih bidang</option>
                        @foreach(['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS', 'Fisika', 'Kimia', 'Biologi', 'Ekonomi', 'Geografi', 'Sejarah', 'Sosiologi'] as $subject)
                            <option value="{{ $subject }}" {{ old('subject') === $subject ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                    @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="available_days" class="form-label">Hari Mengajar</label>
                    <select class="form-select @error('available_days') is-invalid @enderror"
                            id="available_days" name="available_days[]" multiple required>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                            <option value="{{ $day }}" {{ collect(old('available_days'))->contains($day) ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tekan Ctrl (Cmd di Mac) untuk memilih lebih dari satu hari</small>
                    @error('available_days')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Rumah</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Diri</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Handphone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                           id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Daftar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
