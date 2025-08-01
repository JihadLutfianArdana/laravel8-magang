@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Penilaian Kinerja Pembimbing Lapangan</h2>
    <hr class="my-4">

    @if ($penilaian)
        <div class="card mb-4">
            <div class="card-body">

                <div class="row mb-3 align-items-start">
                    {{-- Kolom Kiri: Informasi Peserta --}}
                    <div class="col-md-12">
                        <h4 class="card-title mb-3">Peserta Yang Menilai : {{ $user->nama }}</h4>
                        <p><strong>Asal Sekolah / Universitas :</strong>
                            {{ $user->detailMagang->asal_sekolah_universitas ?? '-' }}</p>
                        @if ($penilaian->tanggal_penilaian)
                            <p><strong>Tanggal Penilaian:</strong>
                                {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}</p>
                        @endif
                    </div>

                    {{-- Kolom Kanan: Tombol --}}
                    <div class="col-md-4 text-end">
                        <a href="/dashboard/penilaian-pembimbing/admin-pendaftaran" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="/dashboard/penilaian-pembimbing/admin-pendaftaran/{{ $user->id }}/cetak"
                            class="btn btn-dark" target="_blank">
                            <i class="bi bi-printer"></i> Cetak Data
                        </a>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr class="bg-info text-white text-center">
                                <th>Aspek Yang Dinilai</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Keterampilan Pembimbing dalam Memberikan Arahan</td>
                                <td class="text-center">{{ $penilaian->poin_1 }}</td>
                            </tr>
                            <tr>
                                <td>2. Kepedulian dan Sikap terhadap Peserta</td>
                                <td class="text-center">{{ $penilaian->poin_2 }}</td>
                            </tr>
                            <tr>
                                <td>3. Kemampuan dalam Membimbing dan Memberikan Solusi</td>
                                <td class="text-center">{{ $penilaian->poin_3 }}</td>
                            </tr>
                            <tr>
                                <td>4. Kedisiplinan dan Tanggung Jawab Pembimbing</td>
                                <td class="text-center">{{ $penilaian->poin_4 }}</td>
                            </tr>
                            <tr>
                                <td>5. Kesiapan Pembimbing dalam Memberikan Materi dan Bimbingan</td>
                                <td class="text-center">{{ $penilaian->poin_5 }}</td>
                            </tr>
                            <tr>
                                <td>6. Saran</td>
                                <td class="text-center">{{ $penilaian->saran ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <a href="/dashboard/penilaian-pembimbing/admin-pendaftaran" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <p class="text-muted text-center">Belum ada penilaian yang tersimpan.</p>
            </div>
        </div>
    @endif
@endsection
