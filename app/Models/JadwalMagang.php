<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_magang_id',
        'user_id',
        'ruangan_id',
        'tanggal_awal',
        'tanggal_akhir',
        'updated_by',
    ];

    // Relasi ke DetailMagang
    public function detailMagang()
    {
        return $this->belongsTo(DetailMagang::class, 'detail_magang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
