<?php

namespace App\Http\Controllers;

use App\Models\KegiatanMagang;
use App\Models\PenilaianPeserta;
use App\Models\PenilaianPembimbing;
use App\Models\Ruangan;
use App\Models\AbsensiPeserta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $queryKegiatan = KegiatanMagang::with(['user', 'detailMagang']);
        $queryAbsensi = AbsensiPeserta::with('detailMagang');
        $queryPenilaian = PenilaianPeserta::with('detailMagang');
        $queryPenilaianPembimbing = PenilaianPembimbing::with('detailMagang');

        if ($request->filled('tanggal_awal_kegiatan') && $request->filled('tanggal_akhir_kegiatan')) {
            $awal = Carbon::parse($request->tanggal_awal_kegiatan)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_kegiatan)->endOfDay();
            $queryKegiatan->whereBetween('tanggal_kegiatan', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_kegiatan')) {
            $tanggal = Carbon::parse($request->tanggal_kegiatan)->format('Y-m-d');
            $queryKegiatan->whereDate('tanggal_kegiatan', $tanggal);
        }

        if ($request->filled('tanggal_awal_absensi') && $request->filled('tanggal_akhir_absensi')) {
            $awal = Carbon::parse($request->tanggal_awal_absensi)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_absensi)->endOfDay();
            $queryAbsensi->whereBetween('hari_tanggal', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_absensi')) {
            $tanggal = Carbon::parse($request->tanggal_absensi)->format('Y-m-d');
            $queryAbsensi->whereDate('hari_tanggal', $tanggal);
        }

        if ($request->filled('tanggal_awal_penilaian') && $request->filled('tanggal_akhir_penilaian')) {
            $awal = Carbon::parse($request->tanggal_awal_penilaian)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_penilaian)->endOfDay();
            $queryPenilaian->whereBetween('tanggal_penilaian', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_penilaian')) {
            $tanggal = Carbon::parse($request->tanggal_penilaian)->format('Y-m-d');
            $queryPenilaian->whereDate('tanggal_penilaian', $tanggal);
        }

        if ($request->filled('tanggal_awal_penilaian_pembimbing') && $request->filled('tanggal_akhir_penilaian_pembimbing')) {
            $awal = Carbon::parse($request->tanggal_awal_penilaian_pembimbing)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_penilaian_pembimbing)->endOfDay();
            $queryPenilaianPembimbing->whereBetween('tanggal_penilaian', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_penilaian_pembimbing')) {
            $tanggal = Carbon::parse($request->tanggal_penilaian_pembimbing)->format('Y-m-d');
            $queryPenilaianPembimbing->whereDate('tanggal_penilaian', $tanggal);
        }

        return view('dashboard.laporan.index', [
            'title' => 'Laporan Peserta',
            'kegiatanMagang' => $queryKegiatan->get(),
            'absensiPeserta' => $queryAbsensi->get(),
            'penilaianPeserta' => $queryPenilaian->get(),
            'penilaianPembimbing' => $queryPenilaianPembimbing->get(),
        ]);
    }

    public function indexPL(Request $request)
    {
        $queryKegiatan = KegiatanMagang::with(['user', 'detailMagang']);
        $queryAbsensi = AbsensiPeserta::with('detailMagang');
        $queryPenilaian = PenilaianPeserta::with('detailMagang');
        $queryPenilaianPembimbing = PenilaianPembimbing::with('detailMagang');

        if ($request->filled('tanggal_awal_kegiatan') && $request->filled('tanggal_akhir_kegiatan')) {
            $awal = Carbon::parse($request->tanggal_awal_kegiatan)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_kegiatan)->endOfDay();
            $queryKegiatan->whereBetween('tanggal_kegiatan', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_kegiatan')) {
            $tanggal = Carbon::parse($request->tanggal_kegiatan)->format('Y-m-d');
            $queryKegiatan->whereDate('tanggal_kegiatan', $tanggal);
        }

        if ($request->filled('tanggal_awal_absensi') && $request->filled('tanggal_akhir_absensi')) {
            $awal = Carbon::parse($request->tanggal_awal_absensi)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_absensi)->endOfDay();
            $queryAbsensi->whereBetween('hari_tanggal', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_absensi')) {
            $tanggal = Carbon::parse($request->tanggal_absensi)->format('Y-m-d');
            $queryAbsensi->whereDate('hari_tanggal', $tanggal);
        }

        if ($request->filled('tanggal_awal_penilaian') && $request->filled('tanggal_akhir_penilaian')) {
            $awal = Carbon::parse($request->tanggal_awal_penilaian)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_penilaian)->endOfDay();
            $queryPenilaian->whereBetween('tanggal_penilaian', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_penilaian')) {
            $tanggal = Carbon::parse($request->tanggal_penilaian)->format('Y-m-d');
            $queryPenilaian->whereDate('tanggal_penilaian', $tanggal);
        }

        if ($request->filled('tanggal_awal_penilaian_pembimbing') && $request->filled('tanggal_akhir_penilaian_pembimbing')) {
            $awal = Carbon::parse($request->tanggal_awal_penilaian_pembimbing)->startOfDay();
            $akhir = Carbon::parse($request->tanggal_akhir_penilaian_pembimbing)->endOfDay();
            $queryPenilaianPembimbing->whereBetween('tanggal_penilaian', [$awal, $akhir]);
        } elseif ($request->filled('tanggal_penilaian_pembimbing')) {
            $tanggal = Carbon::parse($request->tanggal_penilaian_pembimbing)->format('Y-m-d');
            $queryPenilaianPembimbing->whereDate('tanggal_penilaian', $tanggal);
        }

        return view('dashboard.laporan.indexpl', [
            'title' => 'Laporan Peserta',
            'kegiatanMagang' => $queryKegiatan->get(),
            'absensiPeserta' => $queryAbsensi->get(),
            'penilaianPeserta' => $queryPenilaian->get(),
            'penilaianPembimbing' => $queryPenilaianPembimbing->get(),
        ]);
    }

    public function print(Request $request)
    {
        $query = KegiatanMagang::with(['user', 'detailMagang']);

        // Filter periode (disesuaikan dengan nama parameter baru)
        if ($request->filled('tanggal_awal_kegiatan') && $request->filled('tanggal_akhir_kegiatan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_kegiatan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_kegiatan)->endOfDay();
                $query->whereBetween('tanggal_kegiatan', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        } elseif ($request->filled('tanggal_kegiatan')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_kegiatan)->format('Y-m-d');
                $query->whereDate('tanggal_kegiatan', $tanggal);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }

        $kegiatanMagang = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.print', [
            'title' => 'Laporan Kegiatan Peserta',
            'kegiatanMagang' => $kegiatanMagang,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_kegiatan' => $request->tanggal_awal_kegiatan,
            'tanggal_akhir_kegiatan' => $request->tanggal_akhir_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
        ]);
    }

    public function printPL(Request $request)
    {
        $query = KegiatanMagang::with(['user', 'detailMagang']);

        // Filter periode (disesuaikan dengan nama parameter baru)
        if ($request->filled('tanggal_awal_kegiatan') && $request->filled('tanggal_akhir_kegiatan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_kegiatan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_kegiatan)->endOfDay();
                $query->whereBetween('tanggal_kegiatan', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        } elseif ($request->filled('tanggal_kegiatan')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_kegiatan)->format('Y-m-d');
                $query->whereDate('tanggal_kegiatan', $tanggal);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }

        $kegiatanMagang = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printpl', [
            'title' => 'Laporan Kegiatan Peserta',
            'kegiatanMagang' => $kegiatanMagang,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_kegiatan' => $request->tanggal_awal_kegiatan,
            'tanggal_akhir_kegiatan' => $request->tanggal_akhir_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
        ]);
    }

    public function printAbsensi(Request $request)
    {
        $query = AbsensiPeserta::with(['user', 'detailMagang']);

        // Filter periode (pakai hari_tanggal)
        if ($request->filled('tanggal_awal_absensi') && $request->filled('tanggal_akhir_absensi')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_absensi)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_absensi)->endOfDay();
                $query->whereBetween('hari_tanggal', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }
        // Fallback: filter satu tanggal
        elseif ($request->filled('tanggal_absensi')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_absensi)->format('Y-m-d');
                $query->whereDate('hari_tanggal', $tanggal);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }

        $absensiPeserta = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printabsensi', [
            'title' => 'Laporan Absensi Peserta',
            'absensiPeserta' => $absensiPeserta,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_absensi' => $request->tanggal_awal_absensi,
            'tanggal_akhir_absensi' => $request->tanggal_akhir_absensi,
            'tanggal_absensi' => $request->tanggal_absensi,
        ]);
    }

    public function printAbsensiPL(Request $request)
    {
        $query = AbsensiPeserta::with(['user', 'detailMagang']);

        // Filter periode (pakai hari_tanggal)
        if ($request->filled('tanggal_awal_absensi') && $request->filled('tanggal_akhir_absensi')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_absensi)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_absensi)->endOfDay();
                $query->whereBetween('hari_tanggal', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }
        // Fallback: filter satu tanggal
        elseif ($request->filled('tanggal_absensi')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_absensi)->format('Y-m-d');
                $query->whereDate('hari_tanggal', $tanggal);
            } catch (\Exception $e) {
                // Tanggal tidak valid
            }
        }

        $absensiPeserta = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printabsensipl', [
            'title' => 'Laporan Absensi Peserta',
            'absensiPeserta' => $absensiPeserta,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_absensi' => $request->tanggal_awal_absensi,
            'tanggal_akhir_absensi' => $request->tanggal_akhir_absensi,
            'tanggal_absensi' => $request->tanggal_absensi,
        ]);
    }

    public function printPenilaian(Request $request)
    {
        $query = PenilaianPeserta::with(['detailMagang']);

        if ($request->filled('tanggal_awal_penilaian') && $request->filled('tanggal_akhir_penilaian')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_penilaian)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_penilaian)->endOfDay();
                $query->whereBetween('tanggal_penilaian', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        } elseif ($request->filled('tanggal_penilaian')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_penilaian)->format('Y-m-d');
                $query->whereDate('tanggal_penilaian', $tanggal);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        }

        $penilaianPeserta = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printpenilaian', [
            'title' => 'Laporan Penilaian Peserta',
            'penilaianPeserta' => $penilaianPeserta,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_penilaian' => $request->tanggal_awal_penilaian,
            'tanggal_akhir_penilaian' => $request->tanggal_akhir_penilaian,
            'tanggal_penilaian' => $request->tanggal_penilaian,
        ]);
    }

    public function printPenilaianPL(Request $request)
    {
        $query = PenilaianPeserta::with(['detailMagang']);

        if ($request->filled('tanggal_awal_penilaian') && $request->filled('tanggal_akhir_penilaian')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_penilaian)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_penilaian)->endOfDay();
                $query->whereBetween('tanggal_penilaian', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        } elseif ($request->filled('tanggal_penilaian')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_penilaian)->format('Y-m-d');
                $query->whereDate('tanggal_penilaian', $tanggal);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        }

        $penilaianPeserta = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printpenilaianpl', [
            'title' => 'Laporan Penilaian Peserta',
            'penilaianPeserta' => $penilaianPeserta,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_penilaian' => $request->tanggal_awal_penilaian,
            'tanggal_akhir_penilaian' => $request->tanggal_akhir_penilaian,
            'tanggal_penilaian' => $request->tanggal_penilaian,
        ]);
    }

    public function printPenilaianPembimbing(Request $request)
    {
        $query = PenilaianPembimbing::with(['detailMagang', 'pembimbing']);

        if ($request->filled('tanggal_awal_penilaian_pembimbing') && $request->filled('tanggal_akhir_penilaian_pembimbing')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_penilaian_pembimbing)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_penilaian_pembimbing)->endOfDay();
                $query->whereBetween('tanggal_penilaian', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        } elseif ($request->filled('tanggal_penilaian_pembimbing')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_penilaian_pembimbing)->format('Y-m-d');
                $query->whereDate('tanggal_penilaian', $tanggal);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        }

        $penilaianPembimbing = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printpembimbing', [
            'title' => 'Laporan Penilaian Pembimbing',
            'penilaianPembimbing' => $penilaianPembimbing,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_penilaian_pembimbing' => $request->tanggal_awal_penilaian_pembimbing,
            'tanggal_akhir_penilaian_pembimbing' => $request->tanggal_akhir_penilaian_pembimbing,
            'tanggal_penilaian_pembimbing' => $request->tanggal_penilaian_pembimbing,
        ]);
    }

    public function printPenilaianPembimbingPL(Request $request)
    {
        $query = PenilaianPembimbing::with(['detailMagang', 'pembimbing']);

        if ($request->filled('tanggal_awal_penilaian_pembimbing') && $request->filled('tanggal_akhir_penilaian_pembimbing')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_penilaian_pembimbing)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_penilaian_pembimbing)->endOfDay();
                $query->whereBetween('tanggal_penilaian', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        } elseif ($request->filled('tanggal_penilaian_pembimbing')) {
            try {
                $tanggal = Carbon::parse($request->tanggal_penilaian_pembimbing)->format('Y-m-d');
                $query->whereDate('tanggal_penilaian', $tanggal);
            } catch (\Exception $e) {
                // Handle invalid date format
            }
        }

        $penilaianPembimbing = $query->get();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.laporan.printpembimbingpl', [
            'title' => 'Laporan Penilaian Pembimbing',
            'penilaianPembimbing' => $penilaianPembimbing,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
            'tanggal_awal_penilaian_pembimbing' => $request->tanggal_awal_penilaian_pembimbing,
            'tanggal_akhir_penilaian_pembimbing' => $request->tanggal_akhir_penilaian_pembimbing,
            'tanggal_penilaian_pembimbing' => $request->tanggal_penilaian_pembimbing,
        ]);
    }
}
