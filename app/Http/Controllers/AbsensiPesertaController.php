<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPeserta;
use App\Models\DetailMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsensiPesertaController extends Controller
{
    public function index()
    {
        $absensi = AbsensiPeserta::where('user_id', Auth::id())->get();
        return view('dashboard.absensi.index', [
            'title' => 'Absensi Peserta',
            'absensi' => $absensi,
            'user_id' => Auth::id()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Sakit,Izin',
            'alasan' => 'required_if:status,Sakit,Izin',
            'bukti' => 'required_if:status,Sakit,Izin|image|max:512'
        ]);

        // Pastikan tanggal absen adalah hari ini
        if ($request->hari_tanggal !== now()->toDateString()) {
            return redirect()->back()->with('error', 'Anda hanya dapat melakukan absen pada tanggal hari ini.');
        }

        // Periksa apakah user sudah absen masuk untuk hari ini
        $absensiHariIni = AbsensiPeserta::where('user_id', Auth::id())
            ->where('hari_tanggal', $request->hari_tanggal)
            ->first();

        if (!$absensiHariIni) {
            // Jika belum ada, buat data absensi baru
            $waktuMasuk = now()->format('H:i:s');
            $keterangan = ($request->status === 'Hadir' && $waktuMasuk > '08:00:00') ? 'Terlambat' : null;

            // Simpan bukti jika ada
            $buktiPath = null;
            if ($request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('bukti_absensi', 'public');
            }

            AbsensiPeserta::create([
                'user_id' => Auth::id(),
                'hari_tanggal' => $request->hari_tanggal,
                'waktu_masuk' => $waktuMasuk,
                'status' => $request->status,
                'alasan' => $request->alasan ?? null,
                'bukti' => $buktiPath,
                'keterangan' => $keterangan
            ]);

            return redirect()->back()->with('success', 'Absen masuk berhasil!');
        } else {
            return redirect()->back()->with('error', 'Anda sudah absen masuk hari ini.');
        }
    }

    public function storeAdmin(Request $request, $user_id)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Sakit,Izin',
            'alasan' => 'required_if:status,Sakit,Izin',
            'bukti' => 'required_if:status,Sakit,Izin|image|max:512'
        ]);

        // Periksa apakah user sudah absen masuk untuk hari ini berdasarkan user_id
        $absensiHariIni = AbsensiPeserta::where('user_id', $user_id)
            ->where('hari_tanggal', $request->hari_tanggal)
            ->first();

        if (!$absensiHariIni) {
            // Jika belum ada, buat data absensi baru
            $waktuMasuk = now()->format('H:i:s');

            // Simpan bukti jika ada
            $buktiPath = null;
            if ($request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('bukti_absensi', 'public');
            }

            $adminId = auth()->user()->id;

            // Simpan data absensi untuk user yang dipilih
            AbsensiPeserta::create([
                'user_id' => $user_id, // Gunakan user_id yang diteruskan
                'hari_tanggal' => $request->hari_tanggal,
                'waktu_masuk' => $waktuMasuk,
                'status' => $request->status,
                'alasan' => $request->alasan ?? null,
                'bukti' => $buktiPath,
                'keterangan' => null,
                'edited_by' => $adminId,
            ]);

            return redirect()->back()->with('success', 'Absen masuk peserta berhasil!');
        } else {
            return redirect()->back()->with('error', 'Data absensi sudah ada untuk hari ini!');
        }
    }

    public function absenKeluar()
    {
        $absensiHariIni = AbsensiPeserta::where('user_id', Auth::id())
            ->where('hari_tanggal', now()->format('Y-m-d'))
            ->first();

        // Validasi: Jika belum absen masuk
        if (!$absensiHariIni) {
            return redirect()->back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
        }

        // Validasi: Jika sudah absen keluar
        if ($absensiHariIni->waktu_keluar) {
            return redirect()->back()->with('error', 'Anda sudah absen keluar hari ini.');
        }

        // Validasi: Jika status adalah Alpha, Izin, atau Sakit
        if (in_array($absensiHariIni->status, ['Izin', 'Sakit'])) {
            return redirect()->back()->with('error', 'Anda tidak dapat absen keluar untuk status ini.');
        }

        // Proses absen keluar
        $absensiHariIni->update([
            'waktu_keluar' => now()->format('H:i:s')
        ]);

        return redirect()->back()->with('success', 'Absen keluar berhasil!');
    }

    public function absenkeluarAdmin($user_id)
    {
        $absensiHariIni = AbsensiPeserta::where('user_id', $user_id)
            ->where('hari_tanggal', now()->format('Y-m-d'))
            ->first();

        // Validasi: Jika belum absen masuk
        if (!$absensiHariIni) {
            return redirect()->back()->with('error', 'Peserta belum melakukan absen masuk hari ini.');
        }

        // Validasi: Jika sudah absen keluar
        if ($absensiHariIni->waktu_keluar) {
            return redirect()->back()->with('error', 'Peserta sudah absen keluar hari ini.');
        }

        // Validasi: Jika status adalah Alpha, Izin, atau Sakit
        if (in_array($absensiHariIni->status, ['Izin', 'Sakit'])) {
            return redirect()->back()->with('error', 'Peserta tidak dapat absen keluar untuk status ini.');
        }

        // Proses absen keluar
        $absensiHariIni->update([
            'waktu_keluar' => now()->format('H:i:s')
        ]);

        return redirect()->back()->with('success', 'Absen keluar peserta berhasil!');
    }

    public function indexAdmin($user_id)
    {
        // Ambil data kegiatan magang berdasarkan relasi atau tabel yang relevan
        $absensiPeserta = AbsensiPeserta::where('user_id', $user_id)->get();

        // Kirimkan data ke view
        return view('dashboard.absensi.index-admin', [
            'title' => 'Kegiatan Harian Peserta',
            'absensiPeserta' => $absensiPeserta,
            'user_id' => $user_id,
        ]);
    }

    public function indexAdminPL($user_id)
    {
        // Ambil data kegiatan magang berdasarkan relasi atau tabel yang relevan
        $absensiPeserta = AbsensiPeserta::where('user_id', $user_id)->get();

        // Kirimkan data ke view
        return view('dashboard.absensi.index-admin-pl', [
            'title' => 'Kegiatan Harian Peserta',
            'absensiPeserta' => $absensiPeserta,
            'user_id' => $user_id,
        ]);
    }

    public function editAdmin($id)
    {
        // Cari data absensi berdasarkan ID
        $absensi = AbsensiPeserta::findOrFail($id);

        // Kembalikan ke view edit dengan data absensi
        return view('dashboard.absensi.edit', [
            'title' => 'Edit Data Absensi',
            'absensi' => $absensi
        ]);
    }

    public function editAdminPL($id)
    {
        // Cari data absensi berdasarkan ID
        $absensi = AbsensiPeserta::findOrFail($id);

        // Kembalikan ke view edit dengan data absensi
        return view('dashboard.absensi.edit-pl', [
            'title' => 'Edit Data Absensi',
            'absensi' => $absensi
        ]);
    }

    public function updateAdmin(Request $request, $id)
    {
        $validated = $request->validate([
            'hari_tanggal' => 'required|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
            'alasan' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        $absensi = AbsensiPeserta::findOrFail($id);
        $absensi->hari_tanggal = $validated['hari_tanggal'];
        $absensi->status = $validated['status'];
        $absensi->keterangan = $validated['keterangan'];
        $absensi->alasan = $validated['alasan'];

        $adminId = auth()->user()->id;
        $absensi->edited_by = $adminId;

        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($absensi->bukti) {
                Storage::delete('public/' . $absensi->bukti);
            }

            $path = $request->file('bukti')->store('bukti_absensi', 'public');
            $absensi->bukti = $path;
        }

        $absensi->save();

        return redirect('/dashboard/absensi-admin/' . $absensi->user_id)->with('success', 'Data Absensi Peserta berhasil diperbarui.');
    }

    public function updateAdminPL(Request $request, $id)
    {
        $validated = $request->validate([
            'hari_tanggal' => 'required|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
            'alasan' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        $absensi = AbsensiPeserta::findOrFail($id);
        $absensi->hari_tanggal = $validated['hari_tanggal'];
        $absensi->status = $validated['status'];
        $absensi->keterangan = $validated['keterangan'];
        $absensi->alasan = $validated['alasan'];

        $adminId = auth()->user()->id;
        $absensi->edited_by = $adminId;

        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($absensi->bukti) {
                Storage::delete('public/' . $absensi->bukti);
            }

            $path = $request->file('bukti')->store('bukti_absensi', 'public');
            $absensi->bukti = $path;
        }

        $absensi->save();

        return redirect('/dashboard/absensi-pembimbing/' . $absensi->user_id)->with('success', 'Data Absensi Peserta berhasil diperbarui.');
    }

    public function destroyAdmin($id)
    {
        $absen = AbsensiPeserta::findOrFail($id);
        if ($absen->bukti) {
            Storage::disk('public')->delete($absen->bukti);
        }
        $absen->delete();

        return redirect()->back()->with('success', 'Data Absensi Peserta berhasil dihapus.');
    }

    public function deletebuktiAdmin($id)
    {
        // Ambil data kegiatan berdasarkan ID
        $absen = AbsensiPeserta::findOrFail($id);

        // Pastikan profil ada dan memiliki foto
        if ($absen && $absen->bukti) {
            $filePath = $absen->bukti;

            // Hapus file dari storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Set kolom bukti di database ke null
            $absen->bukti = null;
            $absen->save();

            // Redirect dengan pesan sukses
            return redirect('/dashboard/absensi-admin/' . $absen->user_id)->with('success', 'Bukti berhasil dihapus.');
        }

        // Redirect dengan pesan error jika foto tidak ditemukan
        return redirect('/dashboard/absensi-admin/' . $absen->user_id)->with('error', 'Bukti tidak ditemukan.');
    }

    public function deletebuktiAdminPL($id)
    {
        // Ambil data kegiatan berdasarkan ID
        $absen = AbsensiPeserta::findOrFail($id);

        // Pastikan profil ada dan memiliki foto
        if ($absen && $absen->bukti) {
            $filePath = $absen->bukti;

            // Hapus file dari storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Set kolom bukti di database ke null
            $absen->bukti = null;
            $absen->save();

            // Redirect dengan pesan sukses
            return redirect('/dashboard/absensi-pembimbing/' . $absen->user_id)->with('success', 'Bukti berhasil dihapus.');
        }

        // Redirect dengan pesan error jika foto tidak ditemukan
        return redirect('/dashboard/absensi-pembimbing/' . $absen->user_id)->with('error', 'Bukti tidak ditemukan.');
    }

    public function printAbsensi($user_id)
    {
        // Ambil data absensi peserta
        $absensiPeserta = AbsensiPeserta::where('user_id', $user_id)->get();

        // Ambil detail magang peserta
        $detailMagang = DetailMagang::where('user_id', $user_id)->first();

        // Kirim data ke view cetak
        return view('dashboard.absensi.print', [
            'title' => 'Cetak Data Absensi',
            'absensiPeserta' => $absensiPeserta,
            'detailMagang' => $detailMagang, // Kirim detail magang
            'tanggalHariIni' => now()->translatedFormat('l, d F Y'),
        ]);
    }
}
