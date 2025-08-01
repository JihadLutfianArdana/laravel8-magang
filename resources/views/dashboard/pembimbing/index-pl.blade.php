@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Penilaian Pembimbing Lapangan</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Penilaian Kinerja Pembimbing Lapangan</h4>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Peserta Magang</th>
                            <th>Universitas / Sekolah</th>
                            <th>Sudah Menilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            @php
                                $sudahMenilai = \App\Models\PenilaianPembimbing::where('user_id', $user->id)->exists();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->detailMagang ? $user->detailMagang->asal_sekolah_universitas : 'Tidak ada data' }}
                                </td>
                                <td>{!! $sudahMenilai ? '<span class="text-success fw-bold">&#10004;</span>' : '-' !!}</td>
                                <td class="text-center">
                                    <a href="/dashboard/penilaian-pembimbing/lihat-penilaian/pembimbing-lapangan/{{ $user->id }}"
                                        class="btn btn-success mr-1">
                                        <i class="bi bi-star"></i> Lihat Penilaian Anda
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
