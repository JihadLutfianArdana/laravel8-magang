<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailMagang;
use App\Models\JadwalMagang;
use App\Models\Ruangan;
use Carbon\Carbon;

class JadwalMagangController extends Controller
{
    public function index()
    {
        $jadwal = JadwalMagang::all();
        $details = DetailMagang::all();
        $ruangans = Ruangan::all();
        return view('dashboard.jadwal.admin', [
            'title' => 'Jadwal Peserta',
            'jadwal' => $jadwal,
            'details' => $details,
            'ruangans' => $ruangans,
        ]);
    }

    public function indexPL()
    {
        $jadwal = JadwalMagang::all();
        $details = DetailMagang::all();
        $ruangans = Ruangan::all();
        return view('dashboard.jadwal.admin-pl', [
            'title' => 'Jadwal Peserta',
            'jadwal' => $jadwal,
            'details' => $details,
            'ruangans' => $ruangans,
        ]);
    }

    public function create()
    {
        $details = DetailMagang::all(); // Mengambil semua data dari DetailMagang
        $ruangans = Ruangan::all();

        return view('dashboard.jadwal.create', [
            'title' => 'Buat Jadwal Peserta',
            'details' => $details,
            'ruangans' => $ruangans,
        ]);
    }

    public function createPL()
    {
        $details = DetailMagang::all(); // Mengambil semua data dari DetailMagang
        $ruangans = Ruangan::all();

        return view('dashboard.jadwal.create-pl', [
            'title' => 'Buat Jadwal Peserta',
            'details' => $details,
            'ruangans' => $ruangans,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nism' => 'required',
            'nama_peserta' => 'required',
            'ruangan_id' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Format tanggal sebelum menyimpan ke database
        Carbon::createFromFormat('Y-m-d', $request->tanggal_awal)->format('d-m-Y');
        Carbon::createFromFormat('Y-m-d', $request->tanggal_akhir)->format('d-m-Y');

        // Ambil detail magang berdasarkan nism yang dipilih
        $detailMagang = DetailMagang::find($request->nism);

        // Menyimpan jadwal magang, menambahkan user_id untuk mencatat admin yang membuatnya
        JadwalMagang::create([
            'detail_magang_id' => $detailMagang->id,
            'user_id' => auth()->id(), // ID admin yang sedang login
            'ruangan_id' => $request->ruangan_id,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect('/dashboard/jadwal-peserta')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function storePL(Request $request)
    {
        $request->validate([
            'nism' => 'required',
            'nama_peserta' => 'required',
            'ruangan_id' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Format tanggal sebelum menyimpan ke database
        Carbon::createFromFormat('Y-m-d', $request->tanggal_awal)->format('d-m-Y');
        Carbon::createFromFormat('Y-m-d', $request->tanggal_akhir)->format('d-m-Y');

        // Ambil detail magang berdasarkan nism yang dipilih
        $detailMagang = DetailMagang::find($request->nism);

        // Menyimpan jadwal magang, menambahkan user_id untuk mencatat admin yang membuatnya
        JadwalMagang::create([
            'detail_magang_id' => $detailMagang->id,
            'user_id' => auth()->id(), // ID admin yang sedang login
            'ruangan_id' => $request->ruangan_id,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect('/dashboard/jadwal-peserta/pembimbing-lapangan')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil jadwal berdasarkan ID
        $jadwal = JadwalMagang::find($id);

        // Ambil semua data detail magang dan ruangans untuk dropdown
        $details = DetailMagang::all();
        $ruangans = Ruangan::all();

        // Pastikan data yang terkait dengan ruangan sudah disertakan, seperti nama ruangan dan kepala ruangan
        $ruangan = $jadwal->ruangan;

        // Kirim data ke view untuk diedit
        return view('dashboard.jadwal.edit', [
            'title' => 'Edit Jadwal Peserta',
            'jadwal' => $jadwal, // Data jadwal yang sedang diedit
            'details' => $details, // Data untuk dropdown NIS/NIM
            'ruangans' => $ruangans, // Data ruangans untuk dropdown nama ruangan
            // 'selected_ruangan' => $ruangan, // Data ruangan yang dipilih pada jadwal
        ]);
    }

    public function editPL($id)
    {
        // Ambil jadwal berdasarkan ID
        $jadwal = JadwalMagang::find($id);

        // Ambil semua data detail magang dan ruangans untuk dropdown
        $details = DetailMagang::all();
        $ruangans = Ruangan::all();

        // Pastikan data yang terkait dengan ruangan sudah disertakan, seperti nama ruangan dan kepala ruangan
        $ruangan = $jadwal->ruangan;

        // Kirim data ke view untuk diedit
        return view('dashboard.jadwal.edit-pl', [
            'title' => 'Edit Jadwal Peserta',
            'jadwal' => $jadwal, // Data jadwal yang sedang diedit
            'details' => $details, // Data untuk dropdown NIS/NIM
            'ruangans' => $ruangans, // Data ruangans untuk dropdown nama ruangan
            // 'selected_ruangan' => $ruangan, // Data ruangan yang dipilih pada jadwal
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nism' => 'required',
            'nama_peserta' => 'required',
            'ruangan_id' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $jadwal = JadwalMagang::find($id);
        $detailMagang = DetailMagang::find($request->nism);

        // Update jadwal magang
        $jadwal->update([
            'detail_magang_id' => $detailMagang->id,
            'user_id' => auth()->id(),
            'ruangan_id' => $request->ruangan_id,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect('/dashboard/jadwal-peserta')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function updatePL(Request $request, $id)
    {
        $request->validate([
            'nism' => 'required',
            'nama_peserta' => 'required',
            'ruangan_id' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $jadwal = JadwalMagang::find($id);
        $detailMagang = DetailMagang::find($request->nism);

        // Update jadwal magang
        $jadwal->update([
            'detail_magang_id' => $detailMagang->id,
            'user_id' => auth()->id(),
            'ruangan_id' => $request->ruangan_id,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect('/dashboard/jadwal-peserta/pembimbing-lapangan')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Temukan jadwal berdasarkan id
        $jadwal = JadwalMagang::findOrFail($id);

        // Hapus jadwal tersebut
        $jadwal->delete();

        // Redirect kembali ke halaman jadwal dengan pesan sukses
        return redirect('/dashboard/jadwal-peserta')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function destroyPL($id)
    {
        // Temukan jadwal berdasarkan id
        $jadwal = JadwalMagang::findOrFail($id);

        // Hapus jadwal tersebut
        $jadwal->delete();

        // Redirect kembali ke halaman jadwal dengan pesan sukses
        return redirect('/dashboard/jadwal-peserta/pembimbing-lapangan')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function show()
    {
        // Ambil jadwal magang yang sudah dibuat admin
        $jadwal = JadwalMagang::all();
        $ruangans = Ruangan::all();

        return view('dashboard.jadwal.peserta', [
            'title' => 'Jadwal Peserta',
            'jadwal' => $jadwal,
            'ruangans' => $ruangans,
        ]);
    }

    public function printPeserta()
    {
        $jadwal = JadwalMagang::all();
        $ruangans = Ruangan::all();
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.jadwal.print-peserta', [
            'title' => 'Jadwal Peserta Magang',
            'jadwal' => $jadwal,
            'ruangans' => $ruangans,
            'detail' => $detail,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan,
        ]);
    }
}
