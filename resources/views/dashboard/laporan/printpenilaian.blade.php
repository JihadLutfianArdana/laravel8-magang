@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Laporan Rekapitulasi Penilaian Peserta</h2>

    @php
        $tanggal_terkecil = $penilaianPeserta->min('tanggal_penilaian');
        $tanggal_terbesar = $penilaianPeserta->max('tanggal_penilaian');
    @endphp

    @if ($tanggal_awal_penilaian && $tanggal_akhir_penilaian)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_penilaian)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_penilaian)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_penilaian)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_penilaian)->translatedFormat('d F Y') }}
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
                    <th>Tanggal Penilaian</th>
                    <th>NISM</th>
                    <th>Nama Peserta</th>
                    <th>Absensi Kehadiran</th>
                    <th>Mengisi Logbook</th>
                    <th>Mengikuti Aturan</th>
                    <th>Disiplin Waktu</th>
                    <th>Kerjasama Tim</th>
                    <th>Komunikasi Sesama</th>
                    <th>Tanggung Jawab</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penilaianPeserta as $index => $penilaian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}
                        </td>
                        <td>{{ optional($penilaian->detailMagang)->nism ?? '-' }}</td>
                        <td>{{ optional($penilaian->detailMagang)->nama_peserta ?? '-' }}</td>
                        <td class="text-center">{{ $penilaian->nilai_kehadiran }}</td>
                        <td class="text-center">{{ $penilaian->nilai_kegiatan }}</td>
                        <td class="text-center">{{ $penilaian->nilai_sikap }}</td>
                        <td class="text-center">{{ $penilaian->nilai_kedisiplinan }}</td>
                        <td class="text-center">{{ $penilaian->nilai_kerjasama }}</td>
                        <td class="text-center">{{ $penilaian->nilai_komunikasi }}</td>
                        <td class="text-center">{{ $penilaian->nilai_tanggung_jawab }}</td>
                        <td>{{ $penilaian->komentar ?? '-' }}</td>
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
