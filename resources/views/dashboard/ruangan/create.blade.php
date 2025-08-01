@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Tambah Data Ruangan</h2>
    <hr class="my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/data-ruangan" class="btn mb-1 btn-secondary"><i class="bi bi-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="form-validation">
                        <form class="form-valide" action="/dashboard/data-ruangan" method="POST">
                            @csrf
                            <!-- Input NIP -->
                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nip" id="nip"
                                        class="form-control rounded @error('nip') is-invalid @enderror"
                                        value="{{ old('nip') }}" required>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama Pegawai -->
                            <div class="form-group row">
                                <label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pegawai" id="nama_pegawai"
                                        class="form-control rounded @error('nama_pegawai') is-invalid @enderror"
                                        value="{{ old('nama_pegawai') }}" required>
                                    @error('nama_pegawai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama Ruangan -->
                            <div class="form-group row">
                                <label for="nama_ruangan" class="col-sm-3 col-form-label">Nama Ruangan</label>
                                <div class="col-sm-6">
                                    <select name="nama_ruangan" id="nama_ruangan"
                                        class="form-control rounded @error('nama_ruangan') is-invalid @enderror" required>
                                        <option value="-" {{ old('nama_ruangan') == '-' ? 'selected' : '' }}>-</option>
                                        <option value="Ruang Kepala Bapelkes"
                                            {{ old('nama_ruangan') == 'Ruang Kepala Bapelkes' ? 'selected' : '' }}>Ruang
                                            Kepala Bapelkes</option>
                                        <option value="Ruang Seksi Penyelenggara Pelatihan"
                                            {{ old('nama_ruangan') == 'Ruang Seksi Penyelenggara Pelatihan' ? 'selected' : '' }}>
                                            Ruang Seksi Penyelenggara Pelatihan</option>
                                        <option value="Ruang Seksi Pengendalian Mutu"
                                            {{ old('nama_ruangan') == 'Ruang Seksi Pengendalian Mutu' ? 'selected' : '' }}>
                                            Ruang Seksi Pengendalian Mutu</option>
                                        <option value="Ruang TU" {{ old('nama_ruangan') == 'Ruang TU' ? 'selected' : '' }}>
                                            Ruang TU</option>
                                        <option value="Ruang TU Perencanaan"
                                            {{ old('nama_ruangan') == 'Ruang TU Perencanaan' ? 'selected' : '' }}>Ruang TU
                                            Perencanaan</option>
                                        <option value="Ruang TU Bendahara Barang"
                                            {{ old('nama_ruangan') == 'Ruang TU Bendahara Barang' ? 'selected' : '' }}>
                                            Ruang TU Bendahara Barang</option>
                                    </select>
                                    @error('nama_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Jabatan -->
                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-6">
                                    <select name="jabatan" id="jabatan"
                                        class="form-control rounded @error('jabatan') is-invalid @enderror" required>
                                        <option value="-" {{ old('jabatan') == '-' ? 'selected' : '' }}>-</option>
                                        <option value="KADIS Bapelkes"
                                            {{ old('jabatan') == 'KADIS Bapelkes' ? 'selected' : '' }}>KADIS Bapelkes
                                        </option>
                                        <option value="KASI Penyelenggara Pelatihan"
                                            {{ old('jabatan') == 'KASI Penyelenggara Pelatihan' ? 'selected' : '' }}>
                                            KASI Penyelenggara Pelatihan</option>
                                        <option value="KASI Pengendalian Mutu"
                                            {{ old('jabatan') == 'KASI Pengendalian Mutu' ? 'selected' : '' }}>
                                            KASI Pengendalian Mutu</option>
                                        <option value="KASI Tata Usaha"
                                            {{ old('jabatan') == 'KASI Tata Usaha' ? 'selected' : '' }}>Kepala
                                            Seksi
                                            Tata Usaha</option>
                                        <option value="KASI Tata Usaha (Perencanaan)"
                                            {{ old('jabatan') == 'KASI Tata Usaha (Perencanaan)' ? 'selected' : '' }}>
                                            KASI Tata Usaha (Perencanaan)</option>
                                        <option value="KASI Tata Usaha (Bendahara Barang)"
                                            {{ old('jabatan') == 'KASI Tata Usaha (Bendahara Barang)' ? 'selected' : '' }}>
                                            KASI Tata Usaha (Bendahara Barang)</option>
                                        <option value="Staff" {{ old('jabatan') == 'Staff' ? 'selected' : '' }}>Staff
                                        </option>
                                    </select>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Peran Khusus -->
                            <div class="form-group row">
                                <label for="peran_khusus" class="col-sm-3 col-form-label">Peran Khusus</label>
                                <div class="col-sm-6">
                                    <select name="peran_khusus" id="peran_khusus"
                                        class="form-control rounded @error('peran_khusus') is-invalid @enderror" required>
                                        <option value="-" {{ old('peran_khusus') == '-' ? 'selected' : '' }}>-
                                        </option>
                                        <option value="Pembimbing Lapangan"
                                            {{ old('peran_khusus') == 'Pembimbing Lapangan' ? 'selected' : '' }}>Pembimbing
                                            Lapangan</option>
                                    </select>
                                    @error('peran_khusus')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
@endsection
