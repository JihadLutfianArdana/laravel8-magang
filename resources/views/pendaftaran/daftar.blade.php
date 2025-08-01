@extends('layouts.main-login')

@section('container')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8 col-md-10">

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-lg border-0 rounded p-4">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img class="mb-1" src="{{ asset('img/logo_prov.png') }}" alt="Logo Prov Kalsel" width="100"
                                height="80" style="margin-top: -30px;">
                            <h1 class="h6 mb-1 fw-normal">Form Pendaftaran Peserta Magang</h1>
                            <hr>
                        </div>

                        <form action="/pendaftaran-peserta" method="post" enctype="multipart/form-data"
                            id="registrationForm">
                            @csrf
                            <!-- Step 1: Data Diri -->
                            <div id="step-1">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <!-- NIS/NIM -->
                                            <div class="col-md-6">
                                                <label for="nism" class="form-label"><small>NIS / NIM</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="nism"
                                                        class="form-control @error('nism') is-invalid @enderror"
                                                        id="nism" value="{{ old('nism') }}" autofocus>
                                                    @error('nism')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Nama Lengkap -->
                                            <div class="col-md-6">
                                                <label for="nama_lengkap" class="form-label"><small>Nama
                                                        Lengkap</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="nama_lengkap"
                                                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                        id="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                                    @error('nama_lengkap')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <!-- Tempat Lahir -->
                                            <div class="col-md-6">
                                                <label for="tempat_lahir" class="form-label"><small>Tempat
                                                        Lahir</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="tempat_lahir"
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                                    @error('tempat_lahir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Tanggal Lahir -->
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir" class="form-label"><small>Tanggal
                                                        Lahir</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="date" name="tanggal_lahir"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                                    @error('tanggal_lahir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <!-- Jenis Kelamin -->
                                            <div class="col-md-6">
                                                <label for="jenis_kelamin" class="form-label"><small>Jenis
                                                        Kelamin</small></label>
                                                <div class="input-group input-group-sm">
                                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                        id="jenis_kelamin" name="jenis_kelamin">
                                                        <option value=""
                                                            {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>Pilih Jenis
                                                            Kelamin</option>
                                                        <option value="Laki-laki"
                                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                            Laki-laki</option>
                                                        <option value="Perempuan"
                                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Alamat -->
                                            <div class="col-md-6">
                                                <label for="alamat" class="form-label"><small>Alamat</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="alamat"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        id="alamat" value="{{ old('alamat') }}">
                                                    @error('alamat')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <!-- No Telepon -->
                                            <div class="col-md-6">
                                                <label for="no_telepon" class="form-label"><small>No Telepon</small></label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">+62</span>
                                                    <input type="text" name="no_telepon"
                                                        class="form-control @error('no_telepon') is-invalid @enderror"
                                                        id="no_telepon" value="{{ old('no_telepon') }}">
                                                    @error('no_telepon')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <label for="email" class="form-label"><small>Email</small></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-left mt-4">
                                        <a href="/beranda-magang" class="btn btn-secondary btn-sm"><i
                                                class="bi bi-arrow-left"></i>
                                            Kembali</a>
                                        <button type="reset" class="btn btn-warning btn-sm"><i
                                                class="bi bi-arrow-counterclockwise"></i> Reset</button>
                                        <button type="button" class="btn btn-primary btn-sm" id="nextStepBtn">Lanjutkan
                                            <i class="bi bi-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Rencana Magang dan File Upload -->
                            <div id="step-2" style="display: none;">
                                <div class="row g-3">
                                    <!-- Asal Sekolah/Universitas -->
                                    <div class="col-md-6">
                                        <label for="asal_sekolah_universitas" class="form-label"><small>Asal
                                                Sekolah/Universitas</small></label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="asal_sekolah_universitas"
                                                class="form-control @error('asal_sekolah_universitas') is-invalid @enderror"
                                                id="asal_sekolah_universitas"
                                                value="{{ old('asal_sekolah_universitas') }}">
                                            @error('asal_sekolah_universitas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kelas/Jurusan -->
                                    <div class="col-md-6">
                                        <label for="kelas_jurusan" class="form-label"><small>Kelas /
                                                Jurusan</small></label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="kelas_jurusan"
                                                class="form-control @error('kelas_jurusan') is-invalid @enderror"
                                                id="kelas_jurusan" value="{{ old('kelas_jurusan') }}">
                                            @error('kelas_jurusan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tanggal Mulai Magang -->
                                    <div class="col-md-6">
                                        <label for="tanggal_mulai" class="form-label"><small>Tanggal Mulai
                                                Magang</small></label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" name="tanggal_mulai"
                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                value="{{ old('tanggal_mulai') }}">
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tanggal Selesai Magang -->
                                    <div class="col-md-6">
                                        <label for="tanggal_selesai" class="form-label"><small>Tanggal Selesai
                                                Magang</small></label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" name="tanggal_selesai"
                                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                value="{{ old('tanggal_selesai') }}">
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Upload Surat Pengantar -->
                                    <div class="col-12">
                                        <label for="surat_pengantar" class="form-label"><small>Upload Surat
                                                Pengantar</small></label>
                                        <div class="input-group input-group-sm">
                                            <input type="file" name="surat_pengantar"
                                                class="form-control @error('surat_pengantar') is-invalid @enderror"
                                                value="{{ old('surat_pengantar') }}">
                                            @error('surat_pengantar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-left mt-4">
                                    <button type="button" class="btn btn-secondary btn-sm" id="backStepBtn"><i
                                            class="bi bi-arrow-left"></i> Kembali</button>
                                    <button type="submit" class="btn btn-info btn-sm"><i class="bi bi-download"></i>
                                        Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nextStepBtn').addEventListener('click', function() {
            // Hide step 1 and show step 2
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
        });

        document.getElementById('backToStep1Btn').addEventListener('click', function() {
            // Hide step 2 and show step 1
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
        });
    </script>
@endsection
