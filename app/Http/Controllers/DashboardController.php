<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanGrafik;
use App\Models\DetailMagang;
use App\Models\JadwalMagang;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'detail' => $detail,
        ]);
    }

    public function indexAdmin(Request $request)
    {
        // Hitung jumlah pengguna terdaftar
        $jumlahPenggunaTerdaftar = User::all()->count();

        // Hitung jumlah peserta magang
        $jumlahPesertaMagang = User::where('is_admin', 0)->count();

        // Hitung jumlah admin pendaftaran
        $jumlahAdminPendaftaran = User::where('is_admin', 2)->count();

        // Hitung jumlah pembimbing lapangan
        $jumlahPembimbingLapangan = User::where('is_admin', 3)->count();

        // Ambil filter periode tanggal
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Jika tidak ada input, gunakan periode dari tanggal_mulai paling akhir
        if (!$tanggalAwal || !$tanggalAkhir) {
            $latestDate = LaporanGrafik::max('tanggal_mulai');

            if ($latestDate) {
                $tanggalAwal = Carbon::parse($latestDate)->startOfMonth()->toDateString();
                $tanggalAkhir = Carbon::parse($latestDate)->endOfMonth()->toDateString();
            } else {
                // fallback jika tidak ada data
                $tanggalAwal = now()->startOfMonth()->toDateString();
                $tanggalAkhir = now()->endOfMonth()->toDateString();
            }
        }

        // Ambil data berdasarkan periode tanggal
        $data = LaporanGrafik::select('asal_sekolah_universitas', DB::raw('SUM(jumlah) as jumlah'))
            ->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('asal_sekolah_universitas')
            ->orderByDesc('jumlah')
            ->get();

        $labels = $data->pluck('asal_sekolah_universitas');
        $series = $data->pluck('jumlah');
        $total = $series->sum();

        // === Data tahunan tetap seperti semula ===
        $filterTahun = $request->input('tahun', now()->format('Y'));

        $dataTahunRaw = LaporanGrafik::select(
            DB::raw('MONTH(tanggal_mulai) as bulan'),
            DB::raw('SUM(jumlah) as jumlah')
        )
            ->whereYear('tanggal_mulai', $filterTahun)
            ->groupBy(DB::raw('MONTH(tanggal_mulai)'))
            ->orderBy(DB::raw('MONTH(tanggal_mulai)'))
            ->get()
            ->keyBy('bulan');

        $dataTahun = collect();
        for ($i = 1; $i <= 12; $i++) {
            $dataTahun->push((object)[
                'bulan' => $i,
                'jumlah' => $dataTahunRaw[$i]->jumlah ?? 0
            ]);
        }

        $labelsTahun = $dataTahun->map(function ($item) {
            return Carbon::create()->month($item->bulan)->translatedFormat('F');
        });
        $seriesTahun = $dataTahun->pluck('jumlah');
        $totalTahun = $seriesTahun->sum();

        return view('dashboard.index-admin', [
            'title' => 'Dashboard Admin',
            'jumlahPenggunaTerdaftar' => $jumlahPenggunaTerdaftar,
            'jumlahPesertaMagang' => $jumlahPesertaMagang,
            'jumlahAdminPendaftaran' => $jumlahAdminPendaftaran,
            'jumlahPembimbingLapangan' => $jumlahPembimbingLapangan,
            'labels' => $labels,
            'series' => $series,
            'data' => $data,
            'total' => $total,
            'labelsTahun' => $labelsTahun,
            'seriesTahun' => $seriesTahun,
            'dataTahun' => $dataTahun,
            'totalTahun' => $totalTahun,
            'filterTahun' => $filterTahun,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    public function indexAdminPendaftaran()
    {
        // Hitung jumlah pengguna terdaftar
        $jumlahPenggunaTerdaftar = User::all()->count();

        // Hitung jumlah peserta magang
        $jumlahPesertaMagang = User::where('is_admin', 0)->count();

        // Hitung jumlah admin pendaftaran
        $jumlahAdminPendaftaran = User::where('is_admin', 2)->count();

        // Hitung jumlah pembimbing lapangan
        $jumlahPembimbingLapangan = User::where('is_admin', 3)->count();

        return view('dashboard.index-ap', [
            'title' => 'Dashboard Admin',
            'jumlahPenggunaTerdaftar' => $jumlahPenggunaTerdaftar,
            'jumlahPesertaMagang' => $jumlahPesertaMagang,
            'jumlahAdminPendaftaran' => $jumlahAdminPendaftaran,
            'jumlahPembimbingLapangan' => $jumlahPembimbingLapangan,
        ]);
    }

    public function indexPembimbingLapangan()
    {
        // Hitung jumlah peserta magang
        $jumlahPesertaMagang = User::where('is_admin', 3)
            ->where('status_verifikasi', 'verified')
            ->count();

        // Hitung jumlah admin pendaftaran
        $jumlahAdminPendaftaran = User::where('is_admin', 2)->count();

        // Hitung jumlah admin pendaftaran
        $jumlahPembimbingLapangan = User::where('is_admin', 3)->count();

        return view('dashboard.index-pl', [
            'title' => 'Dashboard Admin',
            'jumlahPesertaMagang' => $jumlahPesertaMagang,
            'jumlahAdminPendaftaran' => $jumlahAdminPendaftaran,
            'jumlahPembimbingLapangan' => $jumlahPembimbingLapangan,
        ]);
    }
}
