<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jabatan',
        'nama_ruangan',
        'peran_khusus',
    ];

    public function jadwalMagangs()
    {
        return $this->hasMany(JadwalMagang::class);
    }
}
