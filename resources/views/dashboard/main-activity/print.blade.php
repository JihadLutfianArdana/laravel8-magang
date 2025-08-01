@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Laporan Kegiatan Harian Peserta</h2>

    <!-- Informasi peserta magang dalam tabel tanpa border -->
    <table style="width: 100%; border-collapse: collapse; border: none;">
        <tr>
            <td style="width: 30%; border: none;"><strong>Nama</strong></td>
            <td style="width: 70%; border: none;">: {{ $detail->nama_peserta ?? '-' }} - {{ $detail->nism ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Kelas / Jurusan</strong></td>
            <td style="border: none;">: {{ $detail->kelas_jurusan ?? '-' }} - {{ $detail->asal_sekolah_universitas ?? '-' }}
            </td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Nama Pembimbing</strong></td>
            <td style="border: none;">: {{ $detail->nama_pembimbing ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Tanggal</strong></td>
            <td style="border: none;">: {{ $tanggalHariIni }}</td>
        </tr>
    </table>

    <br>

    <!-- Tabel Kegiatan -->
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Paraf Pembimbing PKL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatan as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $item->deskripsi_kegiatan }}</td>
                    <td>{{ $item->lokasi_kegiatan }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
