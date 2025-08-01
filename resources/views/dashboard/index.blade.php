@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Dashboard</h2>
    <hr class="my-4">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Peserta Magang</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $detail ? $detail->jumlah_anggota : 'Belum Ditentukan' }}</h3>
                        <p class="text-white mb-0">
                            {{ $detail && $detail->tanggal_mulai && $detail->tanggal_selesai
                                ? \Carbon\Carbon::parse($detail->tanggal_mulai)->format('d-m-Y') .
                                    ' | ' .
                                    \Carbon\Carbon::parse($detail->tanggal_selesai)->format('d-m-Y')
                                : '-' }}
                        </p>

                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Nama Pembimbing Lapangan</h3>
                    <div class="d-inline-block">
                        <h4 class="text-white">{{ $detail ? $detail->nama_pembimbing : 'Belum Ditentukan' }}</h4>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Lengkapi Profil Anda</h3>
                    <div class="d-inline-block">
                        <a href="/dashboard/profile">
                            <h3 class="text-white" style="text-decoration: underline">Klik disini</h3>
                        </a>
                        {{-- <a href="https://wa.me/082149325312" target="_blank">Hubungi via WhatsApp</a> --}}

                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Panduan SIMAGANG - Peserta Magang</h4>
                    <hr class="my-4">
                    <div class="bootstrap-modal">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">Klik
                            disini</button>
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Panduan Penggunaan SIMAGANG - Peserta</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        1 . Peserta wajib mengisi data diri anda pada bagian menu profile anda. <br>
                                        2 . Peserta wajib mengisi data detail magang pada bagian menu detail magang. <br>
                                        3 . Selama kegiatan magang, peserta harus mengisikan absensi dan agenda kegiatan
                                        harian.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
