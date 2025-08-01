<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPeserta extends Model
{
    use HasFactory;

    /**
     * Define the table name (optional if the table follows Laravel naming convention).
     */
    protected $table = 'absensi_pesertas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',         // Relasi ke tabel users
        'hari_tanggal',    // Hari dan tanggal absensi
        'waktu_masuk',     // Waktu masuk
        'waktu_keluar',    // Waktu keluar
        'status',
        'keterangan',      // Keterangan absensi
        'alasan',
        'bukti',
        'edited_by',
    ];

    /**
     * Relasi ke model User.
     * AbsensiPeserta dimiliki oleh satu User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailMagang()
    {
        return $this->belongsTo(DetailMagang::class, 'user_id', 'user_id');
    }
}
