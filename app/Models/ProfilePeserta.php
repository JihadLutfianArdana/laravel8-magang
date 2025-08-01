<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePeserta extends Model
{
    use HasFactory;

    protected $table = 'profile_peserta';

    protected $fillable = [
        'user_id',
        'nism',
        'nama_peserta',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'asal_sekolah_universitas',
        'no_telepon',
        'email',
        'alamat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Model ProfilePeserta.php
    public function detailMagang()
    {
        return $this->hasOne(DetailMagang::class, 'nism', 'nism');
    }
}
