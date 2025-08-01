<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\PenilaianPembimbing;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PenilaianPembimbingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $pembimbing = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->first();

        // Ambil penilaian yang sudah pernah dilakukan user (jika ada)
        $penilaian = PenilaianPembimbing::where('user_id', $userId)->first();

        return view('dashboard.pembimbing.index', [
            'title' => 'Penilaian Pembimbing',
            'pembimbing' => $pembimbing,
            'penilaian' => $penilaian // <-- kirim ke blade
        ]);
    }

    public function indexAdmin()
    {
        // Mengambil semua pengguna yang bukan admin dan memuat relasi dengan DetailMagang
        $users = User::where('is_admin', 0)
            ->with('detailMagang') // Memuat relasi DetailMagang
            ->get();

        return view('dashboard.pembimbing.index-admin', [
            'title' => 'Evaluasi Pembimbing',
            'users' => $users,
        ]);
    }

    public function indexAP()
    {
        // Mengambil semua pengguna yang bukan admin dan memuat relasi dengan DetailMagang
        $users = User::where('is_admin', 0)
            ->with('detailMagang') // Memuat relasi DetailMagang
            ->get();

        return view('dashboard.pembimbing.index-ap', [
            'title' => 'Evaluasi Pembimbing',
            'users' => $users,
        ]);
    }

    public function indexPL()
    {
        // Mengambil semua pengguna yang bukan admin dan memuat relasi dengan DetailMagang
        $users = User::where('is_admin', 0)
            ->with('detailMagang') // Memuat relasi DetailMagang
            ->get();

        return view('dashboard.pembimbing.index-pl', [
            'title' => 'Evaluasi Pembimbing',
            'users' => $users,
        ]);
    }

    public function showAdmin($id)
    {
        // Ambil user yang menilai
        $user = User::with('detailMagang')->findOrFail($id);

        // Ambil penilaian berdasarkan user_id
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();

        // Ambil data pembimbing
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        return view('dashboard.pembimbing.show-admin', [
            'title' => 'Evaluasi Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
        ]);
    }

    public function showAP($id)
    {
        // Ambil user yang menilai
        $user = User::with('detailMagang')->findOrFail($id);

        // Ambil penilaian berdasarkan user_id
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();

        // Ambil data pembimbing
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        return view('dashboard.pembimbing.show-ap', [
            'title' => 'Evaluasi Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
        ]);
    }

    public function showPL($id)
    {
        // Ambil user yang menilai
        $user = User::with('detailMagang')->findOrFail($id);

        // Ambil penilaian berdasarkan user_id
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();

        // Ambil data pembimbing
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        return view('dashboard.pembimbing.show-pl', [
            'title' => 'Evaluasi Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
        ]);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'nip_pembimbing' => 'required|exists:ruangans,nip',
            'poin_1' => 'required|string',
            'poin_2' => 'required|string',
            'poin_3' => 'required|string',
            'poin_4' => 'required|string',
            'poin_5' => 'required|string',
            'saran'   => 'nullable|string',
        ], [
            'poin_1.required' => 'Silakan pilih penilaian untuk poin 1.',
            'poin_2.required' => 'Silakan pilih penilaian untuk poin 2.',
            'poin_3.required' => 'Silakan pilih penilaian untuk poin 3.',
            'poin_4.required' => 'Silakan pilih penilaian untuk poin 4.',
            'poin_5.required' => 'Silakan pilih penilaian untuk poin 5.',
        ]);

        // Cek apakah user sudah pernah menilai sebelumnya
        $existing = PenilaianPembimbing::where('user_id', $userId)->first();

        // Simpan atau update
        PenilaianPembimbing::updateOrCreate(
            ['user_id' => $userId],
            [
                'nip_pembimbing' => $validated['nip_pembimbing'],
                'poin_1' => $validated['poin_1'],
                'poin_2' => $validated['poin_2'],
                'poin_3' => $validated['poin_3'],
                'poin_4' => $validated['poin_4'],
                'poin_5' => $validated['poin_5'],
                'saran' => $validated['saran'] ?? null,
                'tanggal_penilaian' => Carbon::now()->format('Y-m-d'),
            ]
        );

        // Tentukan pesan sukses berdasarkan kondisi
        $message = $existing ? 'Penilaian berhasil diperbarui!' : 'Penilaian berhasil disimpan!';

        return redirect('/dashboard/penilaian-pembimbing-lapangan')->with('success', $message);
    }

    public function cetak($id)
    {
        $user = User::with('detailMagang')->findOrFail($id);
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.pembimbing.print', [
            'title' => 'Cetak Penilaian Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan
        ]);
    }

    public function cetakAP($id)
    {
        $user = User::with('detailMagang')->findOrFail($id);
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.pembimbing.print-ap', [
            'title' => 'Cetak Penilaian Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan
        ]);
    }

    public function cetakPL($id)
    {
        $user = User::with('detailMagang')->findOrFail($id);
        $penilaian = PenilaianPembimbing::where('user_id', $id)->first();
        $pembimbing = Ruangan::where('nip', $penilaian->nip_pembimbing ?? null)->first();

        // Ambil data kepala balai dan pembimbing lapangan
        $kepalaBalai = Ruangan::where('jabatan', 'KADIS Bapelkes')->value('nama_pegawai');
        $pembimbingLapangan = Ruangan::where('peran_khusus', 'Pembimbing Lapangan')->value('nama_pegawai');

        return view('dashboard.pembimbing.print-pl', [
            'title' => 'Cetak Penilaian Pembimbing',
            'user' => $user,
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
            'kepalaBalai' => $kepalaBalai,
            'pembimbingLapangan' => $pembimbingLapangan
        ]);
    }
}
