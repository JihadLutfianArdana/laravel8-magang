<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'deskripsi_kegiatan',
        'lokasi_kegiatan',
        'dok_kegiatan',
        'user_id',
        'revisi',
        'status_revisi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailMagang()
    {
        return $this->belongsTo(DetailMagang::class, 'user_id', 'user_id');
    }
}
