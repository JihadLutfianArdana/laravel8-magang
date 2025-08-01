<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAGANG | {{ $title }}</title>
    <link rel="icon" href="{{ asset('img/logo_prov3.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px;
            /* Menyesuaikan tinggi navbar */
            padding-bottom: 50px;
            background: linear-gradient(to bottom, #dee2e6, #ced4da);
        }

        .navbar-maroon {
            background-color: #800000;
            z-index: 9999;
        }

        .navbar-maroon .nav-link,
        .navbar-maroon .navbar-brand,
        .navbar-maroon .form-control {
            color: #fff;
        }

        .navbar-maroon .nav-link:hover,
        .navbar-maroon .nav-link:focus {
            color: yellow;
            transition: color 0.3s ease-in-out;
        }

        .brand-text {
            font-size: 1.75rem;
            color: white;
        }

        .navbar-logo {
            margin-left: 0;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-link {
            font-size: 20px;
        }

        .search-form {
            margin-left: auto;
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('{{ asset('img/bapelkes2.jpg') }}') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-text {
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px 40px;
            font-size: 2rem;
            font-weight: bold;
            border-radius: 10px;
        }

        /* Layanan Section */
        .layanan-section {
            padding: 60px 20px;
            text-align: center;
        }

        .layanan-section h2 {
            font-weight: bold;
            margin-bottom: 40px;
        }

        .footer {
            background-color: grey;
            color: white;
            padding: 30px 20px;
        }

        .footer h5 {
            font-weight: bold;
        }

        .text-maroon {
            color: #800000;
        }

        .card-body {
            background: linear-gradient(to right, #fdfbfb, #ebedee);
            padding: 25px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-text li {
            margin-bottom: 10px;
        }

        .shadow-lg {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .bg-maroon {
            background-color: #800000 !important;
        }

        .badge {
            font-size: 1rem;
            padding: 0.6em 1em;
        }

        .card-body ul li::marker {
            color: #800000;
        }

        iframe {
            border: none;
            width: 100%;
            height: 250px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    {{-- <nav class="navbar navbar-expand-lg navbar-maroon position-relative"> --}}
    <nav class="navbar navbar-expand-lg navbar-maroon fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center navbar-logo" href="#">
                <img src="{{ asset('img/logo_prov3.png') }}" alt="Logo" width="40">
                <h1 class="fw-bold mb-0 ms-2 brand-text">BALAI PELATIHAN KESEHATAN</h1>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center navbar-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tentang-kami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/program-magang">Program Magang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/beranda-magang">Masuk</a>
                    </li>
                </ul>
            </div>

            <form class="d-flex search-form" role="search">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Cari" aria-label="Search">
                <button class="btn btn-light btn-sm" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </nav>

    <!-- Konten Baru: Program Magang di Bapelkes -->
    <div class="container mt-4">
        <!-- Section: Program Magang -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded d-flex flex-column flex-md-row align-items-center">
                <div class="me-md-4 mb-3 mb-md-0" style="flex: 1;">
                    <img src="{{ asset('img/bapelkes7.jpg') }}" class="img-fluid rounded shadow" alt="Program Magang"
                        style="object-fit: cover; width: 100%; max-height: 300px;">
                </div>
                <div style="flex: 2;">
                    <h5 class="card-title text-maroon">
                        <i class="bi bi-briefcase-fill me-2"></i>Program Magang di Bapelkes Provinsi Kalsel
                    </h5>
                    <p class="card-text fs-5">
                        Program magang di Bapelkes merupakan kegiatan pembelajaran berbasis praktik bagi pelajar dan
                        mahasiswa
                        dalam rangka meningkatkan pemahaman dan keterampilan di bidang kesehatan serta pengelolaan
                        pelatihan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section: Persyaratan Magang -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded">
                <h5 class="card-title text-maroon">
                    <i class="bi bi-list-check me-2"></i>Persyaratan Menjadi Peserta Magang
                </h5>
                <ul class="fs-5 card-text">
                    <li>Peserta magang harus berasal dari SMA, SMK, atau sederajat.</li>
                    <li>Peserta magang juga bisa berasal dari mahasiswa yang sedang menempuh pendidikan di perguruan
                        tinggi.</li>
                    <li>Diutamakan pelajar/mahasiswa yang jurusannya berkaitan dengan kesehatan dan komputer.</li>
                    <li>Memiliki surat permohonan resmi dari sekolah/universitas.</li>
                    <li>Bersedia mematuhi peraturan dan jadwal Bapelkes selama masa magang.</li>
                </ul>
            </div>
        </div>

        <!-- Section: Langkah-langkah Pendaftaran -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded">
                <h5 class="card-title text-maroon">
                    <i class="bi bi-map-fill me-2"></i>Langkah-langkah Pendaftaran Magang
                </h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded shadow h-100">
                            <span class="badge bg-maroon fs-6 mb-2">1</span>
                            <h6 class="fw-bold">Cek Persyaratan</h6>
                            <p class="mb-0">Pastikan anda sudah memenuhi persyaratan yang diberikan.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded shadow h-100">
                            <span class="badge bg-maroon fs-6 mb-2">2</span>
                            <h6 class="fw-bold">Website Magang</h6>
                            <p class="mb-0">Kunjungi website resmi magang dan isi formulir pendaftaran dengan
                                data
                                lengkap.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded shadow h-100">
                            <span class="badge bg-maroon fs-6 mb-2">3</span>
                            <h6 class="fw-bold">Tunggu Verifikasi</h6>
                            <p class="mb-0">Tim Bapelkes akan meninjau berkas Anda dan mengirimkan konfirmasi melalui
                                pesan WhatsApp.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded shadow h-100">
                            <span class="badge bg-maroon fs-6 mb-2">4</span>
                            <h6 class="fw-bold">Wawancara (Jika Diperlukan)</h6>
                            <p class="mb-0">Beberapa peserta mungkin akan dihubungi untuk sesi wawancara singkat.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded shadow h-100">
                            <span class="badge bg-maroon fs-6 mb-2">5</span>
                            <h6 class="fw-bold">Mulai Magang</h6>
                            <p class="mb-0">Jika diterima, peserta akan mengikuti orientasi sebelum resmi menjalani
                                magang.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-5" data-aos="fade-up">
                        <a href="/pendaftaran-peserta" class="btn btn-lg text-white mt-4 px-4 py-2"
                            style="background: linear-gradient(135deg, #800000, #b22222); border-radius: 50px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); transition: transform 0.2s;">
                            <i class="bi bi-pencil-square me-2"></i> DAFTAR MAGANG
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const textElement = document.getElementById('animated-text');
            const fullText = textElement.textContent.trim();
            const words = fullText.split(' ');
            let currentWordIndex = 0;
            let displayedWords = [];

            function showNextWord() {
                if (currentWordIndex < words.length) {
                    displayedWords.push(words[currentWordIndex]);
                    textElement.textContent = displayedWords.join(' ');
                    currentWordIndex++;
                } else {
                    // Setelah selesai tampil semua kata, tunggu 1.5 detik lalu reset
                    setTimeout(() => {
                        displayedWords = [];
                        currentWordIndex = 0;
                        textElement.textContent = '';
                    }, 1500);
                }
            }

            // Jalankan fungsi showNextWord setiap 500 ms
            setInterval(showNextWord, 500);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi 1 detik
            once: true // animasi hanya sekali saat scroll ke elemen
        });
    </script>

</body>

</html>
