@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Profile Pegawai</h2>
    <hr class="my-4">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Card untuk Menampilkan Informasi Profil --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white rounded">
            <h5 class="mb-0">Informasi Profil</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">NIP</th>
                            <td>: {{ $profile->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai</th>
                            <td>: {{ $profile->nama_pegawai ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>: {{ $profile->jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Ruangan</th>
                            <td>: {{ $profile->ruangan ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Card untuk Edit Profil --}}
    <div class="card">
        <div class="card-header bg-secondary text-white rounded">
            <h5 class="mb-0">Edit Profil</h5>
        </div>
        <div class="card-body">
            <form action="/dashboard/profile-pegawai/update" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nip" class="col-sm-3 col-form-label text-end">NIP</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm rounded" id="nip" name="nip"
                            value="{{ old('nip', $profile->nip ?? '') }}" required autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_pegawai" class="col-sm-3 col-form-label text-end">Nama Pegawai</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm rounded" id="nama_pegawai"
                            name="nama_pegawai" value="{{ old('nama_pegawai', $profile->nama_pegawai ?? '') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jabatan" class="col-sm-3 col-form-label text-end">Jabatan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm rounded" id="jabatan" name="jabatan"
                            value="{{ old('jabatan', $profile->jabatan ?? '') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ruangan" class="col-sm-3 col-form-label text-end">Ruangan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm rounded" id="ruangan" name="ruangan"
                            value="{{ old('ruangan', $profile->ruangan ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <button type="submit" class="btn btn-info"><i class="bi bi-download"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
