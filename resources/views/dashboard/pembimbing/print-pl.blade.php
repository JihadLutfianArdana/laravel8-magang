@extends('dashboard.layouts.kop-print')

@section('container')
    <div class="text-center">
        <h2 class="judul-laporan">Laporan Penilaian Pembimbing Lapangan</h2>
    </div>

    <!-- Tabel Informasi Umum -->
    <table style="width: 100%; border-collapse: collapse; border: none;">
        <tr>
            <td style="width: 30%; border: none;"><strong>Nama Pembimbing Lapangan</strong></td>
            <td style="width: 70%; border: none;">: {{ $pembimbing->nama_pegawai ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Peserta Yang Menilai</strong></td>
            <td style="border: none;">: {{ $user->nama }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Asal Sekolah / Universitas</strong></td>
            <td style="border: none;">: {{ $user->detailMagang->asal_sekolah_universitas ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Tanggal Penilaian</strong></td>
            <td style="border: none;">:
                {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border: none;">
                Sebagai evaluasi atas pembimbing lapangan, berikut adalah hasil penilaian peserta terhadap kinerja
                pembimbing lapangan:
            </td>
        </tr>
    </table>

    <!-- Tabel Penilaian -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="bg-info text-white text-center">
                <th>No</th>
                <th>Aspek Yang Dinilai</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Keterampilan Pembimbing dalam Memberikan Arahan</td>
                <td class="text-center">{{ $penilaian->poin_1 }}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>Kepedulian dan Sikap terhadap Peserta</td>
                <td class="text-center">{{ $penilaian->poin_2 }}</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>Kemampuan dalam Membimbing dan Memberikan Solusi</td>
                <td class="text-center">{{ $penilaian->poin_3 }}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>Kedisiplinan dan Tanggung Jawab Pembimbing</td>
                <td class="text-center">{{ $penilaian->poin_4 }}</td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td>Kesiapan Pembimbing dalam Memberikan Materi dan Bimbingan</td>
                <td class="text-center">{{ $penilaian->poin_5 }}</td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td>Saran</td>
                <td class="text-center">{{ $penilaian->saran ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; gap: 50px;">
        <div style="text-align: left; width: 45%; border: none;">
            <p style="margin: 29px; margin-left: 5px;">Pembimbing Lapangan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $pembimbingLapangan }}</p>
        </div>

        <div style="text-align: right; width: 45%; border: none;">
            <p style="margin: 5px;">Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 5px;">Kepala Balai Pelatihan Kesehatan</p>
            <p style="margin: 5px;">Provinsi Kalimantan Selatan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $kepalaBalai }}</p>
        </div>
    </div>
@endsection
