@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Edit Profile</h2>
    <hr class="my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/profile/" class="btn mb-1 btn-secondary"><i class="bi bi-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="form-validation">
                        <form class="form-valide" action="/dashboard/profile" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nism">NIS / NIM</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control rounded @error('nism') is-invalid @enderror"
                                        id="nism" name="nism"
                                        value="{{ old('nism', isset($profile) ? $profile->nism : (isset($pendaftaran) ? $pendaftaran->nism : '')) }}"
                                        placeholder="Nomor Induk Siswa / Mahasiswa">
                                    @error('nism')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nama_peserta">Nama Lengkap</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('nama_peserta') is-invalid @enderror"
                                        id="nama_peserta" name="nama_peserta"
                                        value="{{ old('nama_peserta', isset($profile) ? $profile->nama_peserta : (isset($pendaftaran) ? $pendaftaran->nama_lengkap : '')) }}"
                                        placeholder="Nama Lengkap">
                                    @error('nama_peserta')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tempat_lahir">Tempat Lahir</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('tempat_lahir') is-invalid @enderror"
                                        id="tempat_lahir" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', isset($profile) ? $profile->tempat_lahir : (isset($pendaftaran) ? $pendaftaran->tempat_lahir : '')) }}"
                                        placeholder="Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', isset($profile) ? $profile->tanggal_lahir : (isset($pendaftaran) ? $pendaftaran->tanggal_lahir : '')) }}">
                                    @error('tanggal_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-lg-6">
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-control rounded @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', isset($profile) ? $profile->jenis_kelamin : (isset($pendaftaran) ? $pendaftaran->jenis_kelamin : '')) == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', isset($profile) ? $profile->jenis_kelamin : (isset($pendaftaran) ? $pendaftaran->jenis_kelamin : '')) == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="asal_sekolah_universitas">Asal Sekolah /
                                    Universitas</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('asal_sekolah_universitas') is-invalid @enderror"
                                        id="asal_sekolah_universitas" name="asal_sekolah_universitas"
                                        value="{{ old('asal_sekolah_universitas', isset($profile) ? $profile->asal_sekolah_universitas : (isset($pendaftaran) ? $pendaftaran->asal_sekolah_universitas : '')) }}"
                                        placeholder="Nama Sekolah atau Universitas">
                                    @error('asal_sekolah_universitas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="no_telepon">No. Telepon</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('no_telepon') is-invalid @enderror"
                                        id="no_telepon" name="no_telepon"
                                        value="{{ old('no_telepon', isset($profile) ? $profile->no_telepon : (isset($pendaftaran) ? $pendaftaran->no_telepon : '')) }}"
                                        placeholder="Nomor Telepon">
                                    @error('no_telepon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="email">Email</label>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control rounded @error('email') is-invalid @enderror"
                                        id="email" name="email"
                                        value="{{ old('email', isset($profile) ? $profile->email : (isset($pendaftaran) ? $pendaftaran->email : '')) }}"
                                        placeholder="Alamat Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="alamat">Alamat</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('alamat') is-invalid @enderror" id="alamat"
                                        name="alamat"
                                        value="{{ old('alamat', isset($profile) ? $profile->alamat : (isset($pendaftaran) ? $pendaftaran->alamat : '')) }}"
                                        placeholder="Alamat Tempat Tinggal">
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="foto">Foto Profil</label>
                                <div class="col-lg-6">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('foto') is-invalid @enderror" id="foto"
                                            name="foto">
                                        <label class="custom-file-label" for="foto">Pilih file...</label>
                                    </div>
                                    @if (isset($profile) && $profile->foto)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil"
                                                class="img-fluid" width="100">
                                        </div>
                                    @endif
                                    @error('foto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-info"><i class="bi bi-download"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
