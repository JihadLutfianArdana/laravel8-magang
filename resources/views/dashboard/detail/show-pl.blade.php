@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Detail Magang Peserta</h2>
    <hr class="my-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/kegiatan-pembimbing" class="btn mb-1 btn-secondary"><i
                                class="bi bi-arrow-left"></i></i>
                            Kembali</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if ($detail)
                                    <tr>
                                        <th>NISM</th>
                                        <td>: {{ $detail->nism }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Peserta</th>
                                        <td>: {{ $detail->nama_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah/Universitas</th>
                                        <td>: {{ $detail->asal_sekolah_universitas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas/Jurusan</th>
                                        <td>: {{ $detail->kelas_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pembimbing Lapangan</th>
                                        <td>: {{ $detail->nama_pembimbing }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Anggota</th>
                                        <td>: {{ $detail->jumlah_anggota }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:
                                            @if ($detail->status == 'Aktif')
                                                <span class="badge badge-success px-2">Aktif</span>
                                            @else
                                                <span class="badge badge-danger px-2">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>: {{ \Carbon\Carbon::parse($detail->tanggal_mulai)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>: {{ \Carbon\Carbon::parse($detail->tanggal_selesai)->format('d-m-Y') }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <div class="alert alert-warning">Peserta belum mengisi detail magang.</div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
