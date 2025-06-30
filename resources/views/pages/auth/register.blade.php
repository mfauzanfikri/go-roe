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
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="grade" class="form-label">Tingkat Sekolah</label>
                    <select class="form-select" id="grade" name="grade" required>
                        <option selected disabled>Pilih tingkat</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Rumah</label>
                    <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Handphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
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
