@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Dashboard</h2>
    <hr class="my-4">

    <!-- Statistik Jumlah -->
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Admin Pendaftaran</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahAdminPendaftaran }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Pembimbing Lapangan</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahPembimbingLapangan }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Peserta Magang</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahPesertaMagang }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Pengguna Terdaftar</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahPenggunaTerdaftar }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Grafik Penerimaan Magang (Bulanan) -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Grafik Penerimaan Magang</h4>
            <!-- Form filter berdasarkan periode tanggal -->
            <div class="d-flex justify-content-start align-items-center mb-3">
                <a href="/dashboard/grafik-penerimaan/print?tanggal_awal={{ request('tanggal_awal') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                    target="_blank" class="btn btn-dark">
                    <i class="bi bi-printer"></i> Cetak Data
                </a>
                <form action="{{ url()->current() }}" method="GET" class="form-inline">
                    <label class="ml-4">Periode:</label>
                    <input type="date" name="tanggal_awal" class="form-control form-control-sm ml-2"
                        value="{{ request('tanggal_awal', $tanggalAwal) }}">
                    <span class="mx-2">s/d</span>
                    <input type="date" name="tanggal_akhir" class="form-control form-control-sm"
                        value="{{ request('tanggal_akhir', $tanggalAkhir) }}">
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>

            <div class="col-lg-12 mb-0">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">
                            Penerimaan Magang Periode
                            {{ \Carbon\Carbon::parse($tanggalAwal)->translatedFormat('d F Y') }}
                            s/d
                            {{ \Carbon\Carbon::parse($tanggalAkhir)->translatedFormat('d F Y') }}
                        </h4>
                        <div id="distributed-series" class="ct-chart ct-golden-section"></div>
                        <hr>
                        <div class="mt-3">
                            <h5>Rekap:</h5>
                            <ol>
                                @foreach ($data as $item)
                                    <li>{{ $loop->iteration }}. Peserta Magang dari {{ $item->asal_sekolah_universitas }}
                                        berjumlah {{ $item->jumlah }} orang</li>
                                @endforeach
                            </ol>
                            <strong>
                                Total Peserta Magang Periode
                                {{ \Carbon\Carbon::parse($tanggalAwal)->translatedFormat('d F Y') }}
                                s/d
                                {{ \Carbon\Carbon::parse($tanggalAkhir)->translatedFormat('d F Y') }}
                                adalah {{ $total }} orang
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Tahunan -->
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="card-title">Grafik Tahunan Penerimaan Magang</h4>
            <!-- Form filter tahun -->
            <div class="d-flex justify-content-start align-items-center mb-3">
                <a href="/dashboard/grafik-penerimaan-tahunan/print?tahun={{ $filterTahun }}" target="_blank"
                    class="btn btn-dark">
                    <i class="bi bi-printer"></i> Cetak Laporan Tahunan
                </a>
                <form action="{{ url()->current() }}" method="GET" class="form-inline">
                    <label class="ml-4">Tahun:</label>
                    <select name="tahun" class="form-control form-control-sm ml-2 w-auto">
                        @for ($i = now()->year; $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ $filterTahun == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>

            <div class="col-lg-12 mb-0">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Penerimaan Magang Pada Tahun {{ $filterTahun }}</h4>
                        <div id="yearly-chart" class="ct-chart ct-golden-section"></div>
                        <hr>
                        <div class="mt-3">
                            <h5>Rekap:</h5>
                            <ol>
                                @foreach ($dataTahun as $item)
                                    <li>{{ $loop->iteration }}. Bulan
                                        {{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}:
                                        {{ $item->jumlah }} peserta</li>
                                @endforeach
                            </ol>
                            <strong>Total peserta magang tahun {{ $filterTahun }} adalah {{ $totalTahun }}
                                orang</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new Chartist.Bar(
            "#distributed-series", {
                labels: {!! json_encode($labels) !!},
                series: [{{ $series->implode(',') }}],
            }, {
                distributeSeries: true,
                plugins: [Chartist.plugins.tooltip()],
            }
        );

        new Chartist.Bar(
            "#yearly-chart", {
                labels: {!! json_encode($labelsTahun) !!},
                series: [{{ $seriesTahun->implode(',') }}],
            }, {
                distributeSeries: true,
                plugins: [Chartist.plugins.tooltip()],
            }
        );
    </script>

    <style>
        #distributed-series.ct-chart,
        #yearly-chart.ct-chart {
            min-height: auto !important;
            height: 250px !important;
        }

        .card-body {
            padding-bottom: 1rem !important;
        }
    </style>
@endsection
