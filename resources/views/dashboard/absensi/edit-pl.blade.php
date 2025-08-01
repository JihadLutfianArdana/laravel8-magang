@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Edit Data Absensi Peserta</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="/dashboard/absensi-pembimbing/{{ $absensi->user_id }}" class="btn mb-1 btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <form action="/dashboard/absensi-pembimbing/{{ $absensi->id }}/update" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="hari_tanggal" class="col-lg-4 col-form-label">Hari Tanggal</label>
                    <div class="col-lg-6">
                        <input type="date" name="hari_tanggal" id="hari_tanggal" class="form-control rounded"
                            value="{{ old('hari_tanggal', $absensi->hari_tanggal) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-lg-4 col-form-label">Status</label>
                    <div class="col-lg-6">
                        <select name="status" id="status" class="form-control rounded" required>
                            <option value="Hadir" {{ $absensi->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ $absensi->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ $absensi->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan" class="col-lg-4 col-form-label">Keterangan</label>
                    <div class="col-lg-6">
                        <input type="text" name="keterangan" id="keterangan" class="form-control rounded"
                            value="{{ old('keterangan', $absensi->keterangan) }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="alasan" class="col-lg-4 col-form-label">Alasan</label>
                    <div class="col-lg-6">
                        <textarea name="alasan" id="alasan" class="form-control rounded" rows="3">{{ old('alasan', $absensi->alasan) }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bukti" class="col-lg-4 col-form-label">Bukti (Opsional)</label>
                    <div class="col-lg-6">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('bukti') is-invalid @enderror"
                                id="bukti" name="bukti" onchange="updateFileName()">
                            <label class="custom-file-label" for="bukti">Pilih file...</label>
                            @error('bukti')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($absensi->bukti)
                            <p class="text-muted mt-3">
                                Bukti saat ini: <a href="{{ asset('storage/' . $absensi->bukti) }}"
                                    target="_blank">Lihat</a>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" class="btn btn-info"><i class="bi bi-download"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the file input and label
            var fileInput = document.getElementById('bukti');
            var fileLabel = document.querySelector('.custom-file-label');

            // Listen for file selection
            fileInput.addEventListener('change', function(event) {
                var fileName = event.target.files[0] ? event.target.files[0].name : "Pilih file...";
                fileLabel.textContent = fileName;
            });
        });
    </script>
@endsection
