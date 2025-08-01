@extends('layouts.main-login')

@section('container')
    <div class="container d-flex justify-content-center align-items-center min-vh-100" style="max-width: 400px;">
        <!-- Ubah lebar maksimal -->
        <div class="row justify-content-center w-100">
            <div class="col-12">
                <div class="card shadow w-100 px-3" style="max-width: 350px;"> <!-- Ubah lebar maksimal card -->
                    <div class="card-body">
                        <main class="form-registration w-100 m-auto">
                            <div class="text-center">
                                <img class="mb-2" src="{{ asset('img/logo_prov.png') }}" alt="Logo Prov Kalsel"
                                    width="120" height="100"> <!-- Perkecil gambar -->
                                <br>
                                <h1 class="h5 mb-3 fw-normal">Form Registrasi</h1>
                            </div>

                            <form action="/register" method="post">
                                @csrf
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        placeholder="Nama" required autofocus value="{{ session('nama', old('nama')) }}">
                                    <label for="nama" class="label-disabled"><i class="bi bi-person-fill"></i>
                                        Nama</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="email@example.com" required
                                        value="{{ session('email', old('email')) }}">
                                    <label for="email" class="label-disabled"><i class="bi bi-envelope-fill"></i>
                                        Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Password" required>
                                    <label for="password" class="label-disabled"><i class="bi bi-lock-fill"></i>
                                        Password</label>
                                    <!-- Tambahkan ikon mata untuk fitur show/hide password -->
                                    <i class="bi bi-eye-slash-fill toggle-password" id="togglePassword"
                                        style="position: absolute; top: 50%; right: 10px; cursor: pointer; transform: translateY(-50%);"></i>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary w-100 py-2" type="submit">Buat Akun</button>
                            </form>
                            <small class="d-block text-center mt-3">Sudah punya akun? <a href="/login">Login di
                                    sini!</a></small>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
