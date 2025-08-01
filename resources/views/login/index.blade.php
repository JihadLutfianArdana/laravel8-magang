@extends('layouts.main-login')

@section('container')
    <div class="container d-flex justify-content-center align-items-center min-vh-100" style="max-width: 400px;">
        <!-- Ubah lebar maksimal -->
        <div class="row justify-content-center w-100">
            <div class="col-12">
                <div class="card shadow w-100 px-3" style="max-width: 350px;"> <!-- Ubah lebar maksimal card -->
                    <div class="card-body">

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <main class="form-signin w-100 m-auto">
                            <div class="text-center">
                                <img class="mb-2" src="{{ asset('img/logo_prov.png') }}" alt="Logo Prov Kalsel"
                                    width="120" height="100"> <!-- Perkecil gambar -->
                                <h1 class="h5 mb-3 fw-normal">SIMAGANG BAPELKES</h1>
                                <small>Silahkan Login</small>
                            </div>

                            <form action="/login" method="post">
                                @csrf
                                <div class="form-floating mb-3 mt-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                                    <label for="floatingInput" class="label-disabled"><i class="bi bi-envelope-fill"></i>
                                        Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3 position-relative">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required>
                                    <label for="password" class="label-disabled">
                                        <i class="bi bi-lock-fill"></i> Password
                                    </label>
                                    <!-- Tambahkan ikon mata untuk fitur show/hide password -->
                                    <i class="bi bi-eye-slash-fill toggle-password" id="togglePassword"
                                        style="position: absolute; top: 50%; right: 10px; cursor: pointer; transform: translateY(-50%);"></i>
                                </div>

                                <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                                <small class="d-block text-center mt-3"><a href="/beranda-magang">Halaman Utama</a></small>
                            </form>
                            <small class="d-block text-center mt-3">Belum punya akun? <a href="/register">Daftar di
                                    sini!</a></small>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
