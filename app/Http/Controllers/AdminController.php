<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Menampilkan semua admin (1, 2, 3) dan user biasa yang sudah terverifikasi
        $admins = User::whereIn('is_admin', [1, 2, 3])
            ->orWhere(function ($query) {
                $query->where('is_admin', 0)
                    ->where('status_verifikasi', 'verified');
            })
            ->get();

        return view('dashboard.admin.index', [
            'title' => 'Kelola Pengguna',
            'admins' => $admins
        ]);
    }

    public function indexAP()
    {
        // Menampilkan daftar pengguna dengan is_admin = 0, 2, atau 3
        $admins = User::whereIn('is_admin', [1, 0, 2, 3])->get();
        return view('dashboard.admin.index-ap', [
            'title' => 'Kelola Pengguna',
            'admins' => $admins
        ]);
    }

    public function indexPL()
    {
        // Menampilkan daftar pengguna dengan is_admin = 0, 2, atau 3
        $admins = User::whereIn('is_admin', [1, 0, 2, 3])->get();
        return view('dashboard.admin.index-pl', [
            'title' => 'Kelola Pengguna',
            'admins' => $admins
        ]);
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:5|max:255',
            'is_admin' => 'required|in:0,1,2,3', // Validasi pilihan role
        ]);

        // // Setel is_admin menjadi true secara otomatis
        // $validatedData['is_admin'] = true;

        // Set status_verifikasi ke 'verified'
        $validatedData['status_verifikasi'] = 'verified';

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Buat admin baru
        User::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/kelola-pengguna')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function storeAP(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:5|max:255',
            'is_admin' => 'required|in:0,1,2,3', // Validasi pilihan role
        ]);

        // // Setel is_admin menjadi true secara otomatis
        // $validatedData['is_admin'] = true;

        // Set status_verifikasi ke 'verified'
        $validatedData['status_verifikasi'] = 'verified';

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Buat admin baru
        User::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/kelola-pengguna/admin-pendaftaran')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function print()
    {
        // Ambil data admin
        $admins = User::where('is_admin', 1)->get();
        // Render tampilan untuk print
        return view('dashboard.admin.print', [
            'title' => 'Cetak Data Pengguna',
            'admins' => $admins
        ]);
    }

    public function printAP()
    {
        // Ambil data admin
        $admins = User::where('is_admin', 2)->get();
        // Render tampilan untuk print
        return view('dashboard.admin.printAP', [
            'title' => 'Cetak Data Pengguna',
            'admins' => $admins
        ]);
    }

    public function printPL()
    {
        // Ambil data admin
        $admins = User::where('is_admin', 3)->get();
        // Render tampilan untuk print
        return view('dashboard.admin.printPL', [
            'title' => 'Cetak Data Pengguna',
            'admins' => $admins
        ]);
    }

    public function printPS()
    {
        // Ambil data admin
        $admins = User::where('is_admin', 0)->get();
        // Render tampilan untuk print
        return view('dashboard.admin.printPS', [
            'title' => 'Cetak Data Pengguna',
            'admins' => $admins
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek jika user memiliki role yang dapat dihapus
        if (in_array($user->is_admin, [1, 2, 3, 0])) {
            $user->delete();
            return redirect('/dashboard/kelola-pengguna')->with('success', 'Pengguna berhasil dihapus!');
        }

        return redirect('/dashboard/kelola-pengguna')->with('error', 'Anda tidak diizinkan menghapus pengguna ini!');
    }

    public function destroyAP($id)
    {
        $user = User::findOrFail($id);

        // Cek jika user memiliki role yang dapat dihapus
        if (in_array($user->is_admin, [1, 2, 3, 0])) {
            $user->delete();
            return redirect('/dashboard/kelola-pengguna/admin-pendaftaran')->with('success', 'Pengguna berhasil dihapus!');
        }
    }
}
