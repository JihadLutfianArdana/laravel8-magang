@extends('dashboard.layouts.main')

@php use Carbon\Carbon; @endphp

@section('container')
    <h2 class="mb-4">Penilaian Peserta Magang</h2>
    <hr class="my-4">

    {{-- Card Kompetensi Peserta Magang --}}
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Kompetensi Peserta Magang</h4>
            <br>
            <form action="#" method="POST"> {{-- Ganti action & method jika ingin diproses --}}
                @csrf
                <ol>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>1 . Peserta Magang melakukan absensi hadir minimal 20 kali</span>
                        <strong>{{ $absensiPeserta->where('status', 'Hadir')->count() }}/20</strong>
                    </li>
                    <br>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>2 . Peserta Magang mengisi kegiatan harian minimal 20 kali</span>
                        <strong>{{ $kegiatanMagang->count() }}/20</strong>
                    </li>
                    <br>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>3 . Peserta Magang mengikuti aturan yang ada di BAPELKES</span>
                        {{-- <select name="kompetensi_aturan" id="kompetensi_aturan" class="form-select w-auto">
                            <option disabled selected>Nilai</option>
                            <option value="5">5 - Sangat Baik</option>
                            <option value="4">4 - Baik</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Tidak Baik</option>
                            <option value="1">1 - Sangat Tidak Baik</option>
                        </select> --}}
                    </li>
                    <br>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>4 . Peserta Magang aktif berkomunikasi dengan pegawai setempat</span>
                        {{-- <select name="kompetensi_komunikasi" id="kompetensi_komunikasi" class="form-select w-auto">
                            <option disabled selected>Nilai</option>
                            <option value="5">5 - Sangat Baik</option>
                            <option value="4">4 - Baik</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Tidak Baik</option>
                            <option value="1">1 - Sangat Tidak Baik</option>
                        </select> --}}
                    </li>
                    <br>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>5 . Peserta Magang bertanggung jawab terhadap tugas yang diberikan</span>
                        {{-- <select name="kompetensi_tanggungjawab" id="kompetensi_tanggungjawab" class="form-select w-auto">
                            <option disabled selected>Nilai</option>
                            <option value="5">5 - Sangat Baik</option>
                            <option value="4">4 - Baik</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Tidak Baik</option>
                            <option value="1">1 - Sangat Tidak Baik</option>
                        </select> --}}
                    </li>

                </ol>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title">
                <a href="/dashboard/penilaian-akhir/admin-pendaftaran" class="btn mb-1 btn-secondary"><i
                        class="bi bi-arrow-left"></i>
                    Kembali</a>
                {{-- @if ($penilaian && $penilaian->is_penilaian_selesai)
                    <a href="/dashboard/penilaian-akhir/sertifikat/pembimbing-lapangan/{{ $user->id }}"
                        class="btn mb-1 btn-dark">
                        <i class="bi bi-file-earmark-text"></i> Cetak Sertifikat
                    </a>
                @endif --}}
            </div>
            <h4 class="card-title">Penilaian Kinerja - {{ $user->nama }}</h4>
            @if ($penilaian && $penilaian->tanggal_penilaian)
                <p><strong>Tanggal Penilaian:</strong>
                    {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}
                </p>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr class="bg-info text-white text-center">
                            <th>Aktivitas Yang Dinilai (Bobot Nilai)</th>
                            <th>Nilai (Dalam Bentuk Angka)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Absensi Kehadiran (0.20)</td>
                            <td class="text-center">{{ $penilaian->nilai_kehadiran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Mengisi Logbook Kegiatan (0.20)</td>
                            <td class="text-center">{{ $penilaian->nilai_kegiatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Mengikuti Aturan Yang Diberikan (0.15)</td>
                            <td class="text-center">{{ $penilaian->nilai_sikap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Disiplin Waktu (0.15)</td>
                            <td class="text-center">{{ $penilaian->nilai_kedisiplinan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kerjasama Tim (0.10)</td>
                            <td class="text-center">{{ $penilaian->nilai_kerjasama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Membangun Komunikasi Dengan Sesama (0.10)</td>
                            <td class="text-center">{{ $penilaian->nilai_komunikasi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggung Jawab Terhadap Tugas (0.10)</td>
                            <td class="text-center">{{ $penilaian->nilai_tanggung_jawab ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td class="text-center">{{ $penilaian->komentar ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nilai Akhir</td>
                            <td class="text-center">{{ $penilaian->nilai_saw ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Poin 3: Kompetensi Aturan -> nilai_sikap
            const dropdownAturan = document.getElementById('kompetensi_aturan');
            const inputNilaiSikap = document.getElementById('nilai_sikap');

            dropdownAturan.addEventListener('change', function() {
                const nilai = parseInt(this.value);
                let nilaiSikap = 0;

                switch (nilai) {
                    case 5:
                        nilaiSikap = 90;
                        break;
                    case 4:
                        nilaiSikap = 80;
                        break;
                    case 3:
                        nilaiSikap = 70;
                        break;
                    case 2:
                        nilaiSikap = 60;
                        break;
                    case 1:
                        nilaiSikap = 50;
                        break;
                    default:
                        nilaiSikap = 0;
                }
                inputNilaiSikap.value = nilaiSikap;
            });

            // Poin 4: Kompetensi Komunikasi -> nilai_komunikasi
            const dropdownKomunikasi = document.getElementById('kompetensi_komunikasi');
            const inputNilaiKomunikasi = document.getElementById('nilai_komunikasi');

            dropdownKomunikasi.addEventListener('change', function() {
                const nilai = parseInt(this.value);
                let nilaiKomunikasi = 0;

                switch (nilai) {
                    case 5:
                        nilaiKomunikasi = 90;
                        break;
                    case 4:
                        nilaiKomunikasi = 80;
                        break;
                    case 3:
                        nilaiKomunikasi = 70;
                        break;
                    case 2:
                        nilaiKomunikasi = 60;
                        break;
                    case 1:
                        nilaiKomunikasi = 50;
                        break;
                    default:
                        nilaiKomunikasi = 0;
                }
                inputNilaiKomunikasi.value = nilaiKomunikasi;
            });

            // Poin 5: Kompetensi Tanggung Jawab -> nilai_tanggung_jawab
            const dropdownTanggungjawab = document.getElementById('kompetensi_tanggungjawab');
            const inputNilaiTanggungjawab = document.getElementById('nilai_tanggung_jawab');

            dropdownTanggungjawab.addEventListener('change', function() {
                const nilai = parseInt(this.value);
                let nilaiTanggungjawab = 0;

                switch (nilai) {
                    case 5:
                        nilaiTanggungjawab = 90;
                        break;
                    case 4:
                        nilaiTanggungjawab = 80;
                        break;
                    case 3:
                        nilaiTanggungjawab = 70;
                        break;
                    case 2:
                        nilaiTanggungjawab = 60;
                        break;
                    case 1:
                        nilaiTanggungjawab = 50;
                        break;
                    default:
                        nilaiTanggungjawab = 0;
                }
                inputNilaiTanggungjawab.value = nilaiTanggungjawab;
            });
        });
    </script>
@endsection
