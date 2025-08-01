<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_magang_id',
        'nilai_kehadiran',
        'nilai_kegiatan',
        'nilai_sikap',
        'nilai_kedisiplinan',
        'nilai_kerjasama',
        'nilai_komunikasi',
        'nilai_tanggung_jawab',
        'nilai_saw',
        'komentar',
        'nomor_sertifikat',
        'tanggal_sertifikat',
        'tanggal_penilaian',
        'is_penilaian_selesai',
        'tanggal_perangkingan',
        'edited_by',
    ];

    // Relasi ke DetailMagang
    public function detailMagang()
    {
        return $this->belongsTo(DetailMagang::class, 'detail_magang_id');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
