@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Data Kegiatan Harian Peserta</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="/dashboard/kegiatan-pembimbing" class="btn mb-1 btn-secondary"><i class="bi bi-arrow-left"></i></i>
                    Kembali</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($kegiatanMagang->isNotEmpty())
                <h4 class="card-title">
                    {{ optional($kegiatanMagang->first()->detailMagang)->nism ?? 'NISM' }} -
                    {{ optional($kegiatanMagang->first()->detailMagang)->nama_peserta ?? 'Nama Peserta' }}
                </h4>
            @else
                <h4>NISM - Nama Peserta</h4>
            @endif

            <a href="/dashboard/kegiatan-pembimbing/print/{{ $user->id }}" class="btn mb-2 btn-dark">
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
                            <th>Revisi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatanMagang as $key => $kegiatan)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}
                                </td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $kegiatan->deskripsi_kegiatan }}</td>
                                <td>{{ $kegiatan->lokasi_kegiatan }}</td>
                                <td>
                                    @if ($kegiatan->dok_kegiatan)
                                        <a href="#" data-toggle="modal"
                                            data-target="#dokKegiatanModal{{ $kegiatan->id }}">
                                            <img src="{{ asset('storage/' . $kegiatan->dok_kegiatan) }}" alt="Dokumentasi"
                                                class="img-thumbnail" style="width: 100px; height: auto;">
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="dokKegiatanModal{{ $kegiatan->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="dokKegiatanModalLabel{{ $kegiatan->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="dokKegiatanModalLabel{{ $kegiatan->id }}">
                                                            Dokumentasi Kegiatan
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $kegiatan->dok_kegiatan) }}"
                                                            alt="Dokumentasi Kegiatan" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#revisiModal{{ $kegiatan->id }}">
                                        <i class="bi bi-pencil"></i> Revisi
                                    </a>

                                    <!-- Modal Revisi -->
                                    <div class="modal fade" id="revisiModal{{ $kegiatan->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="revisiModalLabel{{ $kegiatan->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="revisiModalLabel{{ $kegiatan->id }}">
                                                        Revisi Kegiatan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="/dashboard/kegiatan-pembimbing/kegiatan-magang/{{ $kegiatan->id }}/revisi"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control rounded" id="revisiTextarea{{ $kegiatan->id }}" name="revisi" rows="4"
                                                                style="resize: none; width: 95%;" placeholder="Beritahu peserta apa yang perlu direvisi">{{ $kegiatan->revisi }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="resetRevisi({{ $kegiatan->id }})">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            <i class="bi bi-arrow-counterclockwise"></i> Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-download"></i> Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $kegiatan->status_revisi }}</td>
                                <td class="text-center">
                                    <form
                                        action="/dashboard/kegiatan-pembimbing/kegiatan-magang/{{ $kegiatan->id }}/status"
                                        method="POST" onsubmit="return confirm('Yakin mengubah status?')">
                                        @csrf
                                        @method('PUT')
                                        <input type="checkbox" name="status_selesai" onchange="this.form.submit()"
                                            {{ $kegiatan->status_selesai ? 'checked' : '' }}>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function resetRevisi(id) {
            document.getElementById(`revisiTextarea${id}`).value = ''; // Kosongkan textarea
        }
    </script>
@endsection
