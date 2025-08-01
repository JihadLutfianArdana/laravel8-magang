<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('dashboard.ruangan.index', [
            'title' => 'Data Ruangan',
            'ruangans' => $ruangans
        ]);
    }

    public function indexAP()
    {
        $ruangans = Ruangan::all();
        return view('dashboard.ruangan.index-ap', [
            'title' => 'Data Ruangan',
            'ruangans' => $ruangans
        ]);
    }

    public function indexPL()
    {
        $ruangans = Ruangan::all();
        return view('dashboard.ruangan.index-pl', [
            'title' => 'Data Ruangan',
            'ruangans' => $ruangans
        ]);
    }

    public function create()
    {
        return view('dashboard.ruangan.create', [
            'title' => 'Tambah Data Ruangan'
        ]);
    }

    public function createAP()
    {
        return view('dashboard.ruangan.create-ap', [
            'title' => 'Tambah Data Ruangan'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nip' => 'required|unique:ruangans,nip|min:3|max:20',
            'nama_pegawai' => 'required|max:50',
            'jabatan' => 'required|not_in:-|in:KADIS Bapelkes,KASI Penyelenggara Pelatihan,KASI Pengendalian Mutu,KASI Tata Usaha,KASI Tata Usaha (Perencanaan),KASI Tata Usaha (Bendahara Barang),Staff',
            'nama_ruangan' => 'required|not_in:-|in:Ruang Kepala Bapelkes,Ruang Seksi Penyelenggara Pelatihan,Ruang Seksi Pengendalian Mutu,Ruang TU,Ruang TU Perencanaan,Ruang TU Bendahara Barang',
            'peran_khusus' => 'required|in:-,Pembimbing Lapangan',
        ]);

        // Membuat data baru ke dalam tabel 'ruangans'
        Ruangan::create($validated);

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect('/dashboard/data-ruangan')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    public function storeAP(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nip' => 'required|unique:ruangans,nip|min:3|max:20',
            'nama_pegawai' => 'required|max:50',
            'jabatan' => 'required|not_in:-|in:KADIS Bapelkes,KASI Penyelenggara Pelatihan,KASI Pengendalian Mutu,KASI Tata Usaha,KASI Tata Usaha (Perencanaan),KASI Tata Usaha (Bendahara Barang),Staff',
            'nama_ruangan' => 'required|not_in:-|in:Ruang Kepala Bapelkes,Ruang Seksi Penyelenggara Pelatihan,Ruang Seksi Pengendalian Mutu,Ruang TU,Ruang TU Perencanaan,Ruang TU Bendahara Barang',
            'peran_khusus' => 'required|in:-,Pembimbing Lapangan',
        ]);

        // Membuat data baru ke dalam tabel 'ruangans'
        Ruangan::create($validated);

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    public function edit($nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan')->with('error', 'Data ruangan tidak ditemukan!');
        }

        return view('dashboard.ruangan.edit', [
            'title' => 'Edit Data Ruangan',
            'ruangan' => $ruangan
        ]);
    }

    public function editAP($nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('error', 'Data ruangan tidak ditemukan!');
        }

        return view('dashboard.ruangan.edit-ap', [
            'title' => 'Edit Data Ruangan',
            'ruangan' => $ruangan
        ]);
    }

    public function update(Request $request, $nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan')->with('error', 'Data ruangan tidak ditemukan!');
        }

        // Validasi input
        $validated = $request->validate([
            'nip' => 'required|min:3|max:20|unique:ruangans,nip,' . $ruangan->id,
            'nama_pegawai' => 'required|max:50',
            'jabatan' => 'required|not_in:-|in:KADIS Bapelkes,KASI Penyelenggara Pelatihan,KASI Pengendalian Mutu,KASI Tata Usaha,KASI Tata Usaha (Perencanaan),KASI Tata Usaha (Bendahara Barang),Staff',
            'nama_ruangan' => 'required|not_in:-|in:Ruang Kepala Bapelkes,Ruang Seksi Penyelenggara Pelatihan,Ruang Seksi Pengendalian Mutu,Ruang TU,Ruang TU Perencanaan,Ruang TU Bendahara Barang',
            'peran_khusus' => 'required|in:-,Pembimbing Lapangan',
        ]);

        // Update data ruangan
        $ruangan->update($validated);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/data-ruangan')->with('success', 'Data ruangan berhasil diperbarui!');
    }

    public function updateAP(Request $request, $nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('error', 'Data ruangan tidak ditemukan!');
        }

        // Validasi input
        $validated = $request->validate([
            'nip' => 'required|min:3|max:20|unique:ruangans,nip,' . $ruangan->id,
            'nama_pegawai' => 'required|max:50',
            'jabatan' => 'required|not_in:-|in:KADIS Bapelkes,KASI Penyelenggara Pelatihan,KASI Pengendalian Mutu,KASI Tata Usaha,KASI Tata Usaha (Perencanaan),KASI Tata Usaha (Bendahara Barang),Staff',
            'nama_ruangan' => 'required|not_in:-|in:Ruang Kepala Bapelkes,Ruang Seksi Penyelenggara Pelatihan,Ruang Seksi Pengendalian Mutu,Ruang TU,Ruang TU Perencanaan,Ruang TU Bendahara Barang',
            'peran_khusus' => 'required|in:-,Pembimbing Lapangan',
        ]);

        // Update data ruangan
        $ruangan->update($validated);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('success', 'Data ruangan berhasil diperbarui!');
    }

    public function destroy($nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan')->with('error', 'Data ruangan tidak ditemukan!');
        }

        // Menghapus data
        $ruangan->delete();

        // Redirect dengan pesan sukses
        return redirect('/dashboard/data-ruangan')->with('success', 'Data ruangan berhasil dihapus!');
    }

    public function destroyAP($nip)
    {
        // Mencari data berdasarkan nip
        $ruangan = Ruangan::where('nip', $nip)->first();

        // Pastikan data ditemukan
        if (!$ruangan) {
            return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('error', 'Data ruangan tidak ditemukan!');
        }

        // Menghapus data
        $ruangan->delete();

        // Redirect dengan pesan sukses
        return redirect('/dashboard/data-ruangan/admin-pendaftaran')->with('success', 'Data ruangan berhasil dihapus!');
    }
}
