@extends('dashboard.layouts.kop-print')

@section('container')
    <!-- Konten Laporan -->
    <h2 class="judul-laporan">Jadwal Peserta Magang</h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered zero-configuration">
            <thead class="table-secondary rounded-top">
                <tr>
                    <th>No</th>
                    <th>NISM</th>
                    <th>Nama Peserta</th>
                    <th>Nama Ruangan</th>
                    <th>Nama Kepala Ruangan</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->detailMagang->nism }}</td>
                        <td>{{ $data->detailMagang->nama_peserta }}</td>
                        <td>{{ $data->ruangan->nama_ruangan }}</td>
                        <td>{{ $data->ruangan->nama_pegawai }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_awal)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_akhir)->format('d-m-Y') }}</td>
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
@endsection
