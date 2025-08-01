<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPeserta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function suratBalasans()
    {
        return $this->belongsToMany(SuratBalasanMagang::class, 'surat_balasan_peserta', 'pendaftaran_peserta_id', 'surat_balasan_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->hasOne(User::class, 'id_pendaftaran');  // Relasi dengan id_pendaftaran
    }
}
