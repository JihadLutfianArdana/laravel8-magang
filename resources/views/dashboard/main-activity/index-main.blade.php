@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Kegiatan Harian Peserta</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Data Kegiatan Harian Peserta</h4>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Peserta Magang</th>
                            <th>Universitas / Sekolah</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Sisa Hari Magang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            @php
                                $detail = $user->detailMagang;
                                $mulai = $detail ? $detail->tanggal_mulai : null;
                                $selesai = $detail ? $detail->tanggal_selesai : null;
                                $sisaHari = null;

                                if ($mulai && $selesai) {
                                    $tanggalSelesai = \Carbon\Carbon::parse($selesai);
                                    $hariIni = \Carbon\Carbon::today();
                                    $sisaHari = $tanggalSelesai->greaterThanOrEqualTo($hariIni)
                                        ? $hariIni->diffInDays($tanggalSelesai)
                                        : 0;
                                }
                            @endphp
                            <tr class="text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $detail ? $detail->asal_sekolah_universitas : '-' }}</td>
                                <td>{{ $mulai ? \Carbon\Carbon::parse($mulai)->format('d-m-Y') : '-' }}</td>
                                <td>{{ $selesai ? \Carbon\Carbon::parse($selesai)->format('d-m-Y') : '-' }}</td>
                                <td>{{ $sisaHari !== null ? $sisaHari . ' hari' : '-' }}</td>
                                <td>
                                    <!-- Tombol Detail Magang -->
                                    <a href="/dashboard/kegiatan-admin/detail-magang/{{ $user->id }}"
                                        class="btn btn-info mr-1">
                                        <i class="bi bi-eye"></i> Detail Magang
                                    </a>
                                    <!-- Tombol Kegiatan Harian -->
                                    <a href="/dashboard/kegiatan-admin/kegiatan-magang/{{ $user->id }}"
                                        class="btn btn-success">
                                        <i class="bi bi-calendar-check"></i> Kegiatan Harian
                                    </a>
                                    <!-- Tombol Absensi Harian -->
                                    <a href="/dashboard/absensi-admin/{{ $user->id }}" class="btn btn-warning mt-2">
                                        <i class="bi bi-check-circle"></i> Absensi Harian
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
