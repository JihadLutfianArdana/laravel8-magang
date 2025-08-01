<?php

namespace App\Http\Controllers;

use App\Models\DetailMagang;
use App\Models\ProfilePeserta;
use App\Models\LaporanGrafik;
use App\Models\Ruangan;
use App\Models\PendaftaranPeserta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailMagangController extends Controller
{
    // Menampilkan data detail magang
    public function index()
    {
        // Ambil data dari tabel detail_magangs berdasarkan user yang login
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        // Tampilkan halaman dengan data yang sudah ada
        return view('dashboard.detail.index', [
            'title' => 'Detail Magang',
            'detail' => $detail, // Mengirim data ke view
        ]);
    }

    public function edit()
    {
        // Mendapatkan data detail magang berdasarkan user yang sedang login
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        // Mengambil daftar NISM berdasarkan user yang sedang login
        $nismList = ProfilePeserta::where('user_id', auth()->id())->pluck('nism', 'nism');

        // Mendapatkan data pendaftaran peserta berdasarkan email user yang sedang login
        $pendaftaran = PendaftaranPeserta::where('email', Auth::user()->email)->first();

        // Menambahkan query untuk mencari pembimbing lapangan berdasarkan peran_khusus
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->first();

        // Kirim data ke view
        return view('dashboard.detail.create', [
            'title' => 'Buat / Edit Detail Magang',
            'pendaftaran' => $pendaftaran,   // Mengirim data pendaftaran peserta
            'detail' => $detail,             // Mengirim data detail magang
            'nismList' => $nismList,         // Mengirim daftar NISM ke view
            'pembimbingLapangan' => $pembimbingLapangan, // Mengirim data pembimbing lapangan ke view
        ]);
    }

    // Update atau simpan data detail magang
    public function update(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nism' => 'required|string|max:255',
            'kelas_jurusan' => 'required|string|max:255',
            'nama_pembimbing' => 'required|string|max:255',
            'jumlah_anggota' => 'required|integer',
            'status' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        // Ambil NISM berdasarkan user yang sedang login
        $nismList = ProfilePeserta::where('user_id', auth()->id())->pluck('nism', 'nism');

        // Cek keberadaan NISM di tabel ProfilePeserta
        $profilePeserta = ProfilePeserta::where('nism', $request->nism)->first();
        if ($profilePeserta) {
            $validatedData['nama_peserta'] = $profilePeserta->nama_peserta;
            $validatedData['asal_sekolah_universitas'] = $profilePeserta->asal_sekolah_universitas;
        } else {
            return redirect()->back()->withErrors(['nism' => 'NISM tidak ditemukan di Profile Peserta']);
        }

        // Tambahkan user_id untuk mengaitkan data dengan user yang login
        $validatedData['user_id'] = auth()->id();

        // Mendapatkan data detail magang berdasarkan user yang login
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        // Tentukan apakah ini adalah penyimpanan pertama kali atau update
        $isNewDetail = !$detail;

        // Simpan atau perbarui data detail magang
        if ($isNewDetail) {
            DetailMagang::create($validatedData);
        } else {
            $detail->update($validatedData);
        }

        // =====================
        // Simpan ke laporan_grafik
        // =====================
        $asal = $profilePeserta->asal_sekolah_universitas;
        $tanggalMulai = $request->tanggal_mulai;

        // Cek apakah data sudah ada untuk asal_sekolah_universitas dan tanggal_mulai yang sama
        $laporan = LaporanGrafik::where('asal_sekolah_universitas', $asal)
            ->where('tanggal_mulai', $tanggalMulai)
            ->first();

        if ($laporan) {
            // Jika sudah ada, tambah jumlahnya
            $laporan->increment('jumlah');
        } else {
            // Jika belum ada, buat baru
            LaporanGrafik::create([
                'asal_sekolah_universitas' => $asal,
                'jumlah' => 1,
                'tanggal_mulai' => $tanggalMulai,
            ]);
        }

        // =====================

        // Tampilkan pesan sukses sesuai kondisi
        $message = $isNewDetail ? 'Data berhasil disimpan!' : 'Data berhasil diperbarui!';

        return redirect('/dashboard/detail')->with('success', $message);
    }

    public function show($id)
    {
        // Mengambil data detail magang untuk pengguna
        $detail = DetailMagang::where('user_id', $id)->first();

        return view('dashboard.detail.show', [
            'title' => 'Detail Magang Peserta',
            'detail' => $detail
        ]);
    }

    public function showPL($id)
    {
        // Mengambil data detail magang untuk pengguna
        $detail = DetailMagang::where('user_id', $id)->first();

        return view('dashboard.detail.show-pl', [
            'title' => 'Detail Magang Peserta',
            'detail' => $detail
        ]);
    }
}
