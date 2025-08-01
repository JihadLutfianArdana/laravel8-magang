@extends('dashboard.layouts.main2')

@section('container')
    <h2 class="mb-4">Pendaftaran Peserta</h2>
    <hr class="my-4">

    <!-- Card baru untuk "Buat Surat Balasan" -->
    <div class="card">
        <div class="card-body">

            @if (session('success2'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success2') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h4 class="card-title">Buat Surat Balasan</h4>
            <a href="/dashboard/pendaftaran-peserta/admin-pendaftaran" class="btn mb-1 btn-secondary"><i
                    class="bi bi-arrow-left"></i>
                Kembali</a>
            <form action="/dashboard/pendaftaran-peserta/surat-balasan/admin-pendaftaran/{{ $peserta->id }}"
                method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control rounded @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal', $suratBalasan->tanggal ?? '') }}"
                                required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" class="form-control rounded @error('nomor_surat') is-invalid @enderror"
                                id="nomor_surat" name="nomor_surat"
                                value="{{ old('nomor_surat', $nomorSuratOtomatis ?? '') }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="text" class="form-control rounded @error('lampiran') is-invalid @enderror"
                                id="lampiran" name="lampiran" placeholder="Masukkan jumlah lampiran"
                                value="{{ old('lampiran', $suratBalasan->lampiran ?? '') }}" required>
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hal">Hal</label>
                            <input type="text" class="form-control rounded @error('hal') is-invalid @enderror"
                                id="hal" name="hal" placeholder="Masukkan perihal surat"
                                value="{{ old('hal', $suratBalasan->hal ?? '') }}" required>
                            @error('hal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat_surat">Alamat Surat</label>
                    <textarea class="form-control rounded @error('alamat_surat') is-invalid @enderror" id="alamat_surat" name="alamat_surat"
                        rows="2" placeholder="Masukkan alamat surat" required>{{ old('alamat_surat', $suratBalasan->alamat_surat ?? '') }}</textarea>
                    @error('alamat_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kalimat_pembuka">Kalimat Pembuka</label>
                    <textarea class="form-control rounded @error('kalimat_pembuka') is-invalid @enderror" id="kalimat_pembuka"
                        name="kalimat_pembuka" rows="2" placeholder="Masukkan kalimat pembuka" required>{{ old('kalimat_pembuka', $suratBalasan->kalimat_pembuka ?? '') }}</textarea>
                    @error('kalimat_pembuka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_peserta">Nama Peserta</label>
                    <select class="form-control" name="nama_peserta" required readonly>
                        <option value="{{ $peserta->id }}" selected>
                            {{ $peserta->nama_lengkap }} - {{ $peserta->kelas_jurusan }}
                        </option>
                    </select>
                    @error('nama_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kalimat_penutup">Kalimat Penutup</label>
                    <textarea class="form-control rounded @error('kalimat_penutup') is-invalid @enderror" id="kalimat_penutup"
                        name="kalimat_penutup" rows="2" placeholder="Masukkan kalimat penutup" required>{{ old('kalimat_penutup', $suratBalasan->kalimat_penutup ?? '') }}</textarea>
                    @error('kalimat_penutup')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-info"><i class="bi bi-download"></i> Simpan</button>
                    <a href="/dashboard/surat-balasan/print/admin-pendaftaran/{{ $peserta->id }}"
                        class="btn btn-secondary"><i class="bi bi-printer"></i>
                        Cetak Surat Balasan</a>
                </div>
            </form>
        </div>
    </div>
@endsection
