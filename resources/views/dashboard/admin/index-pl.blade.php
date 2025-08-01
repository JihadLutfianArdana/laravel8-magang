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
                </ul>
                <div class="tab-content">
                    <!-- Tab Daftar Admin -->
                    <div class="tab-pane fade show active" id="listAdmin" role="tabpanel">
                        <div class="p-t-3">
                            <h4 class="card-title">Daftar Pengguna</h4>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered zero-configuration">
                                    <thead class="table-secondary rounded-top">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Dibuat Pada</th>
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
    </div>
@endsection
