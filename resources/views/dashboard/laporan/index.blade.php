@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Laporan Peserta</h2>
    <hr class="my-4">

    <div class="card">
        <div class="card-body">
            <div class="default-tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#laporanKegiatan" role="tab">Laporan
                            Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#laporanAbsensi" role="tab">Laporan Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#laporanPenilaian1" role="tab">Laporan Penilaian
                            Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#laporanPenilaian2" role="tab">Laporan Penilaian
                            Pembimbing</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Laporan Kegiatan -->
                    <div class="tab-pane fade show active" id="laporanKegiatan" role="tabpanel">
                        <h4 class="card-title">Laporan Kegiatan Peserta</h4>
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <a href="/dashboard/laporan-kegiatan-peserta?tanggal_awal_kegiatan={{ request('tanggal_awal_kegiatan') }}&tanggal_akhir_kegiatan={{ request('tanggal_akhir_kegiatan') }}"
                                class="btn btn-dark">
                                <i class="bi bi-printer"></i> Cetak Data
                            </a>
                            <form action="/dashboard/laporan-peserta" method="GET" class="form-inline">
                                <input type="hidden" name="tab" value="kegiatan">
                                <label class="ml-4">Periode:</label>
                                <input type="date" name="tanggal_awal_kegiatan" class="form-control ml-2"
                                    value="{{ request('tanggal_awal_kegiatan') }}">
                                <span class="mx-2">s/d</span>
                                <input type="date" name="tanggal_akhir_kegiatan" class="form-control"
                                    value="{{ request('tanggal_akhir_kegiatan') }}">
                                <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>NISM</th>
                                        <th>Nama Peserta</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Deskripsi</th>
                                        <th>Lokasi</th>
                                        <th>Dokumentasi</th>
                                        <th>Status Revisi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatanMagang as $index => $kegiatan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ optional($kegiatan->detailMagang)->nism ?? '-' }}</td>
                                            <td>{{ optional($kegiatan->detailMagang)->nama_peserta ?? '-' }}</td>
                                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                                            <td>{{ $kegiatan->deskripsi_kegiatan }}</td>
                                            <td>{{ $kegiatan->lokasi_kegiatan }}</td>
                                            <td>
                                                @if ($kegiatan->dok_kegiatan)
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#dokKegiatanModal{{ $kegiatan->id }}">
                                                        <img src="{{ asset('storage/' . $kegiatan->dok_kegiatan) }}"
                                                            alt="Dokumentasi" class="img-thumbnail"
                                                            style="width: 100px; height: auto;">
                                                    </a>

                                                    <!-- Modal Dokumentasi -->
                                                    <div class="modal fade" id="dokKegiatanModal{{ $kegiatan->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="dokKegiatanModalLabel{{ $kegiatan->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="dokKegiatanModalLabel{{ $kegiatan->id }}">
                                                                        Dokumentasi Kegiatan
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
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
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $kegiatan->status_revisi ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($kegiatan->status_selesai)
                                                    <span class="badge badge-success">Acc</span>
                                                @else
                                                    <span class="badge badge-danger">Belum Acc</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Absensi Peserta -->
                    <div class="tab-pane fade" id="laporanAbsensi" role="tabpanel">
                        <h4 class="card-title">Laporan Absensi Peserta</h4>
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <a href="/dashboard/laporan-absensi-peserta?tanggal_awal_absensi={{ request('tanggal_awal_absensi') }}&tanggal_akhir_absensi={{ request('tanggal_akhir_absensi') }}"
                                class="btn btn-dark">
                                <i class="bi bi-printer"></i> Cetak Data
                            </a>
                            <form action="/dashboard/laporan-peserta" method="GET" class="form-inline">
                                <input type="hidden" name="tab" value="absensi">
                                <label class="ml-4">Periode:</label>
                                <input type="date" name="tanggal_awal_absensi" class="form-control ml-2"
                                    value="{{ request('tanggal_awal_absensi') }}">
                                <span class="mx-2">s/d</span>
                                <input type="date" name="tanggal_akhir_absensi" class="form-control"
                                    value="{{ request('tanggal_akhir_absensi') }}">
                                <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th>No</th>
                                        <th>Hari dan Tanggal</th>
                                        <th>NISM</th>
                                        <th>Nama Peserta</th>
                                        <th>Waktu Masuk</th>
                                        <th>Waktu Keluar</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Alasan</th>
                                        <th>Bukti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensiPeserta as $absen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($absen->hari_tanggal)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ optional($absen->detailMagang)->nism ?? '-' }}</td>
                                            <td>{{ optional($absen->detailMagang)->nama_peserta ?? '-' }}</td>
                                            <td>{{ $absen->waktu_masuk ?? '-' }}</td>
                                            <td>{{ $absen->waktu_keluar ?? '-' }}</td>
                                            <td>{{ $absen->status }}</td>
                                            <td>{{ $absen->keterangan ?? '-' }}</td>
                                            <td>{{ $absen->alasan ?? '-' }}</td>
                                            <td>
                                                @if ($absen->bukti)
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#gambarModal-{{ $absen->id }}">Lihat</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- Modal bukti --}}
                                        <div class="modal fade" id="gambarModal-{{ $absen->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="gambarModalLabel-{{ $absen->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary text-white">
                                                        <h5 class="modal-title"
                                                            id="gambarModalLabel-{{ $absen->id }}">Bukti</h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $absen->bukti) }}"
                                                            alt="Bukti Absensi" class="img-fluid" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Laporan Penilaian Peserta -->
                    <div class="tab-pane fade" id="laporanPenilaian1" role="tabpanel">
                        <h4 class="card-title">Laporan Penilaian Peserta</h4>
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <a href="/dashboard/laporan-penilaian-peserta?tanggal_awal_penilaian={{ request('tanggal_awal_penilaian') }}&tanggal_akhir_penilaian={{ request('tanggal_akhir_penilaian') }}"
                                class="btn btn-dark">
                                <i class="bi bi-printer"></i> Cetak Data
                            </a>
                            <form action="/dashboard/laporan-peserta" method="GET" class="form-inline">
                                <input type="hidden" name="tab" value="penilaian">
                                <label for="tanggal_awal_penilaian" class="ml-4">Periode:</label>
                                <input type="date" name="tanggal_awal_penilaian" id="tanggal_awal_penilaian"
                                    class="form-control ml-2" value="{{ request('tanggal_awal_penilaian') }}">
                                <span class="mx-2">s/d</span>
                                <input type="date" name="tanggal_akhir_penilaian" id="tanggal_akhir_penilaian"
                                    class="form-control" value="{{ request('tanggal_akhir_penilaian') }}">
                                <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>NISM</th>
                                        <th>Nama Peserta</th>
                                        <th>Absensi Kehadiran</th>
                                        <th>Mengisi Logbook</th>
                                        <th>Mengikuti Aturan</th>
                                        <th>Disiplin Waktu</th>
                                        <th>Kerjasama Tim</th>
                                        <th>Komunikasi Sesama</th>
                                        <th>Tanggung Jawab</th>
                                        <th>Nilai Akhir</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaianPeserta as $penilaian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ optional($penilaian->detailMagang)->nism ?? '-' }}</td>
                                            <td>{{ optional($penilaian->detailMagang)->nama_peserta ?? '-' }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_kehadiran }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_kegiatan }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_sikap }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_kedisiplinan }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_kerjasama }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_komunikasi }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_tanggung_jawab }}</td>
                                            <td class="text-center">{{ $penilaian->nilai_saw }}</td>
                                            <td>{{ $penilaian->komentar ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Laporan Penilaian Pembimbing -->
                    <div class="tab-pane fade" id="laporanPenilaian2" role="tabpanel">
                        <h4 class="card-title">Laporan Penilaian Pembimbing</h4>
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <a href="/dashboard/laporan-penilaian-pembimbing?tanggal_awal_penilaian_pembimbing={{ request('tanggal_awal_penilaian_pembimbing') }}&tanggal_akhir_penilaian_pembimbing={{ request('tanggal_akhir_penilaian_pembimbing') }}"
                                class="btn btn-dark">
                                <i class="bi bi-printer"></i> Cetak Data
                            </a>
                            <form action="/dashboard/laporan-peserta" method="GET" class="form-inline ml-3">
                                <input type="hidden" name="tab" value="penilaian2">
                                <label for="tanggal_awal_penilaian_pembimbing" class="ml-2">Periode:</label>
                                <input type="date" name="tanggal_awal_penilaian_pembimbing"
                                    id="tanggal_awal_penilaian_pembimbing" class="form-control ml-2"
                                    value="{{ request('tanggal_awal_penilaian_pembimbing') }}">
                                <span class="mx-2">s/d</span>
                                <input type="date" name="tanggal_akhir_penilaian_pembimbing"
                                    id="tanggal_akhir_penilaian_pembimbing" class="form-control"
                                    value="{{ request('tanggal_akhir_penilaian_pembimbing') }}">
                                <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead class="table-secondary rounded-top">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>NISM</th>
                                        <th>Nama Peserta Yang Menilai</th>
                                        <th>Nama Pembimbing Yang Dinilai</th>
                                        <th>Keterampilan Memberikan Arahan</th>
                                        <th>Kepedulian Terhadap Peserta</th>
                                        <th>Membimbing dan Memberikan Solusi</th>
                                        <th>Disiplin dan Tanggung Jawab</th>
                                        <th>Kesiapan Memberi Materi</th>
                                        <th>Saran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaianPembimbing as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ optional($item->detailMagang)->nism ?? '-' }}</td>
                                            <td>{{ optional($item->detailMagang)->nama_peserta ?? '-' }}</td>
                                            <td>{{ optional($item->pembimbing)->nama_pegawai ?? '-' }}</td>
                                            <td class="text-center">{{ $item->poin_1 }}</td>
                                            <td class="text-center">{{ $item->poin_2 }}</td>
                                            <td class="text-center">{{ $item->poin_3 }}</td>
                                            <td class="text-center">{{ $item->poin_4 }}</td>
                                            <td class="text-center">{{ $item->poin_5 }}</td>
                                            <td>{{ $item->saran ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab === 'absensi') {
                document.querySelector('a[href="#laporanAbsensi"]').click();
            } else if (tab === 'penilaian') {
                document.querySelector('a[href="#laporanPenilaian1"]').click();
            } else if (tab === 'penilaian2') {
                document.querySelector('a[href="#laporanPenilaian2"]').click();
            } else {
                document.querySelector('a[href="#laporanKegiatan"]').click();
            }
        });
    </script>
@endsection
