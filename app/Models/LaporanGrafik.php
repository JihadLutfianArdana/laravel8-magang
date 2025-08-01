<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGrafik extends Model
{
    use HasFactory;

    protected $table = 'laporan_grafik';

    protected $fillable = [
        'asal_sekolah_universitas',
        'jumlah',
        'tanggal_mulai',
    ];
}
