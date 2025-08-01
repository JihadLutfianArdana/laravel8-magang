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

    <div class="position-relative" style="height: 100vh;">
        <img src="{{ asset('img/bapelkes1.jpg') }}" class="d-block w-100" style="height: 100vh; object-fit: cover;"
            alt="Bapelkes">
        <div class="position-absolute top-50 start-50 translate-middle text-center">
            <h2 class="hero-text" id="animated-text">Selamat Datang di Bapelkes Provinsi Kalimantan Selatan</h2>
        </div>
    </div>

    <!-- LAYANAN SECTION -->
    <section class="layanan-section container">
        <h2>LAYANAN DI BAPELKES</h2>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/bapelkes6.jpg') }}" class="card-img-top" alt="Pelatihan Kesehatan">
                    <div class="card-body">
                        <h5 class="card-title">Pelatihan Kesehatan</h5>
                        <p class="card-text">Program pelatihan untuk meningkatkan kompetensi tenaga kesehatan.</p>
                        <a href="#" class="btn btn-sm text-white mt-2" style="background-color: #001f3f;">
                            <i class="bi bi-journal-text me-1"></i> Daftar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/bapelkes7.jpg') }}" class="card-img-top" alt="Program Magang">
                    <div class="card-body">
                        <h5 class="card-title">Program Magang</h5>
                        <p class="card-text">Fasilitasi magang siswa/mahasiswa di bidang kesehatan dan administrasi.</p>
                        <a href="/pendaftaran-peserta" class="btn btn-sm text-white mt-2"
                            style="background-color: #001f3f;">
                            <i class="bi bi-briefcase-fill me-1"></i> Daftar
                        </a>
                        <a href="/program-magang" class="btn btn-sm text-white mt-2" style="background-color: #004080;">
                            <i class="bi bi-info-circle me-1"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/bapelkes6.jpg') }}" class="card-img-top" alt="Penyewaan Aula">
                    <div class="card-body">
                        <h5 class="card-title">Penyewaan Aula</h5>
                        <p class="card-text">Penyewaan aula untuk berbagai macam kegiatan seperti seminar dan resepsi
                            pernikahan.</p>
                        <a href="#" class="btn btn-sm text-white mt-2" style="background-color: #001f3f;">
                            <i class="bi bi-house-door-fill me-1"></i> Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <h5>Alamat:</h5>
            <p>Jalan H. Mistar Tjokrokusumo No. 5A, Sei Besar, Banjarbaru Selatan, Kemuning,
                Kecamatan Banjarbaru Selatan, Kota Banjarbaru, Kalimantan Selatan, 70714</p>
            <h5>Kontak:</h5>
            <p>(0511) 4772017</p>
            <h5>Email:</h5>
            <p>info@bapelkes.kalselprov.go.id</p>
            <h5>Lokasi Kami:</h5>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d3982.5984071230273!2d114.844876!3d-3.4474071!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sid!2sid!4v1748395297941!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>

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
