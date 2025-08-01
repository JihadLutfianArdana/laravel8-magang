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

            <!-- Filter Tanggal & Tombol Cetak untuk List Peserta -->
            <div class="d-flex justify-content-start align-items-center mb-3 mt-3">
                <a href="/dashboard/pendaftaran-peserta/laporan-persetujuan-magang?tanggal_awal_persetujuan={{ request('tanggal_awal_persetujuan') }}&tanggal_akhir_persetujuan={{ request('tanggal_akhir_persetujuan') }}"
                    class="btn btn-dark" target="_blank">
                    <i class="bi bi-printer"></i> Cetak Data
                </a>

                <form action="/dashboard/pendaftaran-peserta" method="GET" class="form-inline ml-3">
                    <label for="tanggal_awal_persetujuan" class="ml-2">Periode:</label>
                    <input type="date" name="tanggal_awal_persetujuan" id="tanggal_awal_persetujuan"
                        class="form-control ml-2" value="{{ request('tanggal_awal_persetujuan') }}"
                        style="max-width: 170px;">
                    <span class="mx-2">s/d</span>
                    <input type="date" name="tanggal_akhir_persetujuan" id="tanggal_akhir_persetujuan"
                        class="form-control" value="{{ request('tanggal_akhir_persetujuan') }}" style="max-width: 170px;">
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered zero-configuration">
                    <thead class="table-secondary rounded-top">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mendaftar</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah/Universitas</th>
                            {{-- <th>Kelas/Jurusan</th> --}}
                            <th>Status</th>
                            <th>Tanggal Disetujui</th>
                            <th>Aksi</th>
                            <th>Buat Surat</th>
                            <th>Terima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaranPesertas as $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($peserta->created_at)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $peserta->nama_lengkap }}</td>
                                <td>{{ $peserta->asal_sekolah_universitas }}</td>
                                {{-- <td>{{ $peserta->kelas_jurusan }}</td> --}}
                                <td>{{ $peserta->status }}</td>
                                <td>
                                    @if ($peserta->tanggal_disetujui)
                                        {{ \Carbon\Carbon::parse($peserta->tanggal_disetujui)->translatedFormat('l, d F Y') }}
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
                                    <form action="/dashboard/pendaftaran-peserta/{{ $peserta->id }}" method="POST"
                                        id="delete-Form-{{ $peserta->id }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm mt-1"
                                            onclick="confirmDelete({{ $peserta->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="/dashboard/pendaftaran-peserta/surat-balasan/{{ $peserta->id }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-envelope-paper-fill"></i>
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="/dashboard/pendaftaran-peserta/update-check-status" method="POST">
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

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Laporan Surat Balasan Magang</h4>

            <!-- Filter & Cetak Surat Balasan -->
            <div class="d-flex justify-content-start align-items-center mb-3">
                <a href="/dashboard/pendaftaran-peserta/laporan-surat-balasan?tanggal_awal_balasan={{ request('tanggal_awal_balasan') }}&tanggal_akhir_balasan={{ request('tanggal_akhir_balasan') }}"
                    class="btn btn-dark" target="_blank">
                    <i class="bi bi-printer"></i> Cetak Data
                </a>

                <form action="/dashboard/pendaftaran-peserta" method="GET" class="form-inline ml-3">
                    <label for="tanggal_awal_balasan" class="ml-2">Periode:</label>
                    <input type="date" name="tanggal_awal_balasan" id="tanggal_awal_balasan"
                        class="form-control ml-2" value="{{ request('tanggal_awal_balasan') }}"
                        style="max-width: 170px;">
                    <span class="mx-2">s/d</span>
                    <input type="date" name="tanggal_akhir_balasan" id="tanggal_akhir_balasan" class="form-control"
                        value="{{ request('tanggal_akhir_balasan') }}" style="max-width: 170px;">
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>

            @if ($suratBalasanList->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered zero-configuration">
                        <thead class="table-secondary rounded-top">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Surat</th>
                                <th>Nomor Surat</th>
                                {{-- <th>Lampiran</th> --}}
                                <th>Hal</th>
                                <th>Nama Peserta</th>
                                <th>Tanggal Mendaftar</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratBalasanList as $index => $surat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($surat->tanggal)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    {{-- <td>{{ $surat->lampiran }}</td> --}}
                                    <td>{{ $surat->hal }}</td>
                                    <td>{{ $surat->peserta->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        {{ $surat->peserta && $surat->peserta->created_at
                                            ? \Carbon\Carbon::parse($surat->peserta->created_at)->translatedFormat('l, d F Y H:i')
                                            : '-' }}
                                    </td>
                                    {{-- <td>
                                        <a href="/dashboard/surat-balasan/print/{{ $surat->pendaftaran_peserta_id }}"
                                            class="btn btn-secondary btn-sm" target="_blank">
                                            <i class="bi bi-printer"></i> Cetak
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mt-3 text-center">Belum ada surat balasan yang dibuat.</p>
            @endif
        </div>
    </div>
@endsection
