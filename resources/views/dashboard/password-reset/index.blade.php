@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Reset Password</h2>
    <hr class="my-4">

    <div class="row">
        <div class="col-md-6">
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

                    <h4 class="card-title mb-4">Form Reset Password</h4>

                    <!-- Form untuk Reset Password -->
                    <form action="/dashboard/reset-password-admin" method="POST">
                        @csrf
                        <!-- Input Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control rounded" id="email"
                                value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <!-- Input Password Baru -->
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded" id="password" name="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="bi bi-eye" id="toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Input Konfirmasi Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded" id="password_confirmation"
                                    name="password_confirmation" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="bi bi-eye" id="toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-info"><i class="bi bi-download"></i> Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Riwayat Reset Password Anda</h4>
                    <p>
                        <strong>Terakhir kali mengganti password:</strong>
                        @if (Auth::user()->updated_at)
                            {{ Auth::user()->updated_at->format('d-m-Y H:i:s') }}
                        @else
                            Belum pernah mengganti password.
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
@endsection
