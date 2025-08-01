@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Data Ruangan</h2>
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

            <h4 class="card-title">Data Nama Ruangan dan Kepala Ruangan / Staff</h4>

            <a href="/dashboard/data-ruangan/admin-pendaftaran/create" class="btn mb-2 btn-success"><i
                    class="bi bi-plus-circle"></i>
                Tambah
                Data Ruangan</a>

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
                            <th>Aksi</th>
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
                                <td>
                                    <!-- Tombol Aksi -->
                                    <a href="/dashboard/data-ruangan/admin-pendaftaran/{{ $ruangan->nip }}/edit"
                                        class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                    <form id="delete-Form-{{ $ruangan->nip }}"
                                        action="/dashboard/data-ruangan/admin-pendaftaran/{{ $ruangan->nip }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="button"
                                            onclick="confirmDelete('{{ $ruangan->nip }}')">
                                            <i class="bi bi-trash"></i> Hapus
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
