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
                    <li class="current">Daftar</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="section d-flex justify-content-center align-items-center bg-light">
        <x-alert />

        <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px;">
            <h3 class="mb-3 text-center">Formulir Pendaftaran</h3>
            <form method="POST" action="{{ route('register') }}">
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
                    <label for="grade" class="form-label">Tingkat Sekolah</label>
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
                    <label for="address" class="form-label">Alamat Rumah</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
                    @error('address')
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

                <div class="mb-2">
                    <a href="{{ route('register.tutor') }}" style="font-size: 12px">Daftar sebagai tutor</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Daftar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
