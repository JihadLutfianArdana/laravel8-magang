@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Data Absensi Harian Peserta</h2>
    <hr class="my-4">

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="/dashboard/kegiatan-pembimbing" class="btn mb-1 btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($absensiPeserta->isNotEmpty())
                <h4 class="card-title">
                    {{ optional($absensiPeserta->first()->detailMagang)->nism ?? 'NISM' }} -
                    {{ optional($absensiPeserta->first()->detailMagang)->nama_peserta ?? 'Nama Peserta' }}
                </h4>
            @else
                <h4>NISM - Nama Peserta</h4>
            @endif

            <div class="d-flex mb-3">
                <a href="#" class="btn btn-success mr-2" data-toggle="modal" data-target="#formAbsensiModal">
                    <i class="bi bi-pencil-square"></i> Absen Masuk
                </a>
                <a href="#" class="btn btn-danger mr-2"
                    onclick="event.preventDefault(); document.getElementById('absenKeluarForm').submit();">
                    <i class="bi bi-pencil-square"></i> Absen Keluar
                </a>
                <form id="absenKeluarForm" action="/dashboard/absensi-pembimbing/keluar/{{ $user_id }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
                <a href="/dashboard/absensi-pembimbing/{{ $user_id }}/print" class="btn btn-dark">
                    <i class="bi bi-printer"></i> Cetak Data Absensi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Hari dan Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Alasan</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensiPeserta as $absen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($absen->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $absen->waktu_masuk }}</td>
                                <td>{{ $absen->waktu_keluar ?? '-' }}</td>
                                <td>{{ $absen->status }}</td>
                                <td>{{ $absen->keterangan ?? '-' }}</td>
                                <td>{{ $absen->alasan ?? '-' }}</td>
                                <td>
                                    @if ($absen->bukti)
                                        <a href="#" data-toggle="modal"
                                            data-target="#gambarModal-{{ $absen->id }}">
                                            Lihat Bukti
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="/dashboard/absensi-pembimbing/{{ $absen->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="/dashboard/absensi-pembimbing/{{ $absen->id }}" method="POST"
                                        class="d-inline" id="delete-Form-{{ $absen->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $absen->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk Gambar Bukti -->
                            <div class="modal fade" id="gambarModal-{{ $absen->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="gambarModalLabel-{{ $absen->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-white">
                                            <h5 class="modal-title" id="gambarModalLabel-{{ $absen->id }}">Bukti</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/' . $absen->bukti) }}" alt="Bukti Absensi"
                                                class="img-fluid" />
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/dashboard/absensi-pembimbing/{{ $absen->id }}/delete-foto"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus Bukti
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Absensi -->
    <div class="modal fade" id="formAbsensiModal" tabindex="-1" role="dialog" aria-labelledby="formAbsensiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="formAbsensiLabel">Form Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/absensi-pembimbing/store/{{ $user_id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="hari_tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="hari_tanggal" name="hari_tanggal"
                                class="form-control @error('hari_tanggal') is-invalid @enderror" required>
                            @error('hari_tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select id="status" name="status"
                                class="form-control @error('status') is-invalid @enderror" required
                                onchange="toggleAdditionalInputs(this)">
                                <option value="" disabled selected>Choose...</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="additionalInputs" style="display: none;">
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea id="alasan" name="alasan" class="form-control @error('alasan') is-invalid @enderror"></textarea>
                                @error('alasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti (Foto)</label>
                                <input type="file" id="bukti" name="bukti"
                                    class="form-control @error('bukti') is-invalid @enderror" accept="image/*">
                                @error('bukti')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info rounded-3 px-4 mr-2">
                                <i class="bi bi-download"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-warning rounded-3 px-4">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
