@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Data Ruangan</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Nama Ruangan dan Kepala Ruangan / Staff</h4>
            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Nama Ruangan</th>
                            <th>Jabatan</th>
                            <th>Peran Khusus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangans as $key => $ruangan)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ruangan->nip }}</td>
                                <td>{{ $ruangan->nama_pegawai }}</td>
                                <td>{{ $ruangan->nama_ruangan }}</td>
                                <td>{{ $ruangan->jabatan }}</td>
                                <td>{{ $ruangan->peran_khusus }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
