@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Kelola Pengguna</h2>
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

            <!-- Tab Navigation -->
            <div class="custom-tab-1">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#listAdmin">Daftar Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#addAdmin">Tambah Pengguna Baru</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab Daftar Admin -->
                    <div class="tab-pane fade show active" id="listAdmin" role="tabpanel">
                        <div class="p-t-3">
                            <h4 class="card-title">Daftar Pengguna</h4>
                            <a href="/dashboard/kelola-pengguna/printP/admin-pendaftaran" class="btn mb-3 btn-dark">
                                <i class="bi bi-printer"></i> Pimpinan
                            </a>
                            <a href="/dashboard/kelola-pengguna/printAP/admin-pendaftaran" class="btn mb-3 btn-dark">
                                <i class="bi bi-printer"></i> Admin Pendaftaran
                            </a>
                            <a href="/dashboard/kelola-pengguna/printPL/admin-pendaftaran" class="btn mb-3 btn-dark">
                                <i class="bi bi-printer"></i> Pembimbing Lapangan
                            </a>
                            <a href="/dashboard/kelola-pengguna/printPS/admin-pendaftaran" class="btn mb-3 btn-dark">
                                <i class="bi bi-printer"></i> Peserta Magang
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered zero-configuration">
                                    <thead class="table-secondary rounded-top">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Dibuat Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admin->nama }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>
                                                    @if ($admin->is_admin == 1)
                                                        Pimpinan
                                                    @elseif ($admin->is_admin == 2)
                                                        Admin Pendaftaran
                                                    @elseif ($admin->is_admin == 3)
                                                        Pembimbing Lapangan
                                                    @elseif ($admin->is_admin == 0)
                                                        Peserta Magang
                                                    @endif
                                                </td>
                                                <td>{{ $admin->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    @if (in_array($admin->is_admin, [1, 2, 3, 0]))
                                                        <form id="delete-Form-{{ $admin->id }}"
                                                            action="/dashboard/kelola-pengguna/admin-pendaftaran/{{ $admin->id }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $admin->id }})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Tambah Admin -->
                    <div class="tab-pane fade" id="addAdmin" role="tabpanel">
                        <div class="p-t-15">
                            <h5>Form Tambah Pengguna Baru</h5>
                            <form action="/dashboard/kelola-pengguna/admin-pendaftaran" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control form-control-sm rounded @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control form-control-sm rounded @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-sm rounded @error('password') is-invalid @enderror"
                                                id="password" name="password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePasswordVisibility()"
                                                    style="cursor: pointer;">
                                                    <i id="password-icon" class="bi bi-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label">Role</label>
                                        <select
                                            class="form-control form-control-sm rounded @error('is_admin') is-invalid @enderror"
                                            id="role" name="is_admin" required>
                                            <option value="" disabled selected>Pilih Role</option>
                                            <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>Pimpinan
                                            </option>
                                            <option value="2" {{ old('is_admin') == 2 ? 'selected' : '' }}>Admin
                                                Pendaftaran</option>
                                            <option value="3" {{ old('is_admin') == 3 ? 'selected' : '' }}>Pembimbing
                                                Lapangan</option>
                                            <option value="0" {{ old('is_admin') === '0' ? 'selected' : '' }}>Peserta
                                                Magang</option>
                                        </select>
                                        @error('is_admin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info"><i class="bi bi-download"></i>
                                        Simpan</button>
                                    <button type="reset" class="btn btn-warning"><i
                                            class="bi bi-arrow-counterclockwise"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('password-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
@endsection
