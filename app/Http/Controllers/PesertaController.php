<?php

namespace App\Http\Controllers;

use App\Models\User;

class PesertaController extends Controller
{
    public function index()
    {
        $admins = User::where('is_admin', 1)->get();

        // Ambil semua peserta dengan status 'verified' dan bukan admin
        $verifiedUsers = User::where('status_verifikasi', 'verified')
            ->where('is_admin', 0)
            ->get();

        // Ambil semua peserta dengan status 'pending'
        $pendingUsers = User::where('status_verifikasi', 'pending')
            ->where('is_admin', 0)
            ->get();

        // Hitung jumlah user dengan status pending
        $pendingCount = $pendingUsers->count();

        return view('dashboard.peserta.index', [
            'title' => 'Verifikasi Peserta',
            'verifiedUsers' => $verifiedUsers,
            'pendingUsers' => $pendingUsers,
            'pendingCount' => $pendingCount,
            'admins' => $admins
        ]);
    }

    public function indexAP()
    {
        $admins = User::where('is_admin', 2)->get();

        // Ambil semua peserta dengan status 'verified' dan bukan admin
        $verifiedUsers = User::where('status_verifikasi', 'verified')
            ->where('is_admin', 0)
            ->get();

        // Ambil semua peserta dengan status 'pending'
        $pendingUsers = User::where('status_verifikasi', 'pending')
            ->where('is_admin', 0)
            ->get();

        // Hitung jumlah user dengan status pending
        $pendingCount = $pendingUsers->count();

        return view('dashboard.peserta.index-ap', [
            'title' => 'Verifikasi Peserta',
            'verifiedUsers' => $verifiedUsers,
            'pendingUsers' => $pendingUsers,
            'pendingCount' => $pendingCount,
            'admins' => $admins
        ]);
    }

    public function indexPL()
    {
        $admins = User::where('is_admin', 2)->get();

        // Ambil semua peserta dengan status 'verified' dan bukan admin
        $verifiedUsers = User::where('status_verifikasi', 'verified')
            ->where('is_admin', 0)
            ->get();

        // Ambil semua peserta dengan status 'pending'
        $pendingUsers = User::where('status_verifikasi', 'pending')
            ->where('is_admin', 0)
            ->get();

        // Hitung jumlah user dengan status pending
        $pendingCount = $pendingUsers->count();

        return view('dashboard.peserta.index-pl', [
            'title' => 'Verifikasi Peserta',
            'verifiedUsers' => $verifiedUsers,
            'pendingUsers' => $pendingUsers,
            'pendingCount' => $pendingCount,
            'admins' => $admins
        ]);
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status_verifikasi = 'verified';
        $user->approved_by = auth()->id();
        $user->save();

        return redirect('/dashboard/verifikasi-peserta')->with('success', 'Pengguna berhasil diverifikasi.');
    }

    public function approveAP($id)
    {
        $user = User::findOrFail($id);
        $user->status_verifikasi = 'verified';
        $user->approved_by = auth()->id();
        $user->save();

        return redirect('/dashboard/verifikasi-peserta/admin-pendaftaran')->with('success', 'Pengguna berhasil diverifikasi.');
    }


    public function reject($id)
    {
        $user = User::findOrFail($id);
        // Hapus user dari database
        $user->delete();

        return redirect('/dashboard/verifikasi-peserta')->with('success', 'Verifikasi pengguna ditolak.');
    }

    public function rejectAP($id)
    {
        $user = User::findOrFail($id);
        // Hapus user dari database
        $user->delete();

        return redirect('/dashboard/verifikasi-peserta/admin-pendaftaran')->with('success', 'Verifikasi pengguna ditolak.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/dashboard/verifikasi-peserta')->with('success', 'Data peserta berhasil dihapus.');
    }

    public function destroyAP($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/dashboard/verifikasi-peserta/admin-pendaftaran')->with('success', 'Data peserta berhasil dihapus.');
    }

    public function print()
    {
        $verifiedUsers = User::where('status_verifikasi', 'verified')
            ->where('is_admin', 0)
            ->get();

        return view('dashboard.peserta.print', [
            'title' => 'Cetak Data Peserta',
            'verifiedUsers' => $verifiedUsers,
        ]);
    }
}
