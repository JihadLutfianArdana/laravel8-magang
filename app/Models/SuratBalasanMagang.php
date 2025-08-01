<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBalasanMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'nomor_surat',
        'lampiran',
        'hal',
        'alamat_surat',
        'kalimat_pembuka',
        'kalimat_penutup',
        'pendaftaran_peserta_id'
    ];

    // public function peserta()
    // {
    //     return $this->belongsToMany(PendaftaranPeserta::class, 'surat_balasan_peserta', 'surat_balasan_id', 'pendaftaran_peserta_id');
    // }

    // SuratBalasanMagang.php
    public function peserta()
    {
        return $this->belongsTo(PendaftaranPeserta::class, 'pendaftaran_peserta_id');
    }
}
