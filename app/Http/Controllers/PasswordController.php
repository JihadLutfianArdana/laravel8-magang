<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function indexAdmin()
    {
        return view('dashboard.password-reset.index', [
            'title' => 'Reset Password',
        ]);
    }

    public function indexPeserta()
    {
        return view('dashboard.password-reset.index-ps', [
            'title' => 'Reset Password',
        ]);
    }

    public function indexAdminAP()
    {
        return view('dashboard.password-reset.index-ap', [
            'title' => 'Reset Password',
        ]);
    }

    public function indexPL()
    {
        return view('dashboard.password-reset.index-pl', [
            'title' => 'Reset Password',
        ]);
    }

    public function updateAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        // Ambil user yang sedang login berdasarkan ID
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/dashboard/reset-password-admin')->with('error', 'User tidak ditemukan.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/dashboard/reset-password-admin')->with('success', 'Password berhasil diubah!');
    }

    public function updatePeserta(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        // Ambil user yang sedang login berdasarkan ID
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/dashboard/reset-password-peserta')->with('error', 'User tidak ditemukan.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/dashboard/reset-password-peserta')->with('success', 'Password berhasil diubah!');
    }

    public function updateAdminAP(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        // Ambil user yang sedang login berdasarkan ID
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/dashboard/reset-password-adminpendaftaran')->with('error', 'User tidak ditemukan.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/dashboard/reset-password-adminpendaftaran')->with('success', 'Password berhasil diubah!');
    }

    public function updatePL(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        // Ambil user yang sedang login berdasarkan ID
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/dashboard/reset-password-pembimbing')->with('error', 'User tidak ditemukan.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/dashboard/reset-password-pembimbing')->with('success', 'Password berhasil diubah!');
    }
}
