@extends('layouts.app')

@section('title', $title)

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <x-alert />
        <div class="hero-wrapper">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-delay="100">
                        <h1>Guiding You to Academic Greatness</h1>
                        <p>
                            GoRoe menyediakan layanan bimbingan belajar privat yang berfokus
                            pada kualitas, personalisasi, dan hasil nyata. Kami hadir sebagai
                            mitra pendidikan yang mendampingi siswa dalam setiap langkah
                            menuju prestasi akademik terbaik.
                        </p>
                        <div class="stats-row">
                            <div class="stat-item">
                                <span class="stat-number">3+</span>
                                <span class="stat-label">Program</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">20+</span>
                                <span class="stat-label">Tutor</span>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('orders.new-order') }}" class="btn-primary">Start Your Journey</a>
                        </div>
                    </div>
                    <div class="col-lg-6 hero-media" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{asset('assets/img/home.jpg')}}" alt="Education" class="img-fluid main-image">
                        <div class="image-overlay">
                            <div class="badge-accredited">
                                <i class="bi bi-patch-check-fill"></i>
                                <span>Accredited Excellence</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="upcoming-event" data-aos="fade-up" data-aos-delay="400">
            <div class="container">
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Program Tutor</h3>
                        <h2>“Lebih dari sekadar BIMBEL”
                            Temukan mentor yang tepat untuk masa depanmu!</h2>
                        <p>Kamu akan dipandu oleh tutor yang ngerti caramu belajar, siap membimbing dengan sabar, dan jadi partner untuk capai target akademik dan pengembangan dirimu.</p>

                        <div>
                            <a href="{{ route('tutors.index') }}">
                                <button class="btn btn-primary">Cari Tutor</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-image" data-aos="zoom-in" data-aos-delay="300">
                        <img src="{{asset('assets/img/about.png')}}" alt="Campus" class="img-fluid rounded">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="core-values" data-aos="fade-up" data-aos-delay="500">
                        <h3 class="text-center mb-4">Core Values</h3>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon">
                                        <img src="{{asset('assets/img/sd.jpg')}}" alt="Program" class="img-fluid">
                                    </div>
                                    <h4>Sekolah Dasar (SD)</h4>
                                    <p>Program untuk mendampingi siswa
                                        memahami materi Sekolah Dasar di mata
                                        pelajaran Matematika, Bahasa Indonesia,
                                        dan Bahasa Inggris serta memberikan
                                        dukungan untuk tugas sekolah dan persiapan
                                        ujian.</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon">
                                        <img src="{{asset('assets/img/smp.jpg')}}" alt="Program" class="img-fluid">
                                    </div>
                                    <h4>Sekolah Menengah Pertama (SMP)</h4>
                                    <p>Program untuk mendampingi siswa
                                        memahami materi Sekolah Dasar di mata
                                        pelajaran IPA, IPS, Matematika,
                                        Bahasa Indonesia, dan Bahasa
                                        Inggris serta dukungan untuk tugas sekolah
                                        dan persiapan ujian.</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon">
                                        <img src="{{asset('assets/img/sma.jpg')}}" alt="Program" class="img-fluid">
                                    </div>
                                    <h4>Sekolah Menengah Atas (SMA)</h4>
                                    <p>Program untuk membantu siswa menghadapi
                                        tantangan akademik yang lebih kompleks
                                        serta mempersiapkan diri menuju jenjang
                                        perguruan tinggi. Fokus utama pendalaman
                                        materi Matematika, Peminatan, Bahasa, dan
                                        mata pelajaran yang sesuai jurusan.</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon">
                                        <img src="{{asset('assets/img/snbt.jpg')}}" alt="Program" class="img-fluid">
                                    </div>
                                    <h4>Seleksi Nasional Berdasarkan Tes</h4>
                                    <p>Program privat SNBT dirancangn khusus untuk
                                        persiapan UTBK dalam menghadapi ujian
                                        perguruan tinggi. Fokus untuk optimalkan
                                        pemahaman konsep, strategi pengerjaan soal,
                                        dan manajemen waktu ujian.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tutor Kami</h2>
            <p>Guru kami yang berpengalaman dan latar belakang yang relevan</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="testimonial-slider swiper init-swiper">
                <div class="swiper-wrapper">
                    <script type="application/json" class="swiper-config">
                        {
                          "loop": true,
                          "speed": 600,
                          "autoplay": {
                            "delay": 4000
                          },
                          "slidesPerView": 1,
                          "spaceBetween": 30,
                          "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                          },
                          "breakpoints": {
                            "768": {
                              "slidesPerView": 2
                            },
                            "1200": {
                              "slidesPerView": 3
                            }
                          }
                        }
                    </script>

                    <!-- Testimonial Slide 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="200">
                            <div class="testimonial-header">
                                <img src="assets/img/person/person-f-12.webp"
                                     alt="Client"
                                     class="img-fluid"
                                     loading="lazy">
                            </div>
                            <div class="testimonial-body">
                                <p>Dengan pengalaman lebih dari 5 Tahun mengajar
                                    Matematika, bu Ayu mengutamakan pendekatan
                                    yang komunikatif dan menyenangkan. Ia berfokus
                                    pada peningkatan keterampilan membaca, menulis,
                                    dan memahami teks kompleks</p>
                            </div>
                            <div class="testimonial-footer">
                                <h5>Ayu Wulandari</h5>
                                <span>SD - Bahasa Indonesia</span>
                                <div class="quote-icon">
                                    <i class="bi bi-chat-quote-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Testimonial Slide -->

                    <!-- Testimonial Slide 2 -->
                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="300">
                            <div class="testimonial-header">
                                <img src="assets/img/person/person-m-8.webp"
                                     alt="Client"
                                     class="img-fluid"
                                     loading="lazy">
                            </div>
                            <div class="testimonial-body">
                                <p>Lulusan S2 Matematika yang berpengalaman
                                    membimbing siswa dalam memahami
                                    konsep-konsep abstrak secara logis dan sistematis.
                                    Cocok untuk siswa yang mempersiapkan diri
                                    menghadapi soal HOTS.</p>
                            </div>
                            <div class="testimonial-footer">
                                <h5>Budi Santoso</h5>
                                <span>SMP - Matematika</span>
                                <div class="quote-icon">
                                    <i class="bi bi-chat-quote-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Testimonial Slide -->

                    <!-- Testimonial Slide 3 -->
                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="400">
                            <div class="testimonial-header">
                                <img src="assets/img/person/person-m-3.webp"
                                     alt="Client"
                                     class="img-fluid"
                                     loading="lazy">
                            </div>
                            <div class="testimonial-body">
                                <p>Dikenal dengan cara mengajarnya yang lugas dan
                                    visual, Pak Dimas membantu siswa memahami
                                    Fisika tidak hanya melalui rumus, tetapi juga lewat
                                    aplikasi sehari-hari. Spesialisasi dalam persiapan
                                    UTBK Saintek dan olimpiade sains.</p>
                            </div>
                            <div class="testimonial-footer">
                                <h5>Dimas Pratama</h5>
                                <span>SMA - Fisika</span>
                                <div class="quote-icon">
                                    <i class="bi bi-chat-quote-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Testimonial Slide -->

                </div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->
@endsection
