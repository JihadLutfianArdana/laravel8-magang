<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiPembimbing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'keterampilan_arahan',
        'kepedulian_sikap',
        'membimbing_solusi',
        'disiplin_tanggung_jawab',
        'kesiapan_materi',
        'komentar',
        'tanggal_penilaian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
