<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailMagang;
use App\Models\ProfilePeserta;
use App\Models\PendaftaranPeserta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Mendapatkan profile peserta yang sedang login
        $profile = ProfilePeserta::where('user_id', Auth::id())->first();

        return view('dashboard.profile.index', [
            'title' => 'Profile',
            'profile' => $profile
        ]);
    }

    public function edit()
    {
        // Mendapatkan data dari model ProfilePeserta
        $profile = ProfilePeserta::where('user_id', Auth::id())->first();

        // Mendapatkan data pendaftaran peserta berdasarkan email user yang sedang login
        $pendaftaran = PendaftaranPeserta::where('email', Auth::user()->email)->first();

        // Kirim data profile peserta yang sudah terdaftar
        return view('dashboard.profile.edit', [
            'title' => 'Edit Profile',
            'pendaftaran' => $pendaftaran,
            'profile' => $profile,
        ]);
    }

    public function update(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nism' => 'required|unique:profile_peserta,nism,' . Auth::id() . ',user_id',
            'nama_peserta' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah_universitas' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|email:dns|unique:profile_peserta,email,' . Auth::id() . ',user_id',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512'
        ]);

        // Mendapatkan profile peserta yang sedang login
        $profile = ProfilePeserta::where('user_id', Auth::id())->first();

        // Tentukan apakah ini adalah penyimpanan pertama kali atau update
        $isNewProfile = !$profile;

        // Jika profil tidak ada, buat profil baru
        if ($isNewProfile) {
            $profile = new ProfilePeserta;
            $profile->user_id = Auth::id();
        }

        // Cek jika ada foto yang diunggah
        if ($request->hasFile('foto')) {
            // Cek apakah foto lama ada dan hapus file foto lama
            if ($profile->foto) {
                Storage::disk('public')->delete($profile->foto);  // Hapus foto lama
            }

            // Upload foto baru
            $path = $request->file('foto')->store('images', 'public');
            $profile->foto = $path;  // Menyimpan foto ke dalam objek profile
        }

        // Menyimpan atau memperbarui data profil
        $profile->nism = $validatedData['nism'];
        $profile->nama_peserta = $validatedData['nama_peserta'];
        $profile->jenis_kelamin = $validatedData['jenis_kelamin'];
        $profile->tempat_lahir = $validatedData['tempat_lahir'];
        $profile->tanggal_lahir = $validatedData['tanggal_lahir'];
        $profile->asal_sekolah_universitas = $validatedData['asal_sekolah_universitas'];
        $profile->no_telepon = $validatedData['no_telepon'];
        $profile->email = $validatedData['email'];
        $profile->alamat = $validatedData['alamat'];

        // Simpan data ke database
        $profile->save();

        // Update DetailMagang berdasarkan nism yang sama dengan yang ada di ProfilePeserta
        $detailMagang = DetailMagang::where('user_id', Auth::id())->first();
        if ($detailMagang) {
            $detailMagang->nism = $profile->nism;
            $detailMagang->nama_peserta = $profile->nama_peserta;
            $detailMagang->asal_sekolah_universitas = $profile->asal_sekolah_universitas;
            $detailMagang->save();
        }

        // Tampilkan pesan sukses sesuai kondisi
        $message = $isNewProfile ? 'Data berhasil disimpan!' : 'Data berhasil diperbarui!';

        return redirect('/dashboard/profile')->with('success', $message);
    }

    public function show($nama)
    {
        // Cari data profil berdasarkan nama user
        $profile = ProfilePeserta::whereHas('user', function ($query) use ($nama) {
            $query->where('nama', $nama);
        })->first();
        return view('dashboard.profile.show', [
            'title' => 'Detail Profil',
            'profile' => $profile
        ]);
    }

    public function showAP($nama)
    {
        // Cari data profil berdasarkan nama user
        $profile = ProfilePeserta::whereHas('user', function ($query) use ($nama) {
            $query->where('nama', $nama);
        })->first();
        return view('dashboard.profile.show-ap', [
            'title' => 'Detail Profil',
            'profile' => $profile
        ]);
    }

    public function showPL($nama)
    {
        // Cari data profil berdasarkan nama user
        $profile = ProfilePeserta::whereHas('user', function ($query) use ($nama) {
            $query->where('nama', $nama);
        })->first();
        return view('dashboard.profile.show-pl', [
            'title' => 'Detail Profil',
            'profile' => $profile
        ]);
    }

    public function deletePhoto()
    {
        // Cari profil berdasarkan user yang sedang login
        $profile = ProfilePeserta::where('user_id', Auth::id())->first();

        // Pastikan profil ada dan memiliki foto
        if ($profile && $profile->foto) {
            $filePath = $profile->foto;

            // Hapus file dari storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Set kolom foto di database ke null
            $profile->foto = null;
            $profile->save();

            // Redirect dengan pesan sukses
            return redirect('/dashboard/profile')->with('success', 'Foto profil berhasil dihapus.');
        }

        // Redirect dengan pesan error jika foto tidak ditemukan
        return redirect('/dashboard/profile')->with('error', 'Foto profil tidak ditemukan.');
    }
}
