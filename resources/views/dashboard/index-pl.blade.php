@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Dashboard</h2>
    <hr class="my-4">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Admin Pendaftaran</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahAdminPendaftaran }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Pembimbing Lapangan</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahPembimbingLapangan }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Peserta Magang</h3>
                    <div class="d-inline-block">
                        <h3 class="text-white">{{ $jumlahPesertaMagang }}</h3>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Panduan SIMAGANG - Pembimbing Lapangan</h4>
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
                                        <h5 class="modal-title">Panduan Penggunaan SIMAGANG</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        1. Pembimbing lapangan dapat melihat daftar pengguna pada menu kelola pengguna. <br>
                                        2. Pembimbing lapangan dapat melihat daftar peserta magang pada menu verifikasi
                                        peserta. <br>
                                        3. Pembimbing lapangan dapat melihat data ruangan pada menu data ruangan. <br>
                                        4. Pembimbing lapangan dapat membuat data jadwal peserta pada menu jadwal peserta.
                                        <br>
                                        5. Pembimbing lapangan dapat mengawasi atau mengelola kegiatan peserta pada menu
                                        kegiatan harian. <br>
                                        6. Pembimbing lapangan dapat memberikan penilaian kepada peserta
                                        magang pada menu penilaian akhir.
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
    </div> --}}
@endsection
