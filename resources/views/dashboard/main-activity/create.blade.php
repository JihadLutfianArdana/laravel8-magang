@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Tambah Data Kegiatan</h2>
    <hr class="my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/kegiatan/" class="btn mb-1 btn-secondary"><i class="bi bi-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="form-validation">
                        <form action="/dashboard/kegiatan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Input untuk Nama Kegiatan -->
                            <div class="form-group row">
                                <label for="nama_kegiatan" class="col-lg-4 col-form-label">Nama Kegiatan</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('nama_kegiatan') is-invalid @enderror"
                                        name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Tanggal -->
                            <div class="form-group row">
                                <label for="tanggal_kegiatan" class="col-lg-4 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_kegiatan') is-invalid @enderror"
                                        name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}">
                                    @error('tanggal_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Deskripsi Kegiatan -->
                            <div class="form-group row">
                                <label for="deskripsi_kegiatan" class="col-lg-4 col-form-label">Deskripsi Kegiatan</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control rounded @error('deskripsi_kegiatan') is-invalid @enderror" name="deskripsi_kegiatan"
                                        rows="4">{{ old('deskripsi_kegiatan') }}</textarea>
                                    @error('deskripsi_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Lokasi -->
                            <div class="form-group row">
                                <label for="lokasi_kegiatan" class="col-lg-4 col-form-label">Lokasi Kegiatan</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('lokasi_kegiatan') is-invalid @enderror"
                                        name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan') }}">
                                    @error('lokasi_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Dokumentasi Kegiatan -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="dok_kegiatan">Dokumentasi Kegiatan</label>
                                <div class="col-lg-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="dok_kegiatan"
                                            name="dok_kegiatan">
                                        <label class="custom-file-label" for="dok_kegiatan">Pilih file...</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan dan Reset -->
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-info"><i class="bi bi-download"></i>
                                        Simpan</button>
                                    <button type="reset" class="btn btn-warning"><i
                                            class="bi bi-arrow-counterclockwise"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
