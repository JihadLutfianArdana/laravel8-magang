@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Penilaian Peserta Magang</h2>
    <hr class="my-4">

    {{-- Card Kompetensi Peserta Magang --}}
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Kompetensi Peserta Magang</h4>
            <br>
            <ol>
                <li class="d-flex justify-content-between align-items-center">
                    <span>1 . Peserta Magang melakukan absensi hadir minimal 20 kali</span>
                </li>
                <br>
                <li class="d-flex justify-content-between align-items-center">
                    <span>2 . Peserta Magang mengisi kegiatan harian minimal 20 kali</span>
                </li>
                <br>
                <li class="d-flex justify-content-between align-items-center">
                    <span>3 . Peserta Magang mengikuti aturan yang ada di BAPELKES</span>
                </li>
                <br>
                <li class="d-flex justify-content-between align-items-center">
                    <span>4 . Peserta Magang aktif berkomunikasi dengan pegawai setempat</span>
                </li>
                <br>
                <li class="d-flex justify-content-between align-items-center">
                    <span>5 . Peserta Magang bertanggung jawab terhadap tugas yang diberikan</span>
                </li>
            </ol>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4>Penilaian Kinerja Anda - {{ $user->nama }}</h4>
            <a href="/dashboard/penilaian-magang-peserta/cetak-penilaian/{{ $user->id }}"
                class="btn btn-dark mr-1 mt-2 mb-2">
                <i class="bi bi-printer"></i> Cetak Laporan Penilaian
            </a>
            {{-- @if ($penilaian && $penilaian->is_penilaian_selesai)
                <a href="/dashboard/penilaian-magang-peserta/sertifikat/{{ $user->id }}"
                    class="btn btn-dark mr-1 mt-2 mb-2">
                    <i class="bi bi-file-earmark-text"></i> Cetak Sertifikat
                </a>
            @endif --}}
            @if ($penilaian && $penilaian->nomor_sertifikat)
                <a href="/dashboard/penilaian-magang-peserta/sertifikat/{{ $user->id }}"
                    class="btn btn-dark mr-1 mt-2 mb-2">
                    <i class="bi bi-file-earmark-text"></i> Cetak Sertifikat
                </a>
            @endif
            @if (!empty($linkSertifikatTerbaik))
                <a href="{{ $linkSertifikatTerbaik }}" class="btn btn-success mr-1 mt-2 mb-2">
                    <i class="bi bi-award"></i> Cetak Sertifikat Peserta Terbaik
                </a>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr class="bg-info text-white text-center">
                            <th>Aktivitas Yang Dinilai</th>
                            <th>Nilai (Dalam Bentuk Angka)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Absensi Kehadiran</td>
                            <td class="text-center">{{ $penilaian->nilai_kehadiran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Mengisi Logbook Kegiatan</td>
                            <td class="text-center">{{ $penilaian->nilai_kegiatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Mengikuti Aturan Yang Diberikan</td>
                            <td class="text-center">{{ $penilaian->nilai_sikap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Disiplin Waktu</td>
                            <td class="text-center">{{ $penilaian->nilai_kedisiplinan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kerjasama Tim</td>
                            <td class="text-center">{{ $penilaian->nilai_kerjasama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Membangun Komunikasi Dengan Sesama</td>
                            <td class="text-center">{{ $penilaian->nilai_komunikasi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggung Jawab Terhadap Tugas</td>
                            <td class="text-center">{{ $penilaian->nilai_tanggung_jawab ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td class="text-center">{{ $penilaian->komentar ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
