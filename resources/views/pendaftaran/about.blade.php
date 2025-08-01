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

    <div class="container mt-4">
        <!-- Card 1: Gambar dan penjelasan -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded">
                <h5 class="card-title text-maroon">
                    <i class="bi bi-building me-2"></i>Tentang Bapelkes
                </h5>
                <img src="{{ asset('img/bapelkes5.jpg') }}" class="img-fluid rounded mb-3" alt="Bapelkes"
                    style="max-height: 300px; object-fit: cover; width: 100%;">
                <p class="card-text fs-5">
                    Balai Pelatihan Kesehatan (Bapelkes) merupakan institusi pelatihan di bidang kesehatan yang berperan
                    penting dalam peningkatan kapasitas tenaga kesehatan melalui pelatihan berbasis kompetensi.
                </p>
            </div>
        </div>

        <!-- Card 2: Visi -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded">
                <h5 class="card-title text-maroon"><i class="bi bi-eye-fill me-2"></i>Visi</h5>
                <p class="card-text fs-5">
                    Menjadi penyelenggara diklat kesehatan terdepan dan terpercaya di Kalimantan.
                </p>
            </div>
        </div>

        <!-- Card 3: Misi -->
        <div class="card mb-4 shadow-lg border-0" data-aos="fade-up">
            <div class="card-body bg-light rounded">
                <h5 class="card-title text-maroon"><i class="bi bi-bullseye me-2"></i>Misi</h5>
                <ul class="card-text fs-5">
                    <li>Menyelenggarakan Diklat Kesehatan secara profesional bagi tenaga kesehatan dan masyarakat.</li>
                    <li>Memberikan pelayanan prima dalam penyelenggaraan Diklat Kesehatan.</li>
                    <li>Mengembangkan dan melaksanakan program Diklat Kesehatan unggulan.</li>
                    <li>Menyediakan Sarana, Prasarana dan alat bantu pembelajaran yang memenuhi standar kediklatan.</li>
                    <li>Mengembangkan Laboratorium kelas, Laboratorium Lapangan dan Perpustakaan.</li>
                    <li>Mengembangkan kemitraan sumber daya kediklatan.</li>
                    <li>Memberikan layanan konsultasi kediklatan dan informasi ilmu pengetahuan dan teknologi di bidang
                        kesehatan.</li>
                    <li>Mengembangkan jejaring informasi kediklatan.</li>
                    <li>Melakukan penelitian dan pengkajian kebutuhan diklat, pengembangan model, serta evaluasi
                        aktivitas kediklatan.</li>
                    <li>Mengembangkan profesionalisme sumber daya insani Bapelkes Provinsi Kalsel.</li>
                </ul>
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
