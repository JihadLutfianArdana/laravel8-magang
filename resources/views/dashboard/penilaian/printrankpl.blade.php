<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAGANG | {{ $title }}</title>
    <link rel="icon" href="{{ asset('img/logo_prov3.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        .certificate-container {
            background: #fff;
            width: 900px;
            padding: 50px;
            border: 15px solid #0a6c97;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            position: relative;
            margin-top: 20px;
            text-align: center;
        }

        .certificate-container::before,
        .certificate-container::after {
            content: "";
            position: absolute;
            border: 5px solid #0a6c97;
            top: -20px;
            bottom: -20px;
            left: -20px;
            right: -20px;
            z-index: -1;
            border-radius: 25px;
        }

        .certificate-header img {
            width: 80px;
        }

        .certificate-header h1 {
            margin: 5px 0;
            color: #333;
            font-size: 22px;
            font-weight: bold;
            white-space: nowrap;
        }

        .certificate-body {
            margin-top: 20px;
        }

        .certificate-body p {
            font-size: 1.2rem;
            color: #111;
            margin: 10px 0;
        }

        .certificate-footer {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
        }

        .certificate-footer .signatory {
            text-align: center;
        }

        .certificate-footer .signatory h4 {
            font-size: 1rem;
            margin: 40px 0 5px 0;
            color: #333;
        }

        .certificate-footer .signatory span {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate-header">
            <h1>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h1>
            <h1>DINAS KESEHATAN</h1>
            <h1>BALAI PELATIHAN KESEHATAN</h1>
        </div>

        <div class="certificate-header">
            <img src="{{ asset('img/logo_prov3.png') }}" alt="Logo" height="100px;">
            <h1 style="margin-top: 20px;">
                SERTIFIKAT MAGANG : {{ $nomor_sertifikat }}
            </h1>
        </div>

        <div class="certificate-body mt-3">
            <p style="font-size: 24px;">Diberikan kepada:</p>
            <p style="font-size: 30px; font-weight: bold; margin: 10px 0;">{{ strtoupper($nama_peserta) }}</p>
            <p style="font-size: 18px; margin-bottom: 15px;">{{ $kelas_jurusan }}, sebagai :</p>

            @php
                $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
            @endphp
            <p style="font-size: 28px; color: #0a6c97; font-weight: bold;">
                PESERTA TERBAIK {{ $romawi[$peringkat - 1] ?? $peringkat }}
            </p>

            <p>Atas prestasi luar biasa dalam mengikuti program magang, yang berlangsung dari:</p>
            <p>
                <strong>{{ \Carbon\Carbon::parse($tanggal_mulai)->translatedFormat('l, d F Y') }}</strong> hingga
                <strong>{{ \Carbon\Carbon::parse($tanggal_selesai)->translatedFormat('l, d F Y') }}</strong>
            </p>
        </div>

        <div class="certificate-footer">
            <div class="signatory">
                <h4>______________</h4>
                <span>Pembimbing Lapangan</span>
            </div>
            <div class="signatory">
                <h4>______________</h4>
                <span>Kepala Balai Pelatihan Kesehatan</span>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
