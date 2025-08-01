@extends('dashboard.layouts.kop-print')

@section('container')
    <h2 class="judul-laporan">Laporan Rekapitulasi Sertifikat Magang
    </h2>
    <br><br>

    @if ($tanggal_awal_sertifikat && $tanggal_akhir_sertifikat)
        <p><strong>Periode:</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_sertifikat)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_sertifikat)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil && $tanggal_terbesar && $tanggal_terkecil != $tanggal_terbesar)
        <p><strong>Periode:</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_terbesar)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil)
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }}
        </p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Tanggal Sertifikat</th>
                    <th>Nomor Sertifikat</th>
                    <th>Nama Peserta</th>
                    <th>Asal Sekolah / Universitas</th>
                    <th>Jurusan</th>
                    <th>Periode Magang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftarSertifikat as $i => $sertifikat)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($sertifikat->tanggal_sertifikat)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $sertifikat->nomor_sertifikat }}</td>
                        <td>{{ $sertifikat->detailMagang->nama_peserta ?? '-' }}</td>
                        <td>{{ $sertifikat->detailMagang->asal_sekolah_universitas ?? '-' }}</td>
                        <td>{{ $sertifikat->detailMagang->kelas_jurusan ?? '-' }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($sertifikat->detailMagang->tanggal_mulai)->translatedFormat('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($sertifikat->detailMagang->tanggal_selesai)->translatedFormat('d M Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="text-align: right; margin-top: 40px; width: 50%; float: right;">
        <p style="margin: 5px;">Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin: 5px;">Kepala Balai Pelatihan Kesehatan</p>
        <p style="margin: 5px;">Provinsi Kalimantan Selatan</p>
        <br><br><br>
        <p style="margin: 5px;">{{ $kepalaBalai }}</p>
    </div>

    <script>
        window.print();
    </script>
@endsection
