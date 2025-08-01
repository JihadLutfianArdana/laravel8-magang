@extends('dashboard.layouts.kop-print')

@section('container')
    <div class="text-center">
        <h1 class="judul-laporan">Laporan Surat Balasan Magang</h1>
    </div>

    <!-- Tanggal di sebelah kanan atas -->
    <div style="text-align: right; margin-bottom: 20px;">
        <p>Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <div>
        <!-- Informasi surat -->
        <table style="width: 100%; border-collapse: collapse; border: none;">
            <tr>
                <td style="width: 30%; border: none;"><strong>Nomor Surat</strong></td>
                <td style="width: 70%; border: none;">: {{ $suratBalasan->nomor_surat ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Lampiran</strong></td>
                <td style="border: none;">: {{ $suratBalasan->lampiran ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Hal</strong></td>
                <td style="border: none;">: {{ $suratBalasan->hal ?? '-' }}</td>
            </tr>
        </table>
        <p style="white-space: pre-wrap;">{{ $suratBalasan->alamat_surat }}</p>
        <p style="white-space: pre-wrap;">{{ $suratBalasan->kalimat_pembuka }}</p>

        <!-- Tabel peserta -->
        <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">No</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left;">Nama Lengkap</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left;">Kelas/Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">1</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $suratBalasan->peserta->nama_lengkap ?? '-' }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $suratBalasan->peserta->kelas_jurusan ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="white-space: pre-wrap;">{{ $suratBalasan->kalimat_penutup }}</p>

        <!-- Bagian tanda tangan di sebelah kanan bawah -->
        <div style="text-align: right; margin-top: 40px; width: 50%; float: right;">
            <p style="margin: 5px;">Kepala Balai Pelatihan Kesehatan</p>
            <p style="margin: 5px;">Provinsi Kalimantan Selatan</p>
            <br><br><br>
            <p style="margin: 5px;">{{ $kepalaBalai }}</p>
        </div>
    </div>
@endsection
