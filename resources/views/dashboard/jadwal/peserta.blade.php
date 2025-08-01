@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Daftar Jadwal Magang</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Jadwal Magang Anda</h4>
            <a href="/dashboard/laporan-jadwal-peserta" class="btn mb-2 btn-dark">
                <i class="bi bi-printer"></i> Cetak Data Jadwal
            </a>

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
                            {{-- @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada jadwal.</td>
                            </tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
