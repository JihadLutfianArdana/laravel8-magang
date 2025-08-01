@extends('dashboard.layouts.kop-print')

@section('container')
    <h2 class="judul-laporan">Laporan Rekapitulasi Surat Balasan Magang</h2>
    <br>
    <br>

    @if ($tanggal_awal_balasan && $tanggal_akhir_balasan)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal_balasan)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir_balasan)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil && $tanggal_terbesar && $tanggal_terkecil != $tanggal_terbesar)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_terbesar)->translatedFormat('d F Y') }}
        </p>
    @elseif ($tanggal_terkecil)
        <p><strong>Tanggal :</strong>
            {{ \Carbon\Carbon::parse($tanggal_terkecil)->translatedFormat('d F Y') }}
        </p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary rounded-top">
                <tr>
                    <th>No</th>
                    <th>Tanggal Surat</th>
                    <th>Nomor Surat</th>
                    <th>Hal</th>
                    <th>Nama Peserta</th>
                    <th>Tanggal Mendaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratBalasanList as $index => $surat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->hal }}</td>
                        <td>{{ $surat->peserta->nama_lengkap ?? '-' }}</td>
                        <td>
                            {{ optional(optional($surat->peserta)->created_at)->translatedFormat('l, d F Y') ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <!-- Bagian tanda tangan di sebelah kanan bawah -->
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
