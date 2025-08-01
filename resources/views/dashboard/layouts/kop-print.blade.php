<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAGANG | {{ $title }}</title>
    <link rel="icon" href="{{ asset('template/images/logo_prov3.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltips@0.0.17/dist/chartist-plugin-tooltip.css">
    {{-- <link rel="stylesheet" href="{{ asset('template/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}"> --}}
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kop-logo {
            width: 10%;
            margin-right: 20px;
        }

        .kop-content {
            text-align: center;
            width: 80%;
        }

        .kop-content h1 {
            margin: 0;
            margin-right: 45px;
            font-size: 22px;
            text-transform: uppercase;
        }

        .kop-content h2 {
            margin: 0;
            margin-right: 50px;
            font-size: 20px;
        }

        .kop-content p {
            margin: 5px 0;
            margin-right: 40px;
            font-size: 16px;
        }

        img {
            width: 100%;
            max-width: 70px;
        }

        .judul-laporan {
            text-align: center;
            margin: 20px 0;
            margin-left: 35px;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
    <style>
        @media print {
            #distributed-series {
                height: 200px !important;
                margin-top: 20px !important;
                margin-bottom: 20px !important;
            }

            #yearly-chart {
                height: 200px !important;
                margin-top: 20px !important;
                margin-bottom: 20px !important;
            }


            .ct-chart {
                margin: 0 auto !important;
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }

            .judul-laporan {
                margin-bottom: 20px !important;
            }

            .hasil-rekap {
                margin-top: 15px !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ asset('template/images/logo_prov3.png') }}" alt="Logo Provinsi" class="kop-logo">
        <div class="kop-content">
            <h1>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h1>
            <h2>DINAS KESEHATAN</h2>
            <h2>BALAI PELATIHAN KESEHATAN</h2>
            <p>Jalan H.Mistar Tjokrokusumo No.5A Banjarbaru Kode Pos 70714</p>
            <p>Telepon: (0511) 4772017</p>
            <p>Email: info@bapelkes.kalselprov.go.id &nbsp; | &nbsp;Website: www.bapelkes.kalselprov.go.id</p>
        </div>
    </div>

    @yield('container')
    @yield('scripts')

    {{-- <script src="{{ asset('template/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('template/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/chartist.init.js') }}"></script> --}}
    <script>
        window.print();
    </script>
</body>

</html>
