@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Laporan Rekapitulasi Kegiatan Harian Peserta</h2>

    @php
        $tanggal_terkecil = $kegiatanMagang->min('tanggal_kegiatan');
        $tanggal_terbesar = $kegiatanMagang->max('tanggal_kegiatan');
    @endphp

    @if ($tanggal_awal_kegiatan && $tanggal_akhir_kegiatan)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_kegiatan)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_kegiatan)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_kegiatan)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_kegiatan)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil && $tanggal_terbesar && $tanggal_terkecil != $tanggal_terbesar)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_terbesar)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }}
        </p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary rounded-top">
                <tr>
                    <th>No</th>
                    <th>Tanggal Kegiatan</th>
                    <th>NISM</th>
                    <th>Nama Peserta</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatanMagang as $index => $kegiatan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ optional($kegiatan->detailMagang)->nism ?? '-' }}</td>
                        <td>{{ optional($kegiatan->detailMagang)->nama_peserta ?? '-' }}</td>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                        <td>{{ $kegiatan->deskripsi_kegiatan }}</td>
                        <td>{{ $kegiatan->lokasi_kegiatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>

    <!-- Informasi nama kepala dan pembimbing lapangan -->
    <div style="margin-top: 5px; display: flex; justify-content: space-between; align-items: center; gap: 50px;">
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

    {{-- Script otomatis print --}}
    <script>
        window.print();
    </script>
@endsection
