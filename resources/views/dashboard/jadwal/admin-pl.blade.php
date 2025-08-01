@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Buat Jadwal</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h4 class="card-title">Data Jadwal Peserta</h4>

            <a href="/dashboard/buat-jadwal-peserta/pembimbing-lapangan" class="btn mb-2 btn-success"><i
                    class="bi bi-plus-circle"></i>
                Tambah
                Data Jadwal</a>
            <a href="/dashboard/report-jadwal-peserta/pembimbing-lapangan" class="btn mb-2 btn-dark">
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
                            <th>Nama Kepala Ruangan / Staff</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->detailMagang->nism }}</td> <!-- Menampilkan NISM -->
                                <td>{{ $data->detailMagang->nama_peserta }}</td> <!-- Menampilkan Nama Peserta -->
                                <td>{{ $data->ruangan->nama_ruangan }}</td> <!-- Menampilkan Nama Ruangan -->
                                <td>{{ $data->ruangan->nama_pegawai }}</td> <!-- Menampilkan Kepala Ruangan -->
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_awal)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_akhir)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="/dashboard/edit-jadwal-peserta/pembimbing-lapangan/{{ $data->id }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="/dashboard/jadwal-peserta/pembimbing-lapangan/{{ $data->id }}"
                                        method="POST" style="display: inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
