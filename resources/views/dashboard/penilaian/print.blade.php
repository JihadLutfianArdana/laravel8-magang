@extends('dashboard.layouts.kop-print')

@section('container')
    <div class="text-center">
        <h2 class="judul-laporan">Laporan Penilaian Peserta</h2>
    </div>

    <!-- Tabel Nama Peserta dan NISM -->
    <table style="width: 100%; border-collapse: collapse; border: none;">
        <tr>
            <td style="width: 30%; border: none;"><strong>Nama Peserta</strong></td>
            <td style="width: 70%; border: none;">: {{ $detailMagang->nama_peserta ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>NISM</strong></td>
            <td style="border: none;">: {{ $detailMagang->nism ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Jurusan</strong></td>
            <td style="border: none;">: {{ $detailMagang->asal_sekolah_universitas ?? '-' }} -
                {{ $detailMagang->kelas_jurusan ?? '-' }}</td>
        </tr>

        <!-- Tanggal Magang -->
        <tr>
            <td style="border: none;"><strong>Tanggal Pelaksanaan</strong></td>
            <td style="border: none;">
                {{ optional($detailMagang)->tanggal_mulai ? \Carbon\Carbon::parse($detailMagang->tanggal_mulai)->translatedFormat('d F Y') : 'Tanggal mulai tidak tersedia' }}
                -
                {{ optional($detailMagang)->tanggal_selesai ? \Carbon\Carbon::parse($detailMagang->tanggal_selesai)->translatedFormat('d F Y') : 'Tanggal selesai tidak tersedia' }}
            </td>

        </tr>

        <tr>
            <td colspan="2" style="border: none;">
                Sebagai evaluasi atas pelaksanaan kegiatan, berikut adalah penilaian peserta dengan hasil sebagai
                berikut :
            </td>
        </tr>
    </table>

    <!-- Tabel Penilaian -->
    <table class="table table-bordered">
        <thead>
            <tr class="bg-info text-white text-center">
                <th>No</th>
                <th>Aktivitas Yang Dinilai</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Absensi Kehadiran</td>
                <td class="text-center">{{ $penilaian->nilai_kehadiran ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td>Mengisi Logbook Kegiatan</td>
                <td class="text-center">{{ $penilaian->nilai_kegiatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>Mengikuti Aturan Yang Diberikan</td>
                <td class="text-center">{{ $penilaian->nilai_sikap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>Disiplin Waktu</td>
                <td class="text-center">{{ $penilaian->nilai_kedisiplinan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>Kerjasama Tim</td>
                <td class="text-center">{{ $penilaian->nilai_kerjasama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td>Membangun Komunikasi Dengan Sesama</td>
                <td class="text-center">{{ $penilaian->nilai_komunikasi ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td>Tanggung Jawab Terhadap Tugas</td>
                <td class="text-center">{{ $penilaian->nilai_tanggung_jawab ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-center">7</td>
                <td>Catatan</td>
                <td class="text-center">{{ $penilaian->komentar ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; gap: 50px;">
        <div style="text-align: left; width: 45%; border: none;">
            <p style="margin: 29px; margin-left: 5px;">Pembimbing Lapangan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $pembimbingLapangan }}</p>
        </div>

        <div style="text-align: right; width: 45%; border: none;">
            <p style="margin: 5px;">Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 5px;">Kepala Balai Pelatihan Kesehatan</p>
            <p style="margin: 5px;">Provinsi Kalimantan Selatan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $kepalaBalai }}</p>
        </div>
    </div>
@endsection
