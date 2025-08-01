<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PenilaianPeserta;
use App\Models\DetailMagang;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\AbsensiPeserta;
use App\Models\KegiatanMagang;
use Illuminate\Support\Facades\Storage;

class PenilaianPesertaController extends Controller
{
    public function indexAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $user_id = $request->input('user_id');
            $user = User::with('detailMagang')->findOrFail($user_id);
            $detailMagang = $user->detailMagang;

            if (!$detailMagang) {
                return redirect('/dashboard/penilaian-akhir')->with('error', 'Detail magang tidak ditemukan.');
            }

            $penilaian = PenilaianPeserta::where('detail_magang_id', $detailMagang->id)->first();

            if (!$penilaian) {
                return redirect('/dashboard/penilaian-akhir')->with('error', 'Data penilaian belum tersedia.');
            }

            if ($penilaian->nomor_sertifikat) {
                return redirect('/dashboard/penilaian-akhir')->with('warning', 'Sertifikat sudah dibuat sebelumnya.');
            }

            // Generate nomor sertifikat
            $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;

            $penilaian->nomor_sertifikat = 'SM/BP-KES/' . $bulanRomawi[$bulan - 1] . '/' . $tahun;
            $penilaian->tanggal_sertifikat = Carbon::now()->toDateString();
            $penilaian->save();

            // ⛳ INI YANG DIGANTI
            return redirect('/dashboard/penilaian-akhir')->with('success', 'Sertifikat berhasil dibuat.');
        }

        // Bagian GET tetap
        $users = User::where('is_admin', 0)->with('detailMagang')->get();

        $daftarSertifikatQuery = PenilaianPeserta::with('detailMagang')
            ->whereNotNull('nomor_sertifikat');

        if ($request->filled('tanggal_awal_sertifikat') && $request->filled('tanggal_akhir_sertifikat')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_sertifikat)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_sertifikat)->endOfDay();

                $daftarSertifikatQuery->whereBetween('tanggal_sertifikat', [$awal, $akhir]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Format tanggal salah.');
            }
        }

        $daftarSertifikat = $daftarSertifikatQuery->get();

        return view('dashboard.penilaian.index-admin', [
            'title' => 'Kegiatan Peserta',
            'users' => $users,
            'daftarSertifikat' => $daftarSertifikat,
        ]);
    }

    public function indexAdminAP(Request $request)
    {
        if ($request->isMethod('post')) {
            $user_id = $request->input('user_id');
            $user = User::with('detailMagang')->findOrFail($user_id);
            $detailMagang = $user->detailMagang;

            if (!$detailMagang) {
                return redirect('/dashboard/penilaian-akhir/admin-pendaftaran')->with('error', 'Detail magang tidak ditemukan.');
            }

            $penilaian = PenilaianPeserta::where('detail_magang_id', $detailMagang->id)->first();

            if (!$penilaian) {
                return redirect('/dashboard/penilaian-akhir/admin-pendaftaran')->with('error', 'Data penilaian belum tersedia.');
            }

            if ($penilaian->nomor_sertifikat) {
                return redirect('/dashboard/penilaian-akhir/admin-pendaftaran')->with('warning', 'Sertifikat sudah dibuat sebelumnya.');
            }

            // Generate nomor sertifikat
            $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;

            $penilaian->nomor_sertifikat = 'SM/BP-KES/' . $bulanRomawi[$bulan - 1] . '/' . $tahun;
            $penilaian->tanggal_sertifikat = Carbon::now()->toDateString();
            $penilaian->save();

            // ⛳ INI YANG DIGANTI
            return redirect('/dashboard/penilaian-akhir/admin-pendaftaran')->with('success', 'Sertifikat berhasil dibuat.');
        }

        // Bagian GET tetap
        $users = User::where('is_admin', 0)->with('detailMagang')->get();

        $daftarSertifikatQuery = PenilaianPeserta::with('detailMagang')
            ->whereNotNull('nomor_sertifikat');

        if ($request->filled('tanggal_awal_sertifikat') && $request->filled('tanggal_akhir_sertifikat')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_sertifikat)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_sertifikat)->endOfDay();

                $daftarSertifikatQuery->whereBetween('tanggal_sertifikat', [$awal, $akhir]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Format tanggal salah.');
            }
        }

        $daftarSertifikat = $daftarSertifikatQuery->get();

        return view('dashboard.penilaian.index-admin-ap', [
            'title' => 'Kegiatan Peserta',
            'users' => $users,
            'daftarSertifikat' => $daftarSertifikat,
        ]);
    }

    public function indexAdminPL(Request $request)
    {
        if ($request->isMethod('post')) {
            $user_id = $request->input('user_id');
            $user = User::with('detailMagang')->findOrFail($user_id);
            $detailMagang = $user->detailMagang;

            if (!$detailMagang) {
                return redirect('/dashboard/penilaian-akhir/pembimbing-lapangan')->with('error', 'Detail magang tidak ditemukan.');
            }

            $penilaian = PenilaianPeserta::where('detail_magang_id', $detailMagang->id)->first();

            if (!$penilaian) {
                return redirect('/dashboard/penilaian-akhir/pembimbing-lapangan')->with('error', 'Data penilaian belum tersedia.');
            }

            if ($penilaian->nomor_sertifikat) {
                return redirect('/dashboard/penilaian-akhir/pembimbing-lapangan')->with('warning', 'Sertifikat sudah dibuat sebelumnya.');
            }

            // Generate nomor sertifikat
            $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;

            $penilaian->nomor_sertifikat = 'SM/BP-KES/' . $bulanRomawi[$bulan - 1] . '/' . $tahun;
            $penilaian->tanggal_sertifikat = Carbon::now()->toDateString();
            $penilaian->save();

            // ⛳ INI YANG DIGANTI
            return redirect('/dashboard/penilaian-akhir/pembimbing-lapangan')->with('success', 'Sertifikat berhasil dibuat.');
        }

        // Bagian GET tetap
        $users = User::where('is_admin', 0)->with('detailMagang')->get();

        $daftarSertifikatQuery = PenilaianPeserta::with('detailMagang')
            ->whereNotNull('nomor_sertifikat');

        if ($request->filled('tanggal_awal_sertifikat') && $request->filled('tanggal_akhir_sertifikat')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_sertifikat)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_sertifikat)->endOfDay();

                $daftarSertifikatQuery->whereBetween('tanggal_sertifikat', [$awal, $akhir]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Format tanggal salah.');
            }
        }

        $daftarSertifikat = $daftarSertifikatQuery->get();

        return view('dashboard.penilaian.index-admin-pl', [
            'title' => 'Kegiatan Peserta',
            'users' => $users,
            'daftarSertifikat' => $daftarSertifikat,
        ]);
    }

    public function rank(Request $request)
    {
        $periodes = DetailMagang::select('tanggal_mulai', 'tanggal_selesai')
            ->groupBy('tanggal_mulai', 'tanggal_selesai')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        $selectedPeriode = $request->query('periode');
        $isHitung = $request->has('hitung');
        $pesertaTerbaik = collect();
        $nilaiSudahAda = false;

        // ✅ Inisialisasi agar tidak undefined
        $tanggalAwal = null;
        $tanggalAkhir = null;

        // ✅ Jika "semua periode"
        if ($selectedPeriode === 'semua') {
            $tanggalAwal = $request->query('tanggal_awal');
            $tanggalAkhir = $request->query('tanggal_akhir');

            $pesertaTerbaik = User::whereHas('penilaian', function ($query) {
                $query->whereNotNull('nilai_saw');
            })
                ->with(['detailMagang', 'penilaian'])
                ->get();

            $nilaiSudahAda = true;

            // ✅ Filter tanggal perangkingan jika diberikan
            if ($tanggalAwal && $tanggalAkhir) {
                $pesertaTerbaik = $pesertaTerbaik->filter(function ($peserta) use ($tanggalAwal, $tanggalAkhir) {
                    $tanggal = optional($peserta->penilaian)->tanggal_perangkingan;
                    return $tanggal &&
                        $tanggal >= $tanggalAwal &&
                        $tanggal <= $tanggalAkhir;
                });
            }

            // ✅ Hitung peringkat per-periode
            $pesertaTerbaik = $pesertaTerbaik->groupBy(function ($item) {
                return $item->detailMagang->tanggal_mulai . '|' . $item->detailMagang->tanggal_selesai;
            })->flatMap(function ($group) {
                return $group->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                    ->values()
                    ->map(function ($user, $index) {
                        $user->peringkat_periode = $index + 1;
                        return $user;
                    });
            });
        }

        // ✅ Jika periode tertentu
        elseif ($selectedPeriode && strpos($selectedPeriode, '_') !== false) {
            [$mulai, $selesai] = explode('_', $selectedPeriode);

            $pesertaTerbaik = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
                $query->whereDate('tanggal_mulai', $mulai)
                    ->whereDate('tanggal_selesai', $selesai);
            })->with(['detailMagang', 'penilaian'])->get();

            $nilaiSudahAda = $pesertaTerbaik->every(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null);

            // ✅ Proses perhitungan nilai SAW
            if ($isHitung) {
                $semuaAdaPenilaian = $pesertaTerbaik->every(fn($u) => $u->penilaian);

                if (! $semuaAdaPenilaian) {
                    return back()->with('error', 'Tidak semua peserta memiliki data penilaian.');
                }

                $max = [
                    'nilai_kehadiran' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kehadiran ?? 0),
                    'nilai_kegiatan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kegiatan ?? 0),
                    'nilai_sikap' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_sikap ?? 0),
                    'nilai_kedisiplinan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kedisiplinan ?? 0),
                    'nilai_kerjasama' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kerjasama ?? 0),
                    'nilai_komunikasi' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_komunikasi ?? 0),
                    'nilai_tanggung_jawab' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_tanggung_jawab ?? 0),
                ];

                $bobot = [
                    'nilai_kehadiran' => 0.20,
                    'nilai_kegiatan' => 0.20,
                    'nilai_sikap' => 0.15,
                    'nilai_kedisiplinan' => 0.15,
                    'nilai_kerjasama' => 0.10,
                    'nilai_komunikasi' => 0.10,
                    'nilai_tanggung_jawab' => 0.10,
                ];

                $pesertaTerbaik = $pesertaTerbaik->map(function ($user) use ($max, $bobot) {
                    $nilai = 0;
                    $penilaian = $user->penilaian;

                    foreach ($bobot as $key => $bobotKriteria) {
                        $nilaiKriteria = $penilaian->$key ?? 0;
                        $nilaiMax = $max[$key] ?: 1;
                        $nilai += ($nilaiKriteria / $nilaiMax) * $bobotKriteria;
                    }

                    $user->nilai_saw = round($nilai, 4);

                    $penilaian->update([
                        'nilai_saw' => $user->nilai_saw,
                        'tanggal_perangkingan' => now(),
                    ]);

                    return $user;
                });

                return redirect('/dashboard/penilaian-akhir/peringkat-peserta?periode=' . $selectedPeriode)
                    ->with('success', 'Perhitungan nilai berhasil.');
            }

            // ✅ Urutkan & beri peringkat
            $pesertaTerbaik = $pesertaTerbaik->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                ->values()
                ->map(function ($user, $index) {
                    $user->peringkat_periode = $index + 1;
                    return $user;
                });
        }

        return view('dashboard.penilaian.rank', [
            'title' => 'Peserta Terbaik',
            'periodes' => $periodes,
            'selectedPeriode' => $selectedPeriode,
            'pesertaTerbaik' => $pesertaTerbaik,
            'isHitung' => $isHitung,
            'nilaiSudahAda' => $nilaiSudahAda,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    public function rankAP(Request $request)
    {
        $periodes = DetailMagang::select('tanggal_mulai', 'tanggal_selesai')
            ->groupBy('tanggal_mulai', 'tanggal_selesai')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        $selectedPeriode = $request->query('periode');
        $isHitung = $request->has('hitung');
        $pesertaTerbaik = collect();
        $nilaiSudahAda = false;

        // ✅ Inisialisasi agar tidak undefined
        $tanggalAwal = null;
        $tanggalAkhir = null;

        // ✅ Jika "semua periode"
        if ($selectedPeriode === 'semua') {
            $tanggalAwal = $request->query('tanggal_awal');
            $tanggalAkhir = $request->query('tanggal_akhir');

            $pesertaTerbaik = User::whereHas('penilaian', function ($query) {
                $query->whereNotNull('nilai_saw');
            })
                ->with(['detailMagang', 'penilaian'])
                ->get();

            $nilaiSudahAda = true;

            // ✅ Filter tanggal perangkingan jika diberikan
            if ($tanggalAwal && $tanggalAkhir) {
                $pesertaTerbaik = $pesertaTerbaik->filter(function ($peserta) use ($tanggalAwal, $tanggalAkhir) {
                    $tanggal = optional($peserta->penilaian)->tanggal_perangkingan;
                    return $tanggal &&
                        $tanggal >= $tanggalAwal &&
                        $tanggal <= $tanggalAkhir;
                });
            }

            // ✅ Hitung peringkat per-periode
            $pesertaTerbaik = $pesertaTerbaik->groupBy(function ($item) {
                return $item->detailMagang->tanggal_mulai . '|' . $item->detailMagang->tanggal_selesai;
            })->flatMap(function ($group) {
                return $group->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                    ->values()
                    ->map(function ($user, $index) {
                        $user->peringkat_periode = $index + 1;
                        return $user;
                    });
            });
        }

        // ✅ Jika periode tertentu
        elseif ($selectedPeriode && strpos($selectedPeriode, '_') !== false) {
            [$mulai, $selesai] = explode('_', $selectedPeriode);

            $pesertaTerbaik = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
                $query->whereDate('tanggal_mulai', $mulai)
                    ->whereDate('tanggal_selesai', $selesai);
            })->with(['detailMagang', 'penilaian'])->get();

            $nilaiSudahAda = $pesertaTerbaik->every(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null);

            // ✅ Proses perhitungan nilai SAW
            if ($isHitung) {
                $semuaAdaPenilaian = $pesertaTerbaik->every(fn($u) => $u->penilaian);

                if (! $semuaAdaPenilaian) {
                    return back()->with('error', 'Tidak semua peserta memiliki data penilaian.');
                }

                $max = [
                    'nilai_kehadiran' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kehadiran ?? 0),
                    'nilai_kegiatan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kegiatan ?? 0),
                    'nilai_sikap' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_sikap ?? 0),
                    'nilai_kedisiplinan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kedisiplinan ?? 0),
                    'nilai_kerjasama' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kerjasama ?? 0),
                    'nilai_komunikasi' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_komunikasi ?? 0),
                    'nilai_tanggung_jawab' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_tanggung_jawab ?? 0),
                ];

                $bobot = [
                    'nilai_kehadiran' => 0.20,
                    'nilai_kegiatan' => 0.20,
                    'nilai_sikap' => 0.15,
                    'nilai_kedisiplinan' => 0.15,
                    'nilai_kerjasama' => 0.10,
                    'nilai_komunikasi' => 0.10,
                    'nilai_tanggung_jawab' => 0.10,
                ];

                $pesertaTerbaik = $pesertaTerbaik->map(function ($user) use ($max, $bobot) {
                    $nilai = 0;
                    $penilaian = $user->penilaian;

                    foreach ($bobot as $key => $bobotKriteria) {
                        $nilaiKriteria = $penilaian->$key ?? 0;
                        $nilaiMax = $max[$key] ?: 1;
                        $nilai += ($nilaiKriteria / $nilaiMax) * $bobotKriteria;
                    }

                    $user->nilai_saw = round($nilai, 4);

                    $penilaian->update([
                        'nilai_saw' => $user->nilai_saw,
                        'tanggal_perangkingan' => now(),
                    ]);

                    return $user;
                });

                return redirect('/dashboard/penilaian-akhir/peringkat-peserta/admin-pendaftaran?periode=' . $selectedPeriode)
                    ->with('success', 'Perhitungan nilai berhasil.');
            }

            // ✅ Urutkan & beri peringkat
            $pesertaTerbaik = $pesertaTerbaik->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                ->values()
                ->map(function ($user, $index) {
                    $user->peringkat_periode = $index + 1;
                    return $user;
                });
        }

        return view('dashboard.penilaian.rank-ap', [
            'title' => 'Peserta Terbaik',
            'periodes' => $periodes,
            'selectedPeriode' => $selectedPeriode,
            'pesertaTerbaik' => $pesertaTerbaik,
            'isHitung' => $isHitung,
            'nilaiSudahAda' => $nilaiSudahAda,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    public function rankPL(Request $request)
    {
        $periodes = DetailMagang::select('tanggal_mulai', 'tanggal_selesai')
            ->groupBy('tanggal_mulai', 'tanggal_selesai')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        $selectedPeriode = $request->query('periode');
        $isHitung = $request->has('hitung');
        $pesertaTerbaik = collect();
        $nilaiSudahAda = false;

        // ✅ Inisialisasi agar tidak undefined
        $tanggalAwal = null;
        $tanggalAkhir = null;

        // ✅ Jika "semua periode"
        if ($selectedPeriode === 'semua') {
            $tanggalAwal = $request->query('tanggal_awal');
            $tanggalAkhir = $request->query('tanggal_akhir');

            $pesertaTerbaik = User::whereHas('penilaian', function ($query) {
                $query->whereNotNull('nilai_saw');
            })
                ->with(['detailMagang', 'penilaian'])
                ->get();

            $nilaiSudahAda = true;

            // ✅ Filter tanggal perangkingan jika diberikan
            if ($tanggalAwal && $tanggalAkhir) {
                $pesertaTerbaik = $pesertaTerbaik->filter(function ($peserta) use ($tanggalAwal, $tanggalAkhir) {
                    $tanggal = optional($peserta->penilaian)->tanggal_perangkingan;
                    return $tanggal &&
                        $tanggal >= $tanggalAwal &&
                        $tanggal <= $tanggalAkhir;
                });
            }

            // ✅ Hitung peringkat per-periode
            $pesertaTerbaik = $pesertaTerbaik->groupBy(function ($item) {
                return $item->detailMagang->tanggal_mulai . '|' . $item->detailMagang->tanggal_selesai;
            })->flatMap(function ($group) {
                return $group->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                    ->values()
                    ->map(function ($user, $index) {
                        $user->peringkat_periode = $index + 1;
                        return $user;
                    });
            });
        }

        // ✅ Jika periode tertentu
        elseif ($selectedPeriode && strpos($selectedPeriode, '_') !== false) {
            [$mulai, $selesai] = explode('_', $selectedPeriode);

            $pesertaTerbaik = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
                $query->whereDate('tanggal_mulai', $mulai)
                    ->whereDate('tanggal_selesai', $selesai);
            })->with(['detailMagang', 'penilaian'])->get();

            $nilaiSudahAda = $pesertaTerbaik->every(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null);

            // ✅ Proses perhitungan nilai SAW
            if ($isHitung) {
                $semuaAdaPenilaian = $pesertaTerbaik->every(fn($u) => $u->penilaian);

                if (! $semuaAdaPenilaian) {
                    return back()->with('error', 'Tidak semua peserta memiliki data penilaian.');
                }

                $max = [
                    'nilai_kehadiran' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kehadiran ?? 0),
                    'nilai_kegiatan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kegiatan ?? 0),
                    'nilai_sikap' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_sikap ?? 0),
                    'nilai_kedisiplinan' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kedisiplinan ?? 0),
                    'nilai_kerjasama' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_kerjasama ?? 0),
                    'nilai_komunikasi' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_komunikasi ?? 0),
                    'nilai_tanggung_jawab' => $pesertaTerbaik->max(fn($u) => $u->penilaian->nilai_tanggung_jawab ?? 0),
                ];

                $bobot = [
                    'nilai_kehadiran' => 0.20,
                    'nilai_kegiatan' => 0.20,
                    'nilai_sikap' => 0.15,
                    'nilai_kedisiplinan' => 0.15,
                    'nilai_kerjasama' => 0.10,
                    'nilai_komunikasi' => 0.10,
                    'nilai_tanggung_jawab' => 0.10,
                ];

                $pesertaTerbaik = $pesertaTerbaik->map(function ($user) use ($max, $bobot) {
                    $nilai = 0;
                    $penilaian = $user->penilaian;

                    foreach ($bobot as $key => $bobotKriteria) {
                        $nilaiKriteria = $penilaian->$key ?? 0;
                        $nilaiMax = $max[$key] ?: 1;
                        $nilai += ($nilaiKriteria / $nilaiMax) * $bobotKriteria;
                    }

                    $user->nilai_saw = round($nilai, 4);

                    $penilaian->update([
                        'nilai_saw' => $user->nilai_saw,
                        'tanggal_perangkingan' => now(),
                    ]);

                    return $user;
                });

                return redirect('/dashboard/penilaian-akhir/peringkat-peserta/pembimbing-lapangan?periode=' . $selectedPeriode)
                    ->with('success', 'Perhitungan nilai berhasil.');
            }

            // ✅ Urutkan & beri peringkat
            $pesertaTerbaik = $pesertaTerbaik->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)
                ->values()
                ->map(function ($user, $index) {
                    $user->peringkat_periode = $index + 1;
                    return $user;
                });
        }

        return view('dashboard.penilaian.rank-pl', [
            'title' => 'Peserta Terbaik',
            'periodes' => $periodes,
            'selectedPeriode' => $selectedPeriode,
            'pesertaTerbaik' => $pesertaTerbaik,
            'isHitung' => $isHitung,
            'nilaiSudahAda' => $nilaiSudahAda,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    public function edit($user_id)
    {
        $user = User::with(['penilaian'])->findOrFail($user_id);
        $penilaian = $user->detailMagang->penilaianPesertas ?? null;
        $absensiPeserta = AbsensiPeserta::where('user_id', $user->id)->get();
        $kegiatanMagang = KegiatanMagang::where('user_id', $user->id)->get();

        return view('dashboard.penilaian.form', [
            'title' => 'Form Penilaian Peserta',
            'user' => $user,
            'penilaian' => $penilaian,
            'absensiPeserta' => $absensiPeserta,
            'kegiatanMagang' => $kegiatanMagang,
        ]);
    }

    public function editAP($user_id)
    {
        $user = User::with(['penilaian'])->findOrFail($user_id);
        $penilaian = $user->detailMagang->penilaianPesertas ?? null;
        $absensiPeserta = AbsensiPeserta::where('user_id', $user->id)->get();
        $kegiatanMagang = KegiatanMagang::where('user_id', $user->id)->get();

        return view('dashboard.penilaian.form-ap', [
            'title' => 'Form Penilaian Peserta',
            'user' => $user,
            'penilaian' => $penilaian,
            'absensiPeserta' => $absensiPeserta,
            'kegiatanMagang' => $kegiatanMagang,
        ]);
    }

    public function editPL($user_id)
    {
        $user = User::with(['penilaian'])->findOrFail($user_id);
        $penilaian = $user->detailMagang->penilaianPesertas ?? null;
        $absensiPeserta = AbsensiPeserta::where('user_id', $user->id)->get();
        $kegiatanMagang = KegiatanMagang::where('user_id', $user->id)->get();

        return view('dashboard.penilaian.form-pl', [
            'title' => 'Form Penilaian Peserta',
            'user' => $user,
            'penilaian' => $penilaian,
            'absensiPeserta' => $absensiPeserta,
            'kegiatanMagang' => $kegiatanMagang,
        ]);
    }

    public function store(Request $request, $user_id)
    {
        $validated = $request->validate([
            'nilai_kehadiran' => 'required|integer|min:0|max:100',
            'nilai_kegiatan' => 'required|integer|min:0|max:100',
            'nilai_sikap' => 'required|integer|min:0|max:100',
            'nilai_kedisiplinan' => 'required|integer|min:0|max:100',
            'nilai_kerjasama' => 'required|integer|min:0|max:100',
            'nilai_komunikasi' => 'required|integer|min:0|max:100',
            'nilai_tanggung_jawab' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $detailMagang = DetailMagang::where('user_id', $user_id)->first();

        if ($detailMagang) {
            $penilaian = PenilaianPeserta::updateOrCreate(
                ['detail_magang_id' => $detailMagang->id],
                array_merge($validated, [
                    'edited_by' => auth()->id(),
                    'tanggal_penilaian' => now()->toDateString()
                ])
            );

            // Tandai penilaian sebagai selesai
            $penilaian->is_penilaian_selesai = true;
            $penilaian->save();

            $message = $penilaian->wasRecentlyCreated
                ? 'Penilaian Peserta berhasil disimpan!'
                : 'Penilaian Peserta berhasil diperbarui!';

            return redirect("/dashboard/penilaian-akhir/form-penilaian/{$user_id}")
                ->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Detail magang tidak ditemukan!');
        }
    }

    public function storePL(Request $request, $user_id)
    {
        $validated = $request->validate([
            'nilai_kehadiran' => 'required|integer|min:0|max:100',
            'nilai_kegiatan' => 'required|integer|min:0|max:100',
            'nilai_sikap' => 'required|integer|min:0|max:100',
            'nilai_kedisiplinan' => 'required|integer|min:0|max:100',
            'nilai_kerjasama' => 'required|integer|min:0|max:100',
            'nilai_komunikasi' => 'required|integer|min:0|max:100',
            'nilai_tanggung_jawab' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $detailMagang = DetailMagang::where('user_id', $user_id)->first();

        if ($detailMagang) {
            $penilaian = PenilaianPeserta::updateOrCreate(
                ['detail_magang_id' => $detailMagang->id],
                array_merge($validated, [
                    'edited_by' => auth()->id(),
                    'tanggal_penilaian' => now()->toDateString()
                ])
            );

            // Tandai penilaian sebagai selesai
            $penilaian->is_penilaian_selesai = true;
            $penilaian->save();

            $message = $penilaian->wasRecentlyCreated
                ? 'Penilaian Peserta berhasil disimpan!'
                : 'Penilaian Peserta berhasil diperbarui!';

            return redirect("/dashboard/penilaian-akhir/form-penilaian/pembimbing-lapangan/{$user_id}")
                ->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Detail magang tidak ditemukan!');
        }
    }

    public function show()
    {
        $user = auth()->user();
        $penilaian = $user->detailMagang->penilaianPesertas ?? null;

        // Default null
        $linkSertifikatTerbaik = null;

        // Cek apakah peserta punya nilai SAW
        if ($penilaian && $penilaian->nilai_saw) {
            $periode = $user->detailMagang->tanggal_mulai . '_' . $user->detailMagang->tanggal_selesai;

            // Ambil semua peserta pada periode yang sama
            $pesertaPeriode = \App\Models\User::whereHas('detailMagang', function ($query) use ($user) {
                $query->where('tanggal_mulai', $user->detailMagang->tanggal_mulai)
                    ->where('tanggal_selesai', $user->detailMagang->tanggal_selesai);
            })->with('penilaian')->get();

            // Urutkan & beri peringkat
            $pesertaTerurut = $pesertaPeriode->sortByDesc(fn($u) => $u->penilaian->nilai_saw ?? 0)->values();

            // Cek apakah user termasuk 3 besar
            $top3 = $pesertaTerurut->take(3)->pluck('id');
            if ($top3->contains($user->id)) {
                $linkSertifikatTerbaik = "/dashboard/penilaian-akhir/peringkat-peserta-cetak/{$user->id}?periode={$periode}";
            }
        }

        return view('dashboard.penilaian.show', [
            'title' => 'Penilaian Magang Anda',
            'user' => $user,
            'penilaian' => $penilaian,
            'linkSertifikatTerbaik' => $linkSertifikatTerbaik,
        ]);
    }

    public function print($user_id)
    {
        $user = User::with(['detailMagang.penilaianPesertas'])->findOrFail($user_id);
        $penilaian = $user->detailMagang->penilaianPesertas ?? null;
        $detailMagang = $user->detailMagang;

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        // Return view khusus untuk cetak
        return view('dashboard.penilaian.print', [
            'title' => 'Cetak Penilaian Peserta',
            'user' => $user,
            'penilaian' => $penilaian,
            'detailMagang' => $detailMagang,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function generateCertificate($user_id)
    {
        $user = User::with('detailMagang')->findOrFail($user_id);
        $detailMagang = $user->detailMagang;

        if (!$detailMagang) {
            return redirect()->back()->with('error', 'Detail magang tidak ditemukan!');
        }

        $penilaian = \App\Models\PenilaianPeserta::where('detail_magang_id', $detailMagang->id)->first();

        $certificateData = [
            'nama_peserta' => $detailMagang->nama_peserta,
            'nism' => $detailMagang->nism,
            'tanggal_mulai' => $detailMagang->tanggal_mulai,
            'tanggal_selesai' => $detailMagang->tanggal_selesai,
            'kelas_jurusan' => $detailMagang->kelas_jurusan,
            'nomor_sertifikat' => $penilaian->nomor_sertifikat ?? '-',
            'title' => 'Cetak Sertifikat Peserta'
        ];

        return view('dashboard.penilaian.printSertifikat', $certificateData);
    }

    public function printRank(Request $request, $id)
    {
        $selectedPeriode = $request->query('periode');

        if (!$selectedPeriode) {
            return redirect()->back()->with('error', 'Periode belum dipilih.');
        }

        [$mulai, $selesai] = explode('_', $selectedPeriode);

        // Ambil semua peserta sesuai periode & punya nilai_saw
        $peserta = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
            $query->whereDate('tanggal_mulai', $mulai)
                ->whereDate('tanggal_selesai', $selesai);
        })
            ->with(['detailMagang', 'penilaian'])
            ->get()
            ->filter(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null)
            ->sortByDesc(fn($u) => $u->penilaian->nilai_saw)
            ->values();

        // Cari peserta berdasarkan ID
        $targetPeserta = $peserta->firstWhere('id', $id);

        if (!$targetPeserta) {
            return redirect()->back()->with('error', 'Peserta tidak ditemukan.');
        }

        // Hitung peringkat (berdasarkan index)
        $peringkat = $peserta->search(fn($u) => $u->id == $id) + 1;

        $certificateData = [
            'nama_peserta'    => $targetPeserta->detailMagang->nama_peserta ?? '-',
            'kelas_jurusan'   => $targetPeserta->detailMagang->kelas_jurusan ?? '-',
            'tanggal_mulai'   => $targetPeserta->detailMagang->tanggal_mulai,
            'tanggal_selesai' => $targetPeserta->detailMagang->tanggal_selesai,
            'peringkat'       => $peringkat,
            'nomor_sertifikat'    => $targetPeserta->penilaian->nomor_sertifikat ?? '-',
            'title'           => 'Sertifikat Peserta Terbaik'
        ];

        return view('dashboard.penilaian.print-rank', $certificateData);
    }

    public function printRankPL(Request $request, $id)
    {
        $selectedPeriode = $request->query('periode');

        if (!$selectedPeriode) {
            return redirect()->back()->with('error', 'Periode belum dipilih.');
        }

        [$mulai, $selesai] = explode('_', $selectedPeriode);

        // Ambil semua peserta sesuai periode & punya nilai_saw
        $peserta = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
            $query->whereDate('tanggal_mulai', $mulai)
                ->whereDate('tanggal_selesai', $selesai);
        })
            ->with(['detailMagang', 'penilaian'])
            ->get()
            ->filter(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null)
            ->sortByDesc(fn($u) => $u->penilaian->nilai_saw)
            ->values();

        // Cari peserta berdasarkan ID
        $targetPeserta = $peserta->firstWhere('id', $id);

        if (!$targetPeserta) {
            return redirect()->back()->with('error', 'Peserta tidak ditemukan.');
        }

        // Hitung peringkat (berdasarkan index)
        $peringkat = $peserta->search(fn($u) => $u->id == $id) + 1;

        $certificateData = [
            'nama_peserta'    => $targetPeserta->detailMagang->nama_peserta ?? '-',
            'kelas_jurusan'   => $targetPeserta->detailMagang->kelas_jurusan ?? '-',
            'tanggal_mulai'   => $targetPeserta->detailMagang->tanggal_mulai,
            'tanggal_selesai' => $targetPeserta->detailMagang->tanggal_selesai,
            'peringkat'       => $peringkat,
            'nomor_sertifikat'    => $targetPeserta->penilaian->nomor_sertifikat ?? '-',
            'title'           => 'Sertifikat Peserta Terbaik'
        ];

        return view('dashboard.penilaian.printrankpl', $certificateData);
    }

    public function printRankPM(Request $request, $id)
    {
        $selectedPeriode = $request->query('periode');

        if (!$selectedPeriode) {
            return redirect()->back()->with('error', 'Periode belum dipilih.');
        }

        [$mulai, $selesai] = explode('_', $selectedPeriode);

        // Ambil semua peserta sesuai periode & punya nilai_saw
        $peserta = User::whereHas('detailMagang', function ($query) use ($mulai, $selesai) {
            $query->whereDate('tanggal_mulai', $mulai)
                ->whereDate('tanggal_selesai', $selesai);
        })
            ->with(['detailMagang', 'penilaian'])
            ->get()
            ->filter(fn($u) => $u->penilaian && $u->penilaian->nilai_saw !== null)
            ->sortByDesc(fn($u) => $u->penilaian->nilai_saw)
            ->values();

        // Cari peserta berdasarkan ID
        $targetPeserta = $peserta->firstWhere('id', $id);

        if (!$targetPeserta) {
            return redirect()->back()->with('error', 'Peserta tidak ditemukan.');
        }

        // Hitung peringkat (berdasarkan index)
        $peringkat = $peserta->search(fn($u) => $u->id == $id) + 1;

        $certificateData = [
            'nama_peserta'    => $targetPeserta->detailMagang->nama_peserta ?? '-',
            'kelas_jurusan'   => $targetPeserta->detailMagang->kelas_jurusan ?? '-',
            'tanggal_mulai'   => $targetPeserta->detailMagang->tanggal_mulai,
            'tanggal_selesai' => $targetPeserta->detailMagang->tanggal_selesai,
            'peringkat'       => $peringkat,
            'nomor_sertifikat'    => $targetPeserta->penilaian->nomor_sertifikat ?? '-',
            'title'           => 'Sertifikat Peserta Terbaik'
        ];

        return view('dashboard.penilaian.printrankpl', $certificateData);
    }

    public function printSertifikat(Request $request)
    {
        $query = PenilaianPeserta::with('detailMagang')
            ->whereNotNull('nomor_sertifikat');

        if ($request->filled('tanggal_awal_sertifikat') && $request->filled('tanggal_akhir_sertifikat')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_sertifikat)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_sertifikat)->endOfDay();
                $query->whereBetween('tanggal_sertifikat', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle error (optional)
            }
        }

        $daftarSertifikat = $query->get();
        $tanggal_terkecil = $daftarSertifikat->min('tanggal_sertifikat');
        $tanggal_terbesar = $daftarSertifikat->max('tanggal_sertifikat');
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');

        return view('dashboard.penilaian.printLaporanSertifikat', [
            'daftarSertifikat' => $daftarSertifikat,
            'tanggal_awal_sertifikat' => $request->tanggal_awal_sertifikat,
            'tanggal_akhir_sertifikat' => $request->tanggal_akhir_sertifikat,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'title' => 'Laporan Sertifikat Magang'
        ]);
    }

    public function printSertifikatPL(Request $request)
    {
        $query = PenilaianPeserta::with('detailMagang')
            ->whereNotNull('nomor_sertifikat');

        if ($request->filled('tanggal_awal_sertifikat') && $request->filled('tanggal_akhir_sertifikat')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_sertifikat)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_sertifikat)->endOfDay();
                $query->whereBetween('tanggal_sertifikat', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle error (optional)
            }
        }

        $daftarSertifikat = $query->get();
        $tanggal_terkecil = $daftarSertifikat->min('tanggal_sertifikat');
        $tanggal_terbesar = $daftarSertifikat->max('tanggal_sertifikat');
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');

        return view('dashboard.penilaian.printLaporanSertifikat', [
            'daftarSertifikat' => $daftarSertifikat,
            'tanggal_awal_sertifikat' => $request->tanggal_awal_sertifikat,
            'tanggal_akhir_sertifikat' => $request->tanggal_akhir_sertifikat,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'title' => 'Laporan Sertifikat Magang'
        ]);
    }

    public function printAllRanking(Request $request)
    {
        $query = PenilaianPeserta::with('detailMagang');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
                $query->whereBetween('tanggal_perangkingan', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Log error jika perlu
            }
        }

        $data = $query->orderBy('tanggal_perangkingan', 'desc')->get();

        // Kelompokkan berdasarkan periode magang (tanggal mulai & selesai)
        $data = $data->groupBy(function ($item) {
            $mulai = optional($item->detailMagang)->tanggal_mulai;
            $selesai = optional($item->detailMagang)->tanggal_selesai;
            return $mulai . '|' . $selesai;
        })->flatMap(function ($group) {
            return $group->sortByDesc('nilai_saw')->values()->map(function ($item, $index) {
                $item->peringkat_periode = $index + 1;
                return $item;
            });
        });

        $tanggal_terkecil = $data->min('tanggal_perangkingan');
        $tanggal_terbesar = $data->max('tanggal_perangkingan');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.penilaian.printLaporanRanking', [
            'title' => 'Laporan Peringkat Peserta Terbaik',
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printAllRankingPL(Request $request)
    {
        $query = PenilaianPeserta::with('detailMagang');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
                $query->whereBetween('tanggal_perangkingan', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Log error jika perlu
            }
        }

        $data = $query->orderBy('tanggal_perangkingan', 'desc')->get();

        // Kelompokkan berdasarkan periode magang (tanggal mulai & selesai)
        $data = $data->groupBy(function ($item) {
            $mulai = optional($item->detailMagang)->tanggal_mulai;
            $selesai = optional($item->detailMagang)->tanggal_selesai;
            return $mulai . '|' . $selesai;
        })->flatMap(function ($group) {
            return $group->sortByDesc('nilai_saw')->values()->map(function ($item, $index) {
                $item->peringkat_periode = $index + 1;
                return $item;
            });
        });

        $tanggal_terkecil = $data->min('tanggal_perangkingan');
        $tanggal_terbesar = $data->max('tanggal_perangkingan');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.penilaian.printLaporanRanking', [
            'title' => 'Laporan Peringkat Peserta Terbaik',
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }
}
