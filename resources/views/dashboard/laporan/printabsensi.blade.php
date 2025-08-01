@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Laporan Rekapitulasi Absensi Harian Peserta</h2>

    @php
        $tanggal_terkecil = $absensiPeserta->min('hari_tanggal');
        $tanggal_terbesar = $absensiPeserta->max('hari_tanggal');
    @endphp

    @if ($tanggal_awal_absensi && $tanggal_akhir_absensi)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_absensi)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_absensi)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_absensi)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_absensi)->translatedFormat('d F Y') }}
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
                    <th>Hari dan Tanggal</th>
                    <th>NISM</th>
                    <th>Nama Peserta</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensiPeserta as $index => $absen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->hari_tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                        <td>{{ optional($absen->detailMagang)->nism ?? '-' }}</td>
                        <td>{{ optional($absen->detailMagang)->nama_peserta ?? '-' }}</td>
                        <td>{{ $absen->waktu_masuk ?? '-' }}</td>
                        <td>{{ $absen->waktu_keluar ?? '-' }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>{{ $absen->keterangan ?? '-' }}</td>
                        <td>{{ $absen->alasan ?? '-' }}</td>
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
