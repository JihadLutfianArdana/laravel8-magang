@extends('dashboard.layouts.kop-print')

@section('container')
    <div class="text-center">
        <h2 class="judul-laporan">Laporan Absensi Harian Peserta</h2>
    </div>

    <!-- Tabel Nama Peserta dan NISM -->
    <table style="width: 100%; border-collapse: collapse; border: none; margin-bottom: 20px;">
        <tr>
            <td style="width: 30%; border: none;"><strong>Nama Peserta</strong></td>
            <td style="width: 70%; border: none;">: {{ $detailMagang->nama_peserta ?? '-' }} -
                {{ $detailMagang->nism ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Jurusan</strong></td>
            <td style="border: none;">: {{ $detailMagang->asal_sekolah_universitas ?? '-' }} -
                {{ $detailMagang->kelas_jurusan ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Tanggal</strong></td>
            <td style="border: none;">: {{ $tanggalHariIni }}</td>
        </tr>
    </table>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Hari & Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiPeserta as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $data->waktu_masuk }}</td>
                    <td>{{ $data->waktu_keluar }}</td>
                    <td>{{ $data->status ?? '-' }}</td>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                    <td>{{ $data->alasan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
