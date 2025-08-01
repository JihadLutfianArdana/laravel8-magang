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
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Daftar Peserta -->
                    <div class="tab-pane fade show active" id="daftarPeserta" role="tabpanel">
                        <h4 class="card-title">Daftar Peserta Magang</h4>
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
                                                <a href="/dashboard/verifikasi-peserta/profile/{{ $user->nama }}/pembimbing-lapangan"
                                                    class="btn btn-primary btn-sm"><i class="bi bi-person"></i></a>
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
