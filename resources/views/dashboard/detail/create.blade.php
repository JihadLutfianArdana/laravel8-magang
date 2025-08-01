@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Buat / Edit Detail Magang</h2>
    <hr class="my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/detail/" class="btn mb-1 btn-secondary"><i class="bi bi-arrow-left"></i></i>
                            Kembali</a>
                    </div>
                    <div class="form-validation">
                        <form class="form-valide" action="/dashboard/detail" method="post">
                            @csrf
                            <!-- Dropdown untuk NISM -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nism">NISM</label>
                                <div class="col-lg-6">
                                    <select class="form-control rounded" id="nism" name="nism" required>
                                        <option value="">Pilih NISM</option>
                                        @foreach ($nismList as $nism)
                                            <option value="{{ $nism }}"
                                                {{ old('nism', isset($detail) ? $detail->nism : '') == $nism ? 'selected' : '' }}>
                                                {{ $nism }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Input untuk Nama Lengkap -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nama_peserta">Nama Lengkap</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control rounded" id="nama_peserta" name="nama_peserta"
                                        value="{{ old('nama_peserta', isset($detail) ? $detail->nama_peserta : (isset($pendaftaran) ? $pendaftaran->nama_lengkap : '')) }}"
                                        placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>

                            <!-- Input untuk Asal Sekolah / Universitas -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="asal_sekolah_universitas">Asal Sekolah /
                                    Universitas</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control rounded" id="asal_sekolah_universitas"
                                        name="asal_sekolah_universitas"
                                        value="{{ old('asal_sekolah_universitas', isset($detail) ? $detail->asal_sekolah_universitas : (isset($pendaftaran) ? $pendaftaran->asal_sekolah_universitas : '')) }}"
                                        placeholder="Nama Sekolah atau Universitas" readonly>
                                </div>
                            </div>

                            <!-- Input untuk Kelas / Jurusan -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="kelas_jurusan">Kelas / Jurusan</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('kelas_jurusan') is-invalid @enderror"
                                        id="kelas_jurusan" name="kelas_jurusan"
                                        value="{{ old('kelas_jurusan', isset($detail) ? $detail->kelas_jurusan : (isset($pendaftaran) ? $pendaftaran->kelas_jurusan : '')) }}"
                                        placeholder="Kelas atau Jurusan">
                                    @error('kelas_jurusan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Nama Pembimbing -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nama_pembimbing">Nama Pembimbing
                                    Lapangan</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                        class="form-control rounded @error('nama_pembimbing') is-invalid @enderror"
                                        id="nama_pembimbing" name="nama_pembimbing"
                                        value="{{ old('nama_pembimbing', isset($pembimbingLapangan) ? $pembimbingLapangan->nama_pegawai : '') }}"
                                        readonly placeholder="Nama Pembimbing Lapangan">
                                    @error('nama_pembimbing')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Jumlah Anggota Magang -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="jumlah_anggota">Jumlah Anggota Magang</label>
                                <div class="col-lg-6">
                                    <input type="number"
                                        class="form-control rounded @error('jumlah_anggota') is-invalid @enderror"
                                        id="jumlah_anggota" name="jumlah_anggota"
                                        value="{{ old('jumlah_anggota', $detail ? $detail->jumlah_anggota : '') }}"
                                        placeholder="Jumlah Anggota Magang">
                                    @error('jumlah_anggota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dropdown untuk Status -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="status">Status</label>
                                <div class="col-lg-6">
                                    <select name="status" id="status"
                                        class="form-control rounded @error('status') is-invalid @enderror" required>
                                        <option value="Aktif"
                                            {{ old('status', $detail ? $detail->status : '') == 'Aktif' ? 'selected' : '' }}>
                                            Aktif</option>
                                        <option value="Tidak Aktif"
                                            {{ old('status', $detail ? $detail->status : '') == 'Tidak Aktif' ? 'selected' : '' }}>
                                            Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Tanggal Mulai Magang -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tanggal_mulai">Tanggal Mulai Magang</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_mulai') is-invalid @enderror"
                                        id="tanggal_mulai" name="tanggal_mulai"
                                        value="{{ old('tanggal_mulai', isset($detail) ? $detail->tanggal_mulai : (isset($pendaftaran) ? $pendaftaran->tanggal_mulai : '')) }}">
                                    @error('tanggal_mulai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input untuk Tanggal Selesai Magang -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tanggal_selesai">Tanggal Selesai Magang</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_selesai') is-invalid @enderror"
                                        id="tanggal_selesai" name="tanggal_selesai"
                                        value="{{ old('tanggal_selesai', isset($detail) ? $detail->tanggal_selesai : (isset($pendaftaran) ? $pendaftaran->tanggal_selesai : '')) }}">
                                    @error('tanggal_selesai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-info"><i class="bi bi-download"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nismDropdown = document.getElementById('nism');
            const namaPesertaInput = document.getElementById('nama_peserta');
            const asalSekolahInput = document.getElementById('asal_sekolah_universitas');

            // Event listener ketika NIS/NIM dipilih
            nismDropdown.addEventListener('change', function() {
                const selectedNism = this.value;

                if (selectedNism) {
                    // Cari data berdasarkan NISM yang dipilih
                    fetch(`/api/profile-peserta/${selectedNism}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data) {
                                namaPesertaInput.value = data.nama_peserta;
                                asalSekolahInput.value = data.asal_sekolah_universitas;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    // Kosongkan input jika tidak ada NISM yang dipilih
                    namaPesertaInput.value = '';
                    asalSekolahInput.value = '';
                }
            });
        });
    </script>
@endsection
