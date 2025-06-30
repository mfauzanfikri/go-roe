@extends('layouts.app')

@section('title', $title)

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Our Tutors</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Our Tutors</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section class="section">

        <!-- Section Title -->
        <div class="container section-title">
            <h2>Our Tutors</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row mb-4 justify-content-center">
                <div class="col-3 px-1">
                    <input type="text" class="form-control" id="search" placeholder="Search tutor...">
                </div>
                <div class="col-2 px-1">
                    <select class="form-select">
                        <option selected>Subject</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-1 px-1">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </div>

            <div class="row justify-content-center gap-2" style="margin-top: 2.5rem">
                @for($i = 0; $i < 10; $i++)
                    <div class="col-3 card">
                        <div class="card-body px-1">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <div>
                                        <img src="{{ url('/assets/img/profile.jpg') }}"
                                             alt=""
                                             class="rounded-circle"
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p class="m-0 fw-bold">Nama</p>
                                            <p class="m-0">Program - Mapel</p>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <p class="m-0">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse natus optio perferendis praesentium provident repellendus sit tempore ullam ut! Amet deserunt, est nostrum optio quaerat quasi quos ullam velit veritatis?
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 mb-2 d-flex justify-content-center">
                                    <button class="btn btn-primary">Bimbingan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

    </section><!-- /Starter Section Section -->

@endsection
