<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        // // Validasi inputan
        // $validatedData = $request->validate([
        //     'nama' => 'required|max:255',
        //     'email' => 'required|email:dns|unique:users,email',
        //     'password' => 'required|min:5|max:255',
        // ]);

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => [
                'required',
                'email:dns',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
                    $emailDomain = substr(strrchr($value, "@"), 1); // ambil bagian setelah "@"
                    if (!in_array($emailDomain, $allowedDomains)) {
                        $fail('Email must have a valid domain.');
                    }
                },
            ],
            'password' => 'required|min:5|max:255',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Cek apakah ini user pertama
        $isFirstUser = User::count() == 0;

        // Tentukan nilai is_admin: jika ini user pertama, set ke true, jika tidak set ke false
        $validatedData['is_admin'] = $isFirstUser ? true : false;

        // Tambahkan status verifikasi default
        $validatedData['status_verifikasi'] = $isFirstUser ? 'verified' : 'pending';

        // Simpan user ke database
        User::create($validatedData);

        // Redirect ke halaman login dengan pesan sukses
        $successMessage = $isFirstUser
            ? 'Registrasi berhasil! Silakan login untuk melanjutkan.'
            : 'Registrasi berhasil! Tunggu admin memverifikasi akun Anda.';
        return redirect('/login')->with('success', $successMessage);
    }
}
