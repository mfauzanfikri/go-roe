@extends('layouts.app')

@section('title', $title)

@section('content')
    <!-- Page Title -->
    <div class="page-title position-relative"
         data-aos="fade"
         style="background-image: url({{ asset('assets/img/page-title-bg.webp') }});">
        <div class="container position-relative">
            <h1>Starter Page <br></h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Starter Page</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section class="section">

        <!-- Section Title -->
        <div class="container section-title">
            <h2>Starter Section</h2>
            <p>Starter Section<br></p>
        </div><!-- End Section Title -->

        <div class="container">
            <p>Use this page as a starter for your own custom pages.</p>
        </div>

    </section><!-- /Starter Section Section -->
@endsection
