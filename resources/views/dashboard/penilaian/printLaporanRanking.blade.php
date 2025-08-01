@extends('dashboard.layouts.kop-print')

@section('container')
    <h2 class="judul-laporan">Laporan Perangkingan Peserta Magang Terbaik</h2>
    <br>

    @if ($tanggal_awal && $tanggal_akhir)
        <p><strong>Periode :</strong>
            {{ \Carbon\Carbon::parse($tanggal_awal)->translatedFormat('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($tanggal_akhir)->translatedFormat('d F Y') }}
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
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Tanggal Perangkingan</th>
                    <th>Nama Peserta</th>
                    <th>Asal Sekolah / Universitas</th>
                    <th>Kelas / Jurusan</th>
                    <th>Periode Magang</th>
                    <th>Nilai Akhir</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_perangkingan)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $item->detailMagang->nama_peserta ?? '-' }}</td>
                        <td>{{ $item->detailMagang->asal_sekolah_universitas ?? '-' }}</td>
                        <td>{{ $item->detailMagang->kelas_jurusan ?? '-' }}</td>
                        <td>
                            @if ($item->detailMagang && $item->detailMagang->tanggal_mulai && $item->detailMagang->tanggal_selesai)
                                {{ \Carbon\Carbon::parse($item->detailMagang->tanggal_mulai)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($item->detailMagang->tanggal_selesai)->format('d M Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ number_format($item->nilai_saw, 4) }}</td>
                        <td>{{ $item->peringkat_periode ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
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
