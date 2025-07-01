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
            <div class="row mb-4 justify-content-center">
                <div class="col-2 px-1">
                    <input class="form-control" type="date" name="date" id="date">
                </div>
                <div class="col-1 px-1">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </div>

            @for($i = 0; $i < 10; $i++)
                <div class="row">
                    <div class="col-12">
                        <x-order-card
                            subject="Bahasa Inggris"
                            date="Senin, 8 Juli 2025"
                            time="08.00 - 10.00"
                            tutor="Tutor A"
                            student="Siswa X"
                            status="learning"
                        />
                    </div>
                </div>
            @endfor
        </div>
    </section><!-- /Starter Section Section -->
@endsection
