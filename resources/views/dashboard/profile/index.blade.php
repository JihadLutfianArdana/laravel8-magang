@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Profile Anda</h2>
    <hr class="my-4">

    <div class="row">
        <div class="col-lg-12">
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

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-title">
                        <a href="/dashboard/profile/edit" class="btn mb-1 btn-success"><i class="bi bi-pencil-fill"></i>
                            Edit Profile</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if ($profile)
                                    <tr>
                                        <th>NIS / NIM</th>
                                        <td>: {{ $profile->nism }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>: {{ $profile->nama_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <td>: {{ $profile->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($profile->tanggal_lahir)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>: {{ $profile->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah / Universitas</th>
                                        <td>: {{ $profile->asal_sekolah_universitas }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telepon</th>
                                        <td>: {{ $profile->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: {{ $profile->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $profile->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto Profil</th>
                                        <td>:
                                            <div style="display: flex; align-items: flex-start;">
                                                <!-- Foto Profil -->
                                                <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil"
                                                    style="width: 120px; height: 150px; object-fit: cover; margin-left: 10px; margin-top: -15px;">

                                                <!-- Form Hapus Foto -->
                                                <form id="delete-photo-form" action="/dashboard/profile/delete-photo"
                                                    method="POST" style="margin-left: 15px; margin-top: -15px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        id="delete-photo-button">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">Belum ada data profile yang tersedia.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
