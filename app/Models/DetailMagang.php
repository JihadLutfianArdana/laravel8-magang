<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nism',
        'nama_peserta',
        'asal_sekolah_universitas',
        'kelas_jurusan',
        'nama_pembimbing',
        'jumlah_anggota',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
    ];

    // Relasi ke ProfilePeserta
    public function profilePeserta()
    {
        return $this->belongsTo(ProfilePeserta::class, 'nism', 'nism');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalMagangs()
    {
        return $this->hasMany(JadwalMagang::class, 'detail_magang_id');
    }

    // Relasi ke PenilaianPeserta
    public function penilaianPesertas()
    {
        return $this->hasOne(PenilaianPeserta::class, 'detail_magang_id');
    }
}
