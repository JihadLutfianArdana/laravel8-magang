@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Verifikasi Peserta</h2>
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

            <div class="default-tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#daftarPeserta" role="tab">Daftar Peserta
                            Magang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#verifikasiPeserta" role="tab">Verifikasi
                            Peserta Magang</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Daftar Peserta -->
                    <div class="tab-pane fade show active" id="daftarPeserta" role="tabpanel">
                        <h4 class="card-title">Daftar Peserta Magang</h4>
                        <a href="/dashboard/verifikasi-peserta/print/admin-pendaftaran" class="btn mb-3 btn-dark">
                            <i class="bi bi-printer"></i> Cetak Data
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Tanggal Verifikasi</th>
                                        <th>Disetujui Oleh</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($verifiedUsers as $index => $user)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_admin == 0 ? 'Peserta Magang' : 'Admin' }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $user->approvedBy ? $user->approvedBy->nama : '-' }}</td>
                                            <td class="text-center">
                                                <a href="/dashboard/verifikasi-peserta/profile/{{ $user->nama }}/admin-pendaftaran"
                                                    class="btn btn-primary btn-sm"><i class="bi bi-person"></i></a>
                                                <form id="delete-Form-{{ $user->id }}"
                                                    action="/dashboard/verifikasi-peserta/delete/admin-pendaftaran/{{ $user->id }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $user->id }})"><i
                                                        class="bi bi-trash"></i></button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Verifikasi Peserta -->
                    <div class="tab-pane fade" id="verifikasiPeserta" role="tabpanel">
                        <h4 class="card-title">Daftar Permintaan Verifikasi</h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingUsers as $index => $user)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_admin == 0 ? 'Peserta Magang' : 'Admin' }}</td>
                                            <td class="text-center">
                                                <form
                                                    action="/dashboard/verifikasi-peserta/approve/admin-pendaftaran/{{ $user->id }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm" type="submit"><i
                                                            class="bi bi-check2"></i> Setujui</button>
                                                </form>
                                                <form
                                                    action="/dashboard/verifikasi-peserta/reject/admin-pendaftaran/{{ $user->id }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                            class="bi bi-x"></i>
                                                        Tolak</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
