@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Absensi Harian</h2>
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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h4 class="card-title">Riwayat Absensi</h4>

            <!-- Tombol Form Absensi -->
            <a href="#" class="btn mb-2 btn-success" data-toggle="modal" data-target="#formAbsensiModal">
                <i class="bi bi-pencil-square"></i> Absen Masuk
            </a>
            <a href="#" class="btn mb-2 btn-danger"
                onclick="event.preventDefault(); document.getElementById('absenKeluarForm').submit();">
                <i class="bi bi-pencil-square"></i> Absen Keluar
            </a>
            <form id="absenKeluarForm" action="/dashboard/absensi/keluar" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="/dashboard/absensi/{{ $user_id }}/print" class="btn mb-2 btn-dark">
                <i class="bi bi-printer"></i> Cetak Data Absensi
            </a>


            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>Hari dan Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Alasan</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $absen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($absen->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $absen->waktu_masuk }}</td>
                                <td>{{ $absen->waktu_keluar ?? '-' }}</td>
                                <td>
                                    {{ $absen->status }}
                                </td>
                                <td>{{ $absen->keterangan ?? '-' }}</td>
                                <td>{{ $absen->alasan ?? '-' }}</td>
                                <td>
                                    @if ($absen->bukti)
                                        <a href="#" data-toggle="modal" data-target="#gambarModal"
                                            data-bukti="{{ asset('storage/' . $absen->bukti) }}">Lihat Bukti</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
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
                    <!-- Form Absensi -->
                    <!-- Form Absensi -->
                    <form action="/dashboard/absensi/store" method="POST" enctype="multipart/form-data" id="formAbsensi">
                        @csrf
                        <div class="mb-3">
                            <label for="hari_tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="hari_tanggal" name="hari_tanggal"
                                class="form-control rounded @error('hari_tanggal') is-invalid @enderror" required>
                            @error('hari_tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select id="status" name="status"
                                class="form-control rounded @error('status') is-invalid @enderror" required
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

                        <!-- Alasan dan Bukti, hanya tampil jika status Sakit atau Izin -->
                        <div id="additionalInputs" style="display: none;">
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea id="alasan" name="alasan" class="form-control rounded @error('alasan') is-invalid @enderror"></textarea>
                                @error('alasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti (Foto)</label>
                                <input type="file" id="bukti" name="bukti"
                                    class="form-control rounded @error('bukti') is-invalid @enderror" accept="image/*">
                                @error('bukti')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info rounded-3 px-4 mr-2"><i
                                    class="bi bi-download"></i> Simpan</button>
                            <button type="reset" class="btn btn-warning rounded-3 px-4"><i
                                    class="bi bi-arrow-counterclockwise"></i>
                                Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Gambar Bukti -->
    <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="gambarModalLabel">Bukti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="gambarBukti" src="" alt="Bukti Absensi" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
@endsection
