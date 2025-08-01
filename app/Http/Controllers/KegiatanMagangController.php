<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanMagang;
use App\Models\User;
use App\Models\DetailMagang;
use Illuminate\Support\Facades\Storage;


class KegiatanMagangController extends Controller
{
    public function index()
    {
        // Menampilkan kegiatan magang hanya untuk user yang sedang login
        $kegiatan = KegiatanMagang::where('user_id', auth()->id())->get();

        return view('dashboard.main-activity.index', [
            'title' => 'Kegiatan Harian',
            'kegiatan' => $kegiatan
        ]);
    }

    public function indexMain()
    {
        // Mengambil semua pengguna yang bukan admin dan memuat relasi dengan DetailMagang
        $users = User::where('is_admin', 0)
            ->with('detailMagang') // Memuat relasi DetailMagang
            ->get();

        return view('dashboard.main-activity.index-main', [
            'title' => 'Kegiatan Peserta',
            'users' => $users
        ]);
    }

    public function indexMainPL()
    {
        // Mengambil semua pengguna yang bukan admin dan memuat relasi dengan DetailMagang
        $users = User::where('is_admin', 0)
            ->with('detailMagang') // Memuat relasi DetailMagang
            ->get();

        return view('dashboard.main-activity.index-main-pl', [
            'title' => 'Kegiatan Peserta',
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('dashboard.main-activity.create', [
            'title' => 'Tambah Data Kegiatan'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_kegiatan' => 'required|string',
            'lokasi_kegiatan' => 'required|string|max:255',
            'dok_kegiatan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // Validasi file
        ]);

        // Jika ada file dokumen, simpan di storage dan ambil path-nya
        $dok_kegiatan = null;
        if ($request->hasFile('dok_kegiatan')) {
            $dok_kegiatan = $request->file('dok_kegiatan')->store('dokumen-kegiatan', 'public');
        }

        // Menyimpan data kegiatan magang ke dalam database
        KegiatanMagang::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'],
            'deskripsi_kegiatan' => $validated['deskripsi_kegiatan'],
            'lokasi_kegiatan' => $validated['lokasi_kegiatan'],
            'dok_kegiatan' => $dok_kegiatan, // Simpan path file dokumen jika ada
            'user_id' => auth()->id(), // Menyimpan user_id yang sedang login
            'detail_magang_id' => $request->detail_magang_id,
        ]);

        // Redirect kembali ke halaman kegiatan dengan pesan sukses
        return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan berhasil disimpan!');
    }

    public function edit($id)
    {
        // Ambil data kegiatan berdasarkan ID
        if (auth()->user()->is_admin) {
            $kegiatan = KegiatanMagang::findOrFail($id);
        } else {
            $kegiatan = KegiatanMagang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        }

        return view('dashboard.main-activity.edit', [
            'title' => 'Edit Data Kegiatan',
            'kegiatan' => $kegiatan,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_kegiatan' => 'required|string',
            'lokasi_kegiatan' => 'required|string|max:255',
            'dok_kegiatan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024', // Validasi file
        ]);

        // Ambil data kegiatan yang akan diupdate
        $kegiatan = KegiatanMagang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Jika ada file baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('dok_kegiatan')) {
            if ($kegiatan->dok_kegiatan) {
                Storage::disk('public')->delete($kegiatan->dok_kegiatan);
            }
            $validated['dok_kegiatan'] = $request->file('dok_kegiatan')->store('dokumen-kegiatan', 'public');
        }

        $kegiatan->update(array_merge($validated, [
            'status_revisi' => 'Sudah diubah', // Update status revisi
        ]));

        // Redirect kembali ke halaman kegiatan dengan pesan sukses
        return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Ambil data kegiatan berdasarkan ID yang sesuai dengan user yang login
        $kegiatan = KegiatanMagang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Cek apakah ada file dokumentasi yang terhubung dengan kegiatan ini
        if ($kegiatan->dok_kegiatan) {
            // Hapus file dokumentasi dari penyimpanan public
            Storage::disk('public')->delete($kegiatan->dok_kegiatan);
        }

        // Hapus data kegiatan dari database
        $kegiatan->delete();

        // Redirect ke halaman kegiatan dengan pesan sukses
        return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan berhasil dihapus!');
    }

    public function print()
    {
        // Ambil data kegiatan magang yang terkait dengan user yang sedang login
        $kegiatan = KegiatanMagang::where('user_id', auth()->id())->get();

        // Ambil data detail peserta magang
        $detail = DetailMagang::where('user_id', auth()->id())->first();

        // Pastikan detail peserta ditemukan, jika tidak bisa di-handle
        if (!$detail) {
            return redirect()->back()->with('error', 'Detail peserta magang tidak ditemukan.');
        }

        // Kirim data kegiatan dan detail peserta ke view
        return view('dashboard.main-activity.print', [
            'title' => 'Print Data Kegiatan',
            'kegiatan' => $kegiatan,
            'detail' => $detail, // Kirim detail peserta ke view
            'tanggalHariIni' => now()->translatedFormat('l, d F Y'),
        ]);
    }

    public function printAdmin($user_id)
    {
        // Ambil data kegiatan magang yang terkait dengan user yang sedang login
        $kegiatan = KegiatanMagang::where('user_id', $user_id)->get();

        // Ambil data detail peserta magang
        $detail = DetailMagang::where('user_id', $user_id)->first();

        // Pastikan detail peserta ditemukan, jika tidak bisa di-handle
        if (!$detail) {
            return redirect()->back()->with('error', 'Detail peserta magang tidak ditemukan.');
        }

        // Kirim data kegiatan dan detail peserta ke view
        return view('dashboard.main-activity.print', [
            'title' => 'Print Data Kegiatan',
            'kegiatan' => $kegiatan,
            'detail' => $detail, // Kirim detail peserta ke view
            'tanggalHariIni' => now()->translatedFormat('l, d F Y'),
        ]);
    }

    public function indexKegiatan($user_id)
    {
        // Ambil data kegiatan magang beserta nama user dan nism dari DetailMagang
        $kegiatanMagang = KegiatanMagang::with(['user', 'detailMagang']) // Memuat relasi user dan detailMagang
            ->where('user_id', $user_id)
            ->get();

        // Ambil data user
        $user = User::findOrFail($user_id);

        // Kirimkan data ke view
        return view('dashboard.main-activity.index-kegiatan', [
            'title' => 'Kegiatan Harian Peserta',
            'kegiatanMagang' => $kegiatanMagang,
            'user' => $user,
        ]);
    }

    public function indexKegiatanPL($user_id)
    {
        // Ambil data kegiatan magang beserta nama user dan nism dari DetailMagang
        $kegiatanMagang = KegiatanMagang::with(['user', 'detailMagang']) // Memuat relasi user dan detailMagang
            ->where('user_id', $user_id)
            ->get();

        // Ambil data user
        $user = User::findOrFail($user_id);

        // Kirimkan data ke view
        return view('dashboard.main-activity.index-kegiatan-pl', [
            'title' => 'Kegiatan Harian Peserta',
            'kegiatanMagang' => $kegiatanMagang,
            'user' => $user,
        ]);
    }

    public function deleteFoto($id)
    {
        // Ambil data kegiatan berdasarkan ID
        $kegiatan = KegiatanMagang::findOrFail($id);

        // Pastikan profil ada dan memiliki foto
        if ($kegiatan && $kegiatan->dok_kegiatan) {
            $filePath = $kegiatan->dok_kegiatan;

            // Hapus file dari storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Set kolom dok_kegiatan di database ke null
            $kegiatan->dok_kegiatan = null;
            $kegiatan->save();

            // Redirect dengan pesan sukses
            return redirect('/dashboard/kegiatan')->with('success', 'Foto kegiatan berhasil dihapus.');
        }

        // Redirect dengan pesan error jika foto tidak ditemukan
        return redirect('/dashboard/kegiatan')->with('error', 'Foto kegiatan tidak ditemukan.');
    }

    public function updateRevisi(Request $request, $id)
    {
        $request->validate([
            'revisi' => 'nullable|string',
        ]);

        $kegiatan = KegiatanMagang::findOrFail($id);
        $kegiatan->update([
            'revisi' => $request->revisi,
            'status_revisi' => $request->revisi ? 'Belum diubah' : '-',
        ]);

        return redirect()->back()->with('success', 'Revisi berhasil disimpan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $kegiatan = KegiatanMagang::findOrFail($id);
        $kegiatan->status_selesai = $request->has('status_selesai'); // true jika dicheck
        $kegiatan->save();

        return back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }
}
