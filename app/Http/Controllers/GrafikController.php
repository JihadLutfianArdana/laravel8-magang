<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanGrafik;
use App\Models\DetailMagang;
use App\Models\JadwalMagang;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function index(Request $request)
    {
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

        return view('dashboard.grafik.index', [
            'title' => 'Laporan Grafik Penerimaan',
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

    public function indexAP(Request $request)
    {
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

        return view('dashboard.grafik.indexAP', [
            'title' => 'Laporan Grafik Penerimaan',
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

    public function print(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if (!$tanggalAwal || !$tanggalAkhir) {
            $latestDate = LaporanGrafik::max('tanggal_mulai');

            if ($latestDate) {
                $tanggalAwal = \Carbon\Carbon::parse($latestDate)->startOfMonth()->toDateString();
                $tanggalAkhir = \Carbon\Carbon::parse($latestDate)->endOfMonth()->toDateString();
            } else {
                $tanggalAwal = now()->startOfMonth()->toDateString();
                $tanggalAkhir = now()->endOfMonth()->toDateString();
            }
        }

        $data = LaporanGrafik::select('asal_sekolah_universitas', DB::raw('SUM(jumlah) as jumlah'))
            ->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('asal_sekolah_universitas')
            ->orderByDesc('jumlah')
            ->get();

        $labels = $data->pluck('asal_sekolah_universitas');
        $series = $data->pluck('jumlah');
        $total = $series->sum();

        $jadwal = JadwalMagang::all();
        $ruangans = Ruangan::all();
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.grafik.print', [
            'title' => 'Cetak Grafik Penerimaan',
            'labels' => $labels,
            'series' => $series,
            'data' => $data,
            'total' => $total,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'jadwal' => $jadwal,
            'ruangans' => $ruangans,
            'detail' => $detail,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printAP(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if (!$tanggalAwal || !$tanggalAkhir) {
            $latestDate = LaporanGrafik::max('tanggal_mulai');

            if ($latestDate) {
                $tanggalAwal = \Carbon\Carbon::parse($latestDate)->startOfMonth()->toDateString();
                $tanggalAkhir = \Carbon\Carbon::parse($latestDate)->endOfMonth()->toDateString();
            } else {
                $tanggalAwal = now()->startOfMonth()->toDateString();
                $tanggalAkhir = now()->endOfMonth()->toDateString();
            }
        }

        $data = LaporanGrafik::select('asal_sekolah_universitas', DB::raw('SUM(jumlah) as jumlah'))
            ->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('asal_sekolah_universitas')
            ->orderByDesc('jumlah')
            ->get();

        $labels = $data->pluck('asal_sekolah_universitas');
        $series = $data->pluck('jumlah');
        $total = $series->sum();

        $jadwal = JadwalMagang::all();
        $ruangans = Ruangan::all();
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.grafik.printAP', [
            'title' => 'Cetak Grafik Penerimaan',
            'labels' => $labels,
            'series' => $series,
            'data' => $data,
            'total' => $total,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'jadwal' => $jadwal,
            'ruangans' => $ruangans,
            'detail' => $detail,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printTahunan(Request $request)
    {
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
            if (isset($dataTahunRaw[$i]) && $dataTahunRaw[$i]->jumlah > 0) {
                $dataTahun->push((object)[
                    'bulan' => $i,
                    'jumlah' => $dataTahunRaw[$i]->jumlah
                ]);
            }
        }

        $labelsTahun = $dataTahun->map(function ($item) {
            return Carbon::create()->month($item->bulan)->translatedFormat('F');
        });

        $seriesTahun = $dataTahun->pluck('jumlah');
        $totalTahun = $seriesTahun->sum();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.grafik.printTahunan', [
            'title' => 'Cetak Grafik Tahunan',
            'labelsTahun' => $labelsTahun,
            'seriesTahun' => $seriesTahun,
            'dataTahun' => $dataTahun,
            'totalTahun' => $totalTahun,
            'filterTahun' => $filterTahun,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printTahunanAP(Request $request)
    {
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
            if (isset($dataTahunRaw[$i]) && $dataTahunRaw[$i]->jumlah > 0) {
                $dataTahun->push((object)[
                    'bulan' => $i,
                    'jumlah' => $dataTahunRaw[$i]->jumlah
                ]);
            }
        }

        $labelsTahun = $dataTahun->map(function ($item) {
            return Carbon::create()->month($item->bulan)->translatedFormat('F');
        });

        $seriesTahun = $dataTahun->pluck('jumlah');
        $totalTahun = $seriesTahun->sum();

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.grafik.printTahunanAP', [
            'title' => 'Cetak Grafik Tahunan',
            'labelsTahun' => $labelsTahun,
            'seriesTahun' => $seriesTahun,
            'dataTahun' => $dataTahun,
            'totalTahun' => $totalTahun,
            'filterTahun' => $filterTahun,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }
}
