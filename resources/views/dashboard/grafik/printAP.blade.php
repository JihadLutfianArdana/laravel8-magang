@extends('dashboard.layouts.kop-print')

@section('container')
    <div class="text-center mb-4">
        <h2 class="judul-laporan">Laporan Penerimaan Magang</h2>
        <p>Rekap penerimaan pada periode:
            {{ \Carbon\Carbon::parse($tanggalAwal)->translatedFormat('d F Y') }}
            s/d
            {{ \Carbon\Carbon::parse($tanggalAkhir)->translatedFormat('d F Y') }}
        </p>
    </div>

    <div id="distributed-series" class="ct-chart ct-golden-section"></div>
    <div class="mt-6 mb-4">
        <h5>Rekap:</h5>
        @foreach ($data as $index => $item)
            <p>{{ $index + 1 }}. Peserta Magang dari {{ $item->asal_sekolah_universitas }} berjumlah
                {{ $item->jumlah }} orang
            </p>
        @endforeach
        <p>Total Peserta Magang Periode
            {{ \Carbon\Carbon::parse($tanggalAwal)->translatedFormat('d F Y') }}
            s/d
            {{ \Carbon\Carbon::parse($tanggalAkhir)->translatedFormat('d F Y') }}
            adalah {{ $total }} orang</p>
    </div>

    <br>

    <!-- Informasi nama kepala dan pembimbing lapangan -->
    <div style="margin-top: 100px; display: flex; justify-content: space-between; align-items: center; gap: 50px;">
        <!-- Tanda tangan pembina lapangan -->
        <div style="text-align: left; width: 45%; border: none;">
            <p style="margin: 29px; margin-left: 5px;">Pembimbing Lapangan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $pembimbingLapangan }}</p>
        </div>

        <!-- Tanda tangan kepala balai -->
        <div style="text-align: right; width: 45%; border: none;">
            <p style="margin: 5px;">Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 5px;">Kepala Balai Pelatihan Kesehatan</p>
            <p style="margin: 5px;">Provinsi Kalimantan Selatan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $kepalaBalai }}</p>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltips@0.0.17/dist/chartist-plugin-tooltip.min.js"></script>

    <script>
        new Chartist.Bar(
            "#distributed-series", {
                labels: {!! json_encode($labels) !!},
                series: [{{ $series->implode(',') }}],
            }, {
                distributeSeries: true,
                height: '200px', // <== tambahkan ini
                width: '500px',
                plugins: [Chartist.plugins.tooltip()],
            }
        );
    </script>
@endsection
