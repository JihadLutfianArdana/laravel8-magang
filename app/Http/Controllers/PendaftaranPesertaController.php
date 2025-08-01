<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftaranPeserta;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Carbon;
use App\Models\SuratBalasanMagang;
use Illuminate\Support\Str;

class PendaftaranPesertaController extends Controller
{
    public function home()
    {
        return view('pendaftaran.homepage', [
            'title' => 'Halaman Utama'
        ]);
    }

    public function about()
    {
        return view('pendaftaran.about', [
            'title' => 'Tentang Kami'
        ]);
    }

    public function program()
    {
        return view('pendaftaran.program', [
            'title' => 'Program Magang'
        ]);
    }
    public function main()
    {
        return view('pendaftaran.index', [
            'title' => 'Halaman Utama'
        ]);
    }

    public function daftar()
    {
        return view('pendaftaran.daftar', [
            'title' => 'Halaman Pendaftaran'
        ]);
    }

    public function index(Request $request)
    {
        // Filter untuk list peserta
        $pendaftaranQuery = PendaftaranPeserta::query();

        if ($request->filled('tanggal_awal_persetujuan') && $request->filled('tanggal_akhir_persetujuan')) {
            $awal = \Carbon\Carbon::parse($request->tanggal_awal_persetujuan)->startOfDay();
            $akhir = \Carbon\Carbon::parse($request->tanggal_akhir_persetujuan)->endOfDay();
            $pendaftaranQuery->whereBetween('created_at', [$awal, $akhir]);
        }

        $pendaftaranPesertas = $pendaftaranQuery->get();

        // Filter untuk surat balasan
        $balasanQuery = SuratBalasanMagang::with('peserta')->where('user_id', auth()->id());

        if ($request->filled('tanggal_awal_balasan') && $request->filled('tanggal_akhir_balasan')) {
            $awalBalasan = \Carbon\Carbon::parse($request->tanggal_awal_balasan)->startOfDay();
            $akhirBalasan = \Carbon\Carbon::parse($request->tanggal_akhir_balasan)->endOfDay();
            $balasanQuery->whereBetween('tanggal', [$awalBalasan, $akhirBalasan]);
        }

        $suratBalasanList = $balasanQuery->oldest()->get();

        // Data tambahan
        $unreadCount = PendaftaranPeserta::where('is_checked', false)->count();

        $jumlahPesertaAktif = User::where('is_admin', 0)
            ->whereHas('detailMagang')
            ->count();

        $kuotaMax = 10;

        return view('pendaftaran.admin', [
            'title' => 'Pendaftaran Peserta',
            'pendaftaranPesertas' => $pendaftaranPesertas,
            'suratBalasanList' => $suratBalasanList,
            'unreadCount' => $unreadCount,
            'jumlahPesertaAktif' => $jumlahPesertaAktif,
            'kuotaMax' => $kuotaMax,
        ]);
    }

    public function indexAP(Request $request)
    {
        // Filter untuk list peserta
        $pendaftaranQuery = PendaftaranPeserta::query();

        if ($request->filled('tanggal_awal_persetujuan') && $request->filled('tanggal_akhir_persetujuan')) {
            $awal = \Carbon\Carbon::parse($request->tanggal_awal_persetujuan)->startOfDay();
            $akhir = \Carbon\Carbon::parse($request->tanggal_akhir_persetujuan)->endOfDay();
            $pendaftaranQuery->whereBetween('created_at', [$awal, $akhir]);
        }

        $pendaftaranPesertas = $pendaftaranQuery->get();

        // Filter untuk surat balasan
        $balasanQuery = SuratBalasanMagang::with('peserta')->where('user_id', auth()->id());

        if ($request->filled('tanggal_awal_balasan') && $request->filled('tanggal_akhir_balasan')) {
            $awalBalasan = \Carbon\Carbon::parse($request->tanggal_awal_balasan)->startOfDay();
            $akhirBalasan = \Carbon\Carbon::parse($request->tanggal_akhir_balasan)->endOfDay();
            $balasanQuery->whereBetween('tanggal', [$awalBalasan, $akhirBalasan]);
        }

        $suratBalasanList = $balasanQuery->oldest()->get();

        // Data tambahan
        $unreadCount = PendaftaranPeserta::where('is_checked', false)->count();

        $jumlahPesertaAktif = User::where('is_admin', 0)
            ->whereHas('detailMagang')
            ->count();

        $kuotaMax = 10;

        return view('pendaftaran.admin-ap', [
            'title' => 'Pendaftaran Peserta',
            'pendaftaranPesertas' => $pendaftaranPesertas,
            'suratBalasanList' => $suratBalasanList,
            'unreadCount' => $unreadCount,
            'jumlahPesertaAktif' => $jumlahPesertaAktif,
            'kuotaMax' => $kuotaMax,
        ]);
    }

    public function showSurat($id)
    {
        $pendaftaranPesertas = PendaftaranPeserta::all();
        $peserta = PendaftaranPeserta::findOrFail($id);

        $suratBalasan = SuratBalasanMagang::with('peserta')
            ->where('pendaftaran_peserta_id', $id)
            ->first();

        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');
        $kodeInstansi = 'BP-KES';

        if (!$suratBalasan) {
            // Ambil surat terakhir untuk bulan & tahun yang sama
            $lastSurat = SuratBalasanMagang::whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->orderBy('id', 'desc')
                ->first();

            if ($lastSurat) {
                // Ambil nomor urut dari format: 001/BP-KES/07/2025
                $lastNumber = (int) explode('/', $lastSurat->nomor_surat)[0];
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            $nomorSuratOtomatis = "$nextNumber/$kodeInstansi/$bulan/$tahun";
        } else {
            $nomorSuratOtomatis = $suratBalasan->nomor_surat;
        }

        return view('pendaftaran.showsurat', [
            'title' => 'Buat Surat Balasan',
            'pendaftaranPesertas' => $pendaftaranPesertas,
            'suratBalasan' => $suratBalasan,
            'peserta' => $peserta,
            'nomorSuratOtomatis' => $nomorSuratOtomatis,
        ]);
    }

    public function showSuratAP($id)
    {
        $pendaftaranPesertas = PendaftaranPeserta::all();
        $peserta = PendaftaranPeserta::findOrFail($id);

        $suratBalasan = SuratBalasanMagang::with('peserta')
            ->where('pendaftaran_peserta_id', $id)
            ->first();

        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');
        $kodeInstansi = 'BP-KES';

        if (!$suratBalasan) {
            // Ambil surat terakhir untuk bulan & tahun yang sama
            $lastSurat = SuratBalasanMagang::whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->orderBy('id', 'desc')
                ->first();

            if ($lastSurat) {
                // Ambil nomor urut dari format: 001/BP-KES/07/2025
                $lastNumber = (int) explode('/', $lastSurat->nomor_surat)[0];
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            $nomorSuratOtomatis = "$nextNumber/$kodeInstansi/$bulan/$tahun";
        } else {
            $nomorSuratOtomatis = $suratBalasan->nomor_surat;
        }

        return view('pendaftaran.showsurat-ap', [
            'title' => 'Buat Surat Balasan',
            'pendaftaranPesertas' => $pendaftaranPesertas,
            'suratBalasan' => $suratBalasan,
            'peserta' => $peserta,
            'nomorSuratOtomatis' => $nomorSuratOtomatis,
        ]);
    }

    public function updateCheckStatus(Request $request)
    {
        $peserta = PendaftaranPeserta::findOrFail($request->id);
        $peserta->is_checked = !$peserta->is_checked;

        if ($peserta->is_checked) {
            $peserta->status = 'Disetujui';
            $peserta->tanggal_disetujui = now();
        } else {
            $peserta->status = 'Pending';
            $peserta->tanggal_disetujui = null;
        }

        $peserta->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nism' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:pendaftaran_pesertas',
            'asal_sekolah_universitas' => 'required|string|max:255',
            'kelas_jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024', // Maks 2MB
        ]);

        // Format nomor telepon (Pastikan nomor diawali dengan 62)
        $noTelepon = $validated['no_telepon'];

        // Jika nomor telepon diawali dengan 0, ganti dengan +62
        if (substr($noTelepon, 0, 1) === '0') {
            $noTelepon = '62' . substr($noTelepon, 1);
        }

        // Upload file surat pengantar
        $filePath = $request->file('surat_pengantar')->store('surat_pengantar', 'public');

        // Simpan data ke database
        PendaftaranPeserta::create([
            'nism' => $validated['nism'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $noTelepon,
            'email' => $validated['email'],
            'asal_sekolah_universitas' => $validated['asal_sekolah_universitas'],
            'kelas_jurusan' => $validated['kelas_jurusan'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'surat_pengantar_path' => $filePath,
        ]);

        // Menyimpan nama dan email ke session untuk digunakan di form registrasi
        session(['nama' => $validated['nama_lengkap'], 'email' => $validated['email']]);

        return redirect('/pendaftaran-peserta')->with('success', 'Pendaftaran berhasil! Silahkan buat akun pada menu login dan tunggu pesan whatsapp dari admin untuk proses selanjutnya.');
    }

    public function destroy($id)
    {
        $peserta = PendaftaranPeserta::findOrFail($id);

        // Hapus file surat pengantar jika ada
        if ($peserta->surat_pengantar_path) {
            Storage::disk('public')->delete($peserta->surat_pengantar_path);
        }

        // Hapus data peserta dari database
        $peserta->delete();

        return redirect('/dashboard/pendaftaran-peserta')->with('success', 'Data berhasil dihapus.');
    }

    public function destroyAP($id)
    {
        $peserta = PendaftaranPeserta::findOrFail($id);

        // Hapus file surat pengantar jika ada
        if ($peserta->surat_pengantar_path) {
            Storage::disk('public')->delete($peserta->surat_pengantar_path);
        }

        // Hapus data peserta dari database
        $peserta->delete();

        return redirect('/dashboard/pendaftaran-peserta/admin-pendaftaran')->with('success', 'Data berhasil dihapus.');
    }

    public function storeSuratBalasan(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'lampiran' => 'required|string|max:255',
            'hal' => 'required|string|max:255',
            'alamat_surat' => 'required|string',
            'kalimat_pembuka' => 'required|string',
            'kalimat_penutup' => 'required|string',
            'nama_peserta' => 'required|exists:pendaftaran_pesertas,id',
        ]);

        // Tambahkan user_id dan pendaftaran_peserta_id ke data
        $validated['user_id'] = auth()->id();
        $validated['pendaftaran_peserta_id'] = $validated['nama_peserta'];
        unset($validated['nama_peserta']); // Tidak perlu disimpan sebagai kolom

        $suratBalasan = SuratBalasanMagang::where('pendaftaran_peserta_id', $id)->first();

        if ($suratBalasan) {
            $suratBalasan->update($validated);
            $message = 'Surat balasan berhasil diperbarui!';
        } else {
            SuratBalasanMagang::create($validated);
            $message = 'Surat balasan berhasil disimpan!';
        }

        return back()->with('success2', $message);
    }

    public function storeSuratBalasanAP(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'lampiran' => 'required|string|max:255',
            'hal' => 'required|string|max:255',
            'alamat_surat' => 'required|string',
            'kalimat_pembuka' => 'required|string',
            'kalimat_penutup' => 'required|string',
            'nama_peserta' => 'required|exists:pendaftaran_pesertas,id',
        ]);

        // Tambahkan user_id dan pendaftaran_peserta_id ke data
        $validated['user_id'] = auth()->id();
        $validated['pendaftaran_peserta_id'] = $validated['nama_peserta'];
        unset($validated['nama_peserta']); // Tidak perlu disimpan sebagai kolom

        $suratBalasan = SuratBalasanMagang::where('pendaftaran_peserta_id', $id)->first();

        if ($suratBalasan) {
            $suratBalasan->update($validated);
            $message = 'Surat balasan berhasil diperbarui!';
        } else {
            SuratBalasanMagang::create($validated);
            $message = 'Surat balasan berhasil disimpan!';
        }

        return back()->with('success2', $message);
    }

    public function print($id)
    {
        // Ambil surat balasan berdasarkan peserta
        $suratBalasan = SuratBalasanMagang::with('peserta')
            ->where('pendaftaran_peserta_id', $id)
            ->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        // Validasi jika tidak ada
        if (!$suratBalasan) {
            return redirect()->back()->with('error', 'Surat balasan untuk peserta ini tidak ditemukan.');
        }

        return view('pendaftaran.print', [
            'title' => 'Cetak Surat Balasan',
            'suratBalasan' => $suratBalasan,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printAP($id)
    {
        // Ambil surat balasan berdasarkan peserta
        $suratBalasan = SuratBalasanMagang::with('peserta')
            ->where('pendaftaran_peserta_id', $id)
            ->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        // Validasi jika tidak ada
        if (!$suratBalasan) {
            return redirect()->back()->with('error', 'Surat balasan untuk peserta ini tidak ditemukan.');
        }

        return view('pendaftaran.print-ap', [
            'title' => 'Cetak Surat Balasan',
            'suratBalasan' => $suratBalasan,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printSB(Request $request)
    {
        $query = SuratBalasanMagang::with('peserta')->where('user_id', auth()->id());

        if ($request->filled('tanggal_awal_balasan') && $request->filled('tanggal_akhir_balasan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_balasan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_balasan)->endOfDay();
                $query->whereBetween('tanggal', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        } elseif ($request->filled('tanggal')) {
            try {
                $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
                $query->whereDate('tanggal', $tanggal);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        }

        $suratBalasanList = $query->get();

        $tanggal_terkecil = $suratBalasanList->min('tanggal');
        $tanggal_terbesar = $suratBalasanList->max('tanggal');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('pendaftaran.printBalasan', [
            'title' => 'Laporan Surat Balasan',
            'suratBalasanList' => $suratBalasanList,
            'tanggal_awal_balasan' => $request->tanggal_awal_balasan,
            'tanggal_akhir_balasan' => $request->tanggal_akhir_balasan,
            'tanggal' => $request->tanggal,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printSBAP(Request $request)
    {
        $query = SuratBalasanMagang::with('peserta')->where('user_id', auth()->id());

        if ($request->filled('tanggal_awal_balasan') && $request->filled('tanggal_akhir_balasan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_balasan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_balasan)->endOfDay();
                $query->whereBetween('tanggal', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        } elseif ($request->filled('tanggal')) {
            try {
                $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
                $query->whereDate('tanggal', $tanggal);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        }

        $suratBalasanList = $query->get();

        $tanggal_terkecil = $suratBalasanList->min('tanggal');
        $tanggal_terbesar = $suratBalasanList->max('tanggal');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('pendaftaran.printBalasan-ap', [
            'title' => 'Laporan Surat Balasan',
            'suratBalasanList' => $suratBalasanList,
            'tanggal_awal_balasan' => $request->tanggal_awal_balasan,
            'tanggal_akhir_balasan' => $request->tanggal_akhir_balasan,
            'tanggal' => $request->tanggal,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }

    public function printPM(Request $request)
    {
        $query = PendaftaranPeserta::query();

        // Filter berdasarkan tanggal mendaftar (created_at), BUKAN tanggal_disetujui
        if ($request->filled('tanggal_awal_persetujuan') && $request->filled('tanggal_akhir_persetujuan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_persetujuan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_persetujuan)->endOfDay();
                $query->whereBetween('created_at', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        }

        // Hanya ambil yang sudah disetujui saja
        $pesertaList = $query->whereNotNull('tanggal_disetujui')->get();

        // Perhitungan periode berdasarkan tanggal mendaftar (created_at)
        $tanggal_terkecil = $pesertaList->min('created_at');
        $tanggal_terbesar = $pesertaList->max('created_at');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');

        return view('pendaftaran.printPersetujuan', [
            'title' => 'Laporan Persetujuan Magang',
            'pesertaList' => $pesertaList,
            'tanggal_awal_persetujuan' => $request->tanggal_awal_persetujuan,
            'tanggal_akhir_persetujuan' => $request->tanggal_akhir_persetujuan,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
        ]);
    }

    public function printPMAP(Request $request)
    {
        $query = PendaftaranPeserta::query();

        // Filter berdasarkan tanggal mendaftar (created_at), BUKAN tanggal_disetujui
        if ($request->filled('tanggal_awal_persetujuan') && $request->filled('tanggal_akhir_persetujuan')) {
            try {
                $awal = Carbon::parse($request->tanggal_awal_persetujuan)->startOfDay();
                $akhir = Carbon::parse($request->tanggal_akhir_persetujuan)->endOfDay();
                $query->whereBetween('created_at', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Opsional: log error
            }
        }

        // Hanya ambil yang sudah disetujui saja
        $pesertaList = $query->whereNotNull('tanggal_disetujui')->get();

        // Perhitungan periode berdasarkan tanggal mendaftar (created_at)
        $tanggal_terkecil = $pesertaList->min('created_at');
        $tanggal_terbesar = $pesertaList->max('created_at');

        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');

        return view('pendaftaran.printPersetujuan-ap', [
            'title' => 'Laporan Persetujuan Magang',
            'pesertaList' => $pesertaList,
            'tanggal_awal_persetujuan' => $request->tanggal_awal_persetujuan,
            'tanggal_akhir_persetujuan' => $request->tanggal_akhir_persetujuan,
            'tanggal_terkecil' => $tanggal_terkecil,
            'tanggal_terbesar' => $tanggal_terbesar,
            'kepalaBalai' => $kepalaBalai,
        ]);
    }
}
