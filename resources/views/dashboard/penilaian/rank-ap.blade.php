@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Daftar Peserta Magang Terbaik</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Peserta Magang Terbaik</h4>

            {{-- Tombol kembali --}}
            <div class="d-flex justify-content-start mt-3 mb-4">
                <a href="/dashboard/penilaian-akhir/admin-pendaftaran" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif

            {{-- Form pilih periode --}}
            <form method="GET" action="/dashboard/penilaian-akhir/peringkat-peserta/admin-pendaftaran">
                <div class="form-group row mt-4">
                    <label class="col-lg-4 col-form-label" for="periode">Pilih Periode Magang</label>
                    <div class="col-lg-6">
                        <select class="form-control rounded" id="periode" name="periode" onchange="this.form.submit()">
                            <option value="">-- Pilih Periode --</option>
                            <option value="semua" {{ $selectedPeriode == 'semua' ? 'selected' : '' }}>Semua Periode
                            </option>
                            @foreach ($periodes as $periode)
                                @php
                                    $value = $periode->tanggal_mulai . '_' . $periode->tanggal_selesai;
                                    $label =
                                        \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') .
                                        ' - ' .
                                        \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y');
                                @endphp
                                <option value="{{ $value }}" {{ $selectedPeriode == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            {{-- Tombol Hitung Nilai (hanya jika periode tertentu) --}}
            {{-- @if ($selectedPeriode && $selectedPeriode !== 'semua')
                <form method="GET" action="/dashboard/penilaian-akhir/peringkat-peserta/admin-pendaftaran">
                    <input type="hidden" name="periode" value="{{ $selectedPeriode }}">
                    <div class="form-group row mt-3">
                        <div class="col-lg-10 offset-lg-4">
                            <button type="submit" name="hitung" value="1" class="btn btn-primary">
                                <i class="bi bi-calculator"></i> Hitung Nilai
                            </button>
                        </div>
                    </div>
                </form>
            @endif --}}

            {{-- Filter tanggal (hanya untuk semua periode) --}}
            @if ($selectedPeriode == 'semua')
                <h4 class="mb-4 mt-4">Laporan Perangkingan Peserta Magang Terbaik</h4>

                <div class="d-flex justify-content-start align-items-center mb-4 flex-wrap gap-2">
                    <a href="/dashboard/penilaian-akhir/laporan-perangkingan-peserta-terbaik/admin-pendaftaran?tanggal_awal={{ request('tanggal_awal') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                        class="btn btn-dark mr-3" target="_blank">
                        <i class="bi bi-printer"></i> Cetak Data
                    </a>

                    <form method="GET" action="/dashboard/penilaian-akhir/peringkat-peserta/admin-pendaftaran"
                        class="form-inline d-flex align-items-center flex-wrap">
                        <input type="hidden" name="periode" value="semua">

                        <label class="mb-0 mr-2">Periode:</label>

                        <input type="date" name="tanggal_awal" class="form-control form-control-sm"
                            style="max-width: 160px" value="{{ request('tanggal_awal') }}">

                        <span class="mx-2">s/d</span>

                        <input type="date" name="tanggal_akhir" class="form-control form-control-sm mr-2"
                            style="max-width: 160px" value="{{ request('tanggal_akhir') }}">

                        <button type="submit" class="btn btn-primary ml-2">
                            Filter
                        </button>
                    </form>
                </div>
            @endif

            {{-- Tabel hasil perangkingan --}}
            {{-- @if ($pesertaTerbaik->isNotEmpty()) --}}
            <div class="table-responsive mt-4">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Perangkingan</th>
                            <th>Nama Peserta</th>
                            <th>Asal Sekolah / Universitas</th>
                            <th>Kelas / Jurusan</th>
                            @if ($selectedPeriode == 'semua')
                                <th>Periode Magang</th>
                            @endif
                            <th>Nilai Akhir</th>
                            <th>Peringkat</th>
                            @if ($nilaiSudahAda && $selectedPeriode != 'semua')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesertaTerbaik as $index => $peserta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if (optional($peserta->penilaian)->tanggal_perangkingan)
                                        {{ \Carbon\Carbon::parse($peserta->penilaian->tanggal_perangkingan)->translatedFormat('l, d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ optional($peserta->detailMagang)->nama_peserta ?? '-' }}</td>
                                <td>{{ optional($peserta->detailMagang)->asal_sekolah_universitas ?? '-' }}</td>
                                <td>{{ optional($peserta->detailMagang)->kelas_jurusan ?? '-' }}</td>

                                @if ($selectedPeriode == 'semua')
                                    <td>
                                        @if (optional($peserta->detailMagang)->tanggal_mulai && optional($peserta->detailMagang)->tanggal_selesai)
                                            {{ \Carbon\Carbon::parse($peserta->detailMagang->tanggal_mulai)->format('d M Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($peserta->detailMagang->tanggal_selesai)->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endif

                                <td>
                                    {{ $nilaiSudahAda ? number_format(optional($peserta->penilaian)->nilai_saw ?? 0, 4) : '-' }}
                                </td>
                                <td>
                                    {{ $nilaiSudahAda ? $peserta->peringkat_periode ?? '-' : '-' }}
                                </td>
                                @if ($nilaiSudahAda && $selectedPeriode != 'semua')
                                    <td>
                                        <a href="/dashboard/penilaian-akhir/peringkat-peserta-cetak/admin-pendaftaran/{{ $peserta->id }}?periode={{ $selectedPeriode }}"
                                            class="btn btn-dark btn-sm">
                                            <i class="bi bi-printer"></i> Cetak Sertifikat
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @endif --}}
        </div>
    </div>
@endsection
