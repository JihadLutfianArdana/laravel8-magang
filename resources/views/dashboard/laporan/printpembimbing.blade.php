@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Laporan Rekapitulasi Penilaian Pembimbing Lapangan</h2>

    @php
        $tanggal_terkecil = $penilaianPembimbing->min('tanggal_penilaian');
        $tanggal_terbesar = $penilaianPembimbing->max('tanggal_penilaian');
    @endphp

    @if ($tanggal_awal_penilaian_pembimbing && $tanggal_akhir_penilaian_pembimbing)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_penilaian_pembimbing)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_penilaian_pembimbing)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_penilaian_pembimbing)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_penilaian_pembimbing)->translatedFormat('d F Y') }}
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
                    <th>Nama Peserta Yang Menilai</th>
                    <th>Nama Pembimbing Yang Dinilai</th>
                    <th>Keterampilan Memberikan Arahan</th>
                    <th>Kepedulian Terhadap Peserta</th>
                    <th>Membimbing dan Memberikan Solusi</th>
                    <th>Disiplin dan Tanggung Jawab</th>
                    <th>Kesiapan Memberi Materi</th>
                    <th>Saran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penilaianPembimbing as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->translatedFormat('l, d F Y') }}
                        </td>
                        <td>{{ optional($item->detailMagang)->nism ?? '-' }}</td>
                        <td>{{ optional($item->detailMagang)->nama_peserta ?? '-' }}</td>
                        <td>{{ optional($item->pembimbing)->nama_pegawai ?? '-' }}</td>
                        <td class="text-center">{{ $item->poin_1 }}</td>
                        <td class="text-center">{{ $item->poin_2 }}</td>
                        <td class="text-center">{{ $item->poin_3 }}</td>
                        <td class="text-center">{{ $item->poin_4 }}</td>
                        <td class="text-center">{{ $item->poin_5 }}</td>
                        <td>{{ $item->saran ?? '-' }}</td>
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
