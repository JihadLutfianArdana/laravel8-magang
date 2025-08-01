@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Detail Profil Peserta</h2>
    <hr class="my-4">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/verifikasi-peserta/admin-pendaftaran" class="btn mb-1 btn-secondary"><i
                                class="bi bi-arrow-left"></i>
                            Kembali</a>
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
                                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil"
                                                style="width: 120px; height: 150px; object-fit: cover;">
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
