@extends('dashboard.layouts.main2')

@section('container')
    <h2 class="mb-4">Pendaftaran Peserta</h2>
    <hr class="my-4">
    <div class="card">
        <div class="card-body">

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

            <h4 class="card-title">List Peserta Yang Mendaftar Magang</h4>
            <div class="mt-3">
                <p><strong>Jumlah Peserta Magang {{ $jumlahPesertaAktif }}/{{ $kuotaMax }}</strong></p>
                @if ($jumlahPesertaAktif >= $kuotaMax)
                    <p class="text-warning mb-0"><strong>Kuota Magang Penuh!</strong></p>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah/Universitas</th>
                            {{-- <th>Kelas/Jurusan</th> --}}
                            <th>Tanggal Mendaftar</th>
                            <th>Status</th>
                            <th>Tanggal Disetujui</th>
                            <th>Aksi</th>
                            <th>Cek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaranPesertas as $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->nama_lengkap }}</td>
                                <td>{{ $peserta->asal_sekolah_universitas }}</td>
                                {{-- <td>{{ $peserta->kelas_jurusan }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($peserta->created_at)->format('d-m-Y H:i') }}</td>
                                <td>{{ $peserta->status }}</td>
                                <td>
                                    @if ($peserta->tanggal_disetujui)
                                        {{ \Carbon\Carbon::parse($peserta->tanggal_disetujui)->format('d-m-Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ $peserta->no_telepon }}" class="btn btn-success btn-sm"
                                        target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#detailModal{{ $peserta->id }}"><i class="bi bi-search"></i>
                                    </button>
                                    <form action="/dashboard/pendaftaran-peserta/admin-pendaftaran/{{ $peserta->id }}"
                                        method="POST" id="delete-Form-{{ $peserta->id }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $peserta->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="/dashboard/pendaftaran-peserta/update-check-status/admin-pendaftaran"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $peserta->id }}">
                                        <input type="checkbox" name="is_checked" onchange="this.form.submit()"
                                            {{ $peserta->is_checked ? 'checked' : '' }}>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk detail -->
                            <div class="modal fade" id="detailModal{{ $peserta->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel{{ $peserta->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $peserta->id }}">Detail Peserta
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item"><strong>Nama Lengkap:</strong>
                                                    {{ $peserta->nama_lengkap }}</li>
                                                <li class="list-group-item"><strong>Tanggal Lahir:</strong>
                                                    {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d-m-Y') }}
                                                </li>
                                                <li class="list-group-item"><strong>Jenis Kelamin:</strong>
                                                    {{ $peserta->jenis_kelamin }}</li>
                                                <li class="list-group-item"><strong>Alamat:</strong> {{ $peserta->alamat }}
                                                </li>
                                                <li class="list-group-item"><strong>No Telepon:</strong>
                                                    {{ $peserta->no_telepon }}</li>
                                                <li class="list-group-item"><strong>Email:</strong> {{ $peserta->email }}
                                                </li>
                                                <li class="list-group-item"><strong>Asal Sekolah/Universitas:</strong>
                                                    {{ $peserta->asal_sekolah_universitas }}</li>
                                                <li class="list-group-item"><strong>Kelas/Jurusan:</strong>
                                                    {{ $peserta->kelas_jurusan }}</li>
                                                <li class="list-group-item"><strong>Tanggal Mulai Magang:</strong>
                                                    {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d-m-Y') }}
                                                </li>
                                                <li class="list-group-item"><strong>Tanggal Selesai Magang:</strong>
                                                    {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d-m-Y') }}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Surat Pengantar:</strong>
                                                    <a href="{{ asset('storage/' . $peserta->surat_pengantar_path) }}"
                                                        class="btn btn-primary btn-sm" target="_blank"><i
                                                            class="bi bi-download"></i> Download Surat Pengantar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Teks dan link untuk membuka modal template pesan -->
            <div class="mt-4">
                <p><strong>Gunakan template pesan ini (opsional) untuk</strong> <a href="#" data-toggle="modal"
                        data-target="#templateModal"><strong>Menerima atau Menolak Peserta</strong></a>.</p>
            </div>
        </div>
    </div>

    <!-- Modal untuk Template Pesan -->
    <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel">Template Pesan Penerimaan atau Penolakan Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Template Pesan Menerima Peserta</h5>
                    <textarea class="form-control" rows="4" readonly>Selamat! Anda diterima sebagai peserta magang. Segera ke Balai Pelatihan Kesehatan Provinsi Kalsel pada hari dan jam berikut untuk melakukan konfirmasi dan sesi wawancara: [Isi tanggal dan jam, serta nama pengirim pesan].</textarea>
                    <hr>
                    <h5>Template Pesan Menolak Peserta</h5>
                    <textarea class="form-control" rows="4" readonly>Terima kasih telah mendaftar magang di Balai Pelatihan Kesehatan Provinsi Kalsel. Kami menyesal memberitahukan bahwa Anda tidak diterima sebagai peserta magang pada kesempatan ini karena [Berikan alasan serta nama pengirim pesan]. </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Card baru untuk "Buat Surat Balasan" -->
    <div class="card mt-4">
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
            <form action="/dashboard/surat-balasan/admin-pendaftaran" method="POST">
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
                                id="nomor_surat" name="nomor_surat" placeholder="Masukkan nomor surat"
                                value="{{ old('nomor_surat', $suratBalasan->nomor_surat ?? '') }}" required>
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
                    <textarea class="form-control rounded @error('alamat_surat') is-invalid @enderror" id="alamat_surat"
                        name="alamat_surat" rows="2" placeholder="Masukkan alamat surat" required>{{ old('alamat_surat', $suratBalasan->alamat_surat ?? '') }}</textarea>
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
                    <label for="nama_peserta">Nama-nama Peserta</label>
                    <select class="form-control rounded @error('nama_peserta') is-invalid @enderror" id="nama_peserta"
                        name="nama_peserta[]" multiple="multiple" required>
                        <option value="">-- Pilih Nama Peserta --</option>
                        @foreach ($pendaftaranPesertas as $peserta)
                            <option value="{{ $peserta->id }}" @if (in_array($peserta->id, old('nama_peserta', []))) selected @endif>
                                {{ $peserta->nama_lengkap }} - {{ $peserta->kelas_jurusan }}
                            </option>
                        @endforeach
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
                    <a href="/dashboard/surat-balasan/print/admin-pendaftaran" class="btn btn-secondary"><i
                            class="bi bi-printer"></i>
                        Cetak Surat Balasan</a>
                </div>
            </form>
        </div>
    </div>
@endsection
