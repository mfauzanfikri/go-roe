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
                    <li class="current">Login</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="section d-flex justify-content-center align-items-center bg-light">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="mb-3 text-center">Login</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        required
                        autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        required>
                </div>
                <small class="mb-2">Belum terdaftar? <a href="{{ route('register') }}">Daftar sekarang</a></small>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </section>

@endsection
