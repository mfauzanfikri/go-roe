@extends('layouts.app')

@section('title', $title)

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Nama</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Nama</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section class="section">

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center">
                            <img src="{{ url('/assets/img/profile.jpg') }}"
                                 alt=""
                                 class="rounded-circle"
                                 style="width: 240px; height: 240px; object-fit: cover;">
                        </div>
                        <div class="col-9">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="m-0 fw-bold">Nama</h2>
                                    <p class="m-0">Mapel</p>
                                </div>
                                <div>
                                    <button class="btn btn-primary">Buat Jadwal Bimbingan</button>
                                </div>
                            </div>
                            <div>
                                <p class="mt-4">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam cumque deleniti eaque, excepturi facilis, ipsam ipsum libero maiores nesciunt nisi obcaecati praesentium quidem rerum sed soluta sunt temporibus veniam vero. Architecto dignissimos excepturi modi natus neque sapiente tenetur vel vitae?
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            @php
                                $fixedTimes = ['08.00 - 10.00', '13.00 - 15.00', '19.00 - 21.00'];

                                $schedule = [
                                    'Senin'  => ['08.00 - 10.00', '13.00 - 15.00', '19.00 - 21.00'],
                                    'Selasa' => ['08.00 - 10.00', '13.00 - 15.00', '19.00 - 21.00'],
                                    'Rabu'   => ['08.00 - 10.00', '13.00 - 15.00', '19.00 - 21.00'],
                                ];
                            @endphp

                            <div class="container my-4">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jadwal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($schedule as $day => $times)
                                        <tr>
                                            <td class="fw-bold">{{ $day }}</td>
                                            <td>
                                                {{-- Pastikan output urut dan 3 waktu wajib tampil --}}
                                                {{ implode('     ', $fixedTimes) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Starter Section Section -->

@endsection
