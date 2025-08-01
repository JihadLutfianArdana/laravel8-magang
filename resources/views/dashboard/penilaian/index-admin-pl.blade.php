@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Penilaian Akhir Peserta</h2>
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

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h4 class="card-title">Data Penilaian Akhir Peserta</h4>
            <div class="d-flex justify-content-start mt-4">
                <a href="/dashboard/penilaian-akhir/peringkat-peserta/pembimbing-lapangan" class="btn btn-success">
                    <i class="bi bi-award"></i> Peserta Terbaik
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Peserta Magang</th>
                            <th>Universitas / Sekolah</th>
                            <th>Periode Magang</th>
                            <th>Sudah Dinilai</th>
                            {{-- <th>Sertifikat</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            @php
                                $sudahDinilai = \App\Models\PenilaianPeserta::where(
                                    'detail_magang_id',
                                    $user->detailMagang->id ?? null,
                                )->exists();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->detailMagang ? $user->detailMagang->asal_sekolah_universitas : 'Tidak ada data' }}
                                </td>
                                <td>
                                    @if (optional($user->detailMagang)->tanggal_mulai && optional($user->detailMagang)->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($user->detailMagang->tanggal_mulai)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($user->detailMagang->tanggal_selesai)->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{!! $sudahDinilai ? '<span class="text-success fw-bold">&#10004;</span>' : '-' !!}</td>
                                {{-- ✅ Tambahkan kolom Sertifikat di sini --}}
                                {{-- <td class="text-center">
                                    @if ($sudahDinilai)
                                        @php
                                            $penilaian = \App\Models\PenilaianPeserta::where(
                                                'detail_magang_id',
                                                $user->detailMagang->id ?? null,
                                            )->first();
                                            $sudahAdaSertifikat = $penilaian && $penilaian->nomor_sertifikat;
                                        @endphp

                                        <form method="POST" action="/dashboard/penilaian-akhir/pembimbing-lapangan"
                                            onsubmit="{{ $sudahAdaSertifikat ? 'alert(\'Sertifikat sudah dibuat!\'); return false;' : '' }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-award"></i> Buat Sertifikat
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td> --}}
                                <td class="text-center">
                                    <a href="/dashboard/penilaian-akhir/form-penilaian/pembimbing-lapangan/{{ $user->id }}"
                                        class="btn btn-success mr-1">
                                        <i class="bi bi-trophy"></i> Penilaian Kinerja
                                    </a>
                                    <a href="/dashboard/penilaian-akhir/cetak-penilaian/pembimbing-lapangan/{{ $user->id }}"
                                        class="btn btn-dark mr-1">
                                        <i class="bi bi-printer"></i> Cetak Penilaian
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card mt-3">
        <div class="card-body">
            <h4 class="card-title">Daftar Sertifikat Magang</h4>

            <div class="d-flex align-items-center gap-3 mb-3">
                <a href="/dashboard/penilaian-akhir/laporan-sertifikat-magang/cetak/pembimbing-lapangan?tanggal_awal_sertifikat={{ request('tanggal_awal_sertifikat') }}&tanggal_akhir_sertifikat={{ request('tanggal_akhir_sertifikat') }}"
                    class="btn btn-dark" target="_blank">
                    <i class="bi bi-printer"></i> Cetak Data
                </a>
                <form action="{{ url()->current() }}" method="GET" class="form-inline">
                    <label class="ml-4">Periode:</label>
                    <input type="date" name="tanggal_awal_sertifikat" class="form-control ml-2"
                        value="{{ request('tanggal_awal_sertifikat') }}">
                    <span class="mx-1">s/d</span>
                    <input type="date" name="tanggal_akhir_sertifikat" class="form-control"
                        value="{{ request('tanggal_akhir_sertifikat') }}">
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Sertifikat</th>
                            <th>Nomor Sertifikat</th>
                            <th>Nama Peserta</th>
                            <th>Asal Sekolah / Universitas</th>
                            <th>Jurusan</th>
                            <th>Periode Magang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarSertifikat as $i => $sertifikat)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($sertifikat->tanggal_sertifikat)->translatedFormat('l, d F Y') ?? '-' }}
                                </td>
                                <td>{{ $sertifikat->nomor_sertifikat }}</td>
                                <td>{{ $sertifikat->detailMagang->nama_peserta ?? '-' }}</td>
                                <td>{{ $sertifikat->detailMagang->asal_sekolah_universitas ?? '-' }}</td>
                                <td>{{ $sertifikat->detailMagang->kelas_jurusan ?? '-' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($sertifikat->detailMagang->tanggal_mulai)->translatedFormat('d M Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($sertifikat->detailMagang->tanggal_selesai)->translatedFormat('d M Y') }}
                                </td>
                                <td>
                                    <a href="/dashboard/penilaian-akhir/sertifikat/pembimbing-lapangan/{{ $sertifikat->detailMagang->user_id }}"
                                        class="btn btn-dark" target="_blank">
                                        <i class="bi bi-printer"></i> Cetak Sertifikat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
@endsection
