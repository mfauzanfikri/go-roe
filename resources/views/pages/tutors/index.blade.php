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
        </div><!-- End Section Title -->

        <div class="container">
            <form method="GET" action="{{ route('tutors.index') }}">
                <div class="row mb-4 justify-content-center">
                    <div class="col-3 px-1">
                        <input type="text" class="form-control" name="search" placeholder="Search tutor..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-2 px-1">
                        <select class="form-select" name="subject">
                            <option value="">All Subjects</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject }}" {{ request('subject') == $subject ? 'selected' : '' }}>
                                    {{ $subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1 px-1">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <div class="row justify-content-center gap-2" style="margin-top: 2.5rem">
                @forelse($tutors as $tutor)
                    <div class="col-3 card">
                        <div class="card-body px-1">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <img src="{{ url('/assets/img/profile.jpg') }}"
                                         alt=""
                                         class="rounded-circle"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p class="m-0 fw-bold">{{ $tutor->user->name }}</p>
                                            <p class="m-0">{{ $tutor->grade }} - {{ $tutor->subject }}</p>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <p class="m-0 text-muted" style="font-size: 0.9rem">
                                                {{ Str::limit($tutor->description, 150) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 mb-2 d-flex justify-content-center">
                                    <a href="{{ route('orders.new-order') }}"
                                       class="btn btn-primary btn-sm">Bimbingan Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada tutor ditemukan.</p>
                @endforelse
            </div>
        </div>

    </section><!-- /Starter Section Section -->

@endsection
