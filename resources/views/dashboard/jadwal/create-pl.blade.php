@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Tambah Jadwal Peserta</h2>
    <hr class="my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a href="/dashboard/jadwal-peserta/pembimbing-lapangan" class="btn mb-1 btn-secondary"><i
                                class="bi bi-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="form-validation">
                        <form class="form-valide" action="/dashboard/jadwal-peserta/pembimbing-lapangan" method="post">
                            @csrf
                            <!-- Dropdown NIS/NIM -->
                            <div class="form-group row">
                                <label for="nism" class="col-lg-4 col-form-label">NIS / NIM</label>
                                <div class="col-lg-6">
                                    <select class="form-control rounded @error('nism') is-invalid @enderror" id="nism"
                                        name="nism">
                                        <option value="" disabled selected>Pilih NIS / NIM</option>
                                        @foreach ($details as $detail)
                                            <option value="{{ $detail->id }}" data-nama="{{ $detail->nama_peserta }}"
                                                @if (old('nism') == $detail->id) selected @endif>
                                                {{ $detail->nism }} - {{ $detail->nama_peserta }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nism')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input readonly Nama Peserta -->
                            <div class="form-group row">
                                <label for="nama_peserta" class="col-lg-4 col-form-label">Nama Peserta</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control rounded" id="nama_peserta" name="nama_peserta"
                                        value="{{ old('nama_peserta') }}" readonly>
                                </div>
                            </div>

                            <!-- Dropdown Nama Kepala Ruangan -->
                            <div class="form-group row">
                                <label for="nama_pegawai" class="col-lg-4 col-form-label">Nama Kepala Ruangan /
                                    Staff</label>
                                <div class="col-lg-6">
                                    <select class="form-control rounded @error('nama_pegawai') is-invalid @enderror"
                                        id="nama_pegawai" name="ruangan_id">
                                        <option value="" selected disabled>Pilih Nama Kepala Ruangan</option>
                                        @foreach ($ruangans as $ruangan)
                                            <option value="{{ $ruangan->id }}" data-ruangan="{{ $ruangan->nama_ruangan }}"
                                                @if (old('ruangan_id') == $ruangan->id) selected @endif>
                                                {{ $ruangan->nama_pegawai }} - {{ $ruangan->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input readonly Nama Ruangan -->
                            <div class="form-group row">
                                <label for="nama_ruangan" class="col-lg-4 col-form-label">Nama Ruangan</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control rounded" id="nama_ruangan" name="nama_ruangan"
                                        value="{{ old('nama_ruangan') }}" readonly>
                                </div>
                            </div>

                            <!-- Input Tanggal Awal -->
                            <div class="form-group row">
                                <label for="tanggal_awal" class="col-lg-4 col-form-label">Tanggal Awal</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_awal') is-invalid @enderror"
                                        id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal') }}">
                                    @error('tanggal_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Tanggal Akhir -->
                            <div class="form-group row">
                                <label for="tanggal_akhir" class="col-lg-4 col-form-label">Tanggal Akhir</label>
                                <div class="col-lg-6">
                                    <input type="date"
                                        class="form-control rounded @error('tanggal_akhir') is-invalid @enderror"
                                        id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                                    @error('tanggal_akhir')
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kepalaRuanganDropdown = document.getElementById('nama_pegawai'); // Dropdown Kepala Ruangan
        const namaRuanganInput = document.getElementById('nama_ruangan'); // Input readonly Nama Ruangan

        // Menangani perubahan pilihan nama kepala ruangan
        kepalaRuanganDropdown.addEventListener('change', function() {
            const selectedOption = kepalaRuanganDropdown.options[kepalaRuanganDropdown.selectedIndex];
            const namaRuangan = selectedOption.getAttribute(
                'data-ruangan'); // Ambil nama ruangan dari atribut data

            namaRuanganInput.value = namaRuangan || ''; // Set nilai Nama Ruangan
        });
    });
</script>
