@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Kegiatan Harian</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h4 class="card-title">Data Kegiatan Harian</h4>

            <a href="/dashboard/kegiatan/create" class="btn mb-2 btn-success"><i class="bi bi-plus-circle"></i>
                Tambah
                Data
                Kegiatan</a>
            <a href="/dashboard/kegiatan/print" class="btn mb-2 btn-dark">
                <i class="bi bi-printer"></i> Cetak Data Kegiatan
            </a>


            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Deskripsi Kegiatan</th>
                            <th>Lokasi Kegiatan</th>
                            <th>Dokumentasi Kegiatan</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->deskripsi_kegiatan }}</td>
                                <td>{{ $item->lokasi_kegiatan }}</td>
                                <td>
                                    @if ($item->dok_kegiatan)
                                        <a href="#" data-toggle="modal"
                                            data-target="#dokKegiatanModal{{ $item->id }}">
                                            <img src="{{ asset('storage/' . $item->dok_kegiatan) }}" alt="Dokumentasi"
                                                class="img-thumbnail" style="width: 100px; height: auto;">
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="dokKegiatanModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="dokKegiatanModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="dokKegiatanModalLabel{{ $item->id }}">
                                                            Dokumentasi Kegiatan
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $item->dok_kegiatan) }}"
                                                            alt="Dokumentasi Kegiatan" class="img-fluid">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="delete-photo-form"
                                                            action="/dashboard/kegiatan/{{ $item->id }}/delete-foto"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                id="delete-photo-button">
                                                                <i class="bi bi-trash"></i> Hapus Foto
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->revisi ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->status_selesai)
                                        <span class="badge bg-success">Acc</span>
                                    @else
                                        <span class="badge bg-danger">Belum Acc</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <!-- Tombol Edit -->
                                        <a href="/dashboard/kegiatan/{{ $item->id }}/edit"
                                            class="btn btn-warning btn-sm mr-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="/dashboard/kegiatan/{{ $item->id }}" method="POST"
                                            class="d-inline" id="delete-Form-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
