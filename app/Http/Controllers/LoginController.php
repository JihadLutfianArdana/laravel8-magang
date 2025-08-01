<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Periksa status verifikasi
            if ($user->status_verifikasi !== 'verified') {
                Auth::logout();
                return back()->with('loginError', 'Akun Anda belum diverifikasi oleh admin.');
            }

            $request->session()->regenerate();

            // Arahkan berdasarkan nilai is_admin
            switch ($user->is_admin) {
                case 0:
                    // Peserta Magang
                    return redirect()->intended('/dashboard');
                case 1:
                    // Admin IT
                    return redirect()->intended('/dashboard-admin');
                case 2:
                    // Admin Pendaftaran
                    return redirect()->intended('/dashboard/admin-pendaftaran');
                case 3:
                    // Pembimbing Lapangan
                    return redirect()->intended('/dashboard/pembimbing-lapangan');
                default:
                    // Jika nilai is_admin tidak sesuai (opsional)
                    Auth::logout();
                    return back()->with('loginError', 'Role pengguna tidak dikenali.');
            }
        }
        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
