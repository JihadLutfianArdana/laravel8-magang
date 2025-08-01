<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'is_admin',
        'status_verifikasi',
        'approved_by',
        'id_pendaftaran',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function kegiatanMagang()
    {
        return $this->hasMany(KegiatanMagang::class);
    }

    public function detailMagang()
    {
        return $this->hasOne(DetailMagang::class, 'user_id'); // 'user_id' adalah foreign key
    }

    // public function penilaian()
    // {
    //     return $this->hasOne(PenilaianPeserta::class, 'detail_magang_id');
    // }

    public function penilaian(): HasOneThrough
    {
        return $this->hasOneThrough(
            PenilaianPeserta::class, // model tujuan akhir
            DetailMagang::class,     // model perantara
            'user_id',               // foreign key di DetailMagang yg mengarah ke User
            'detail_magang_id',      // foreign key di PenilaianPeserta yg mengarah ke DetailMagang
            'id',                    // local key di User
            'id'                     // local key di DetailMagang
        );
    }

    // Relasi dengan model PendaftaranPeserta
    public function pendaftaranPeserta()
    {
        return $this->belongsTo(PendaftaranPeserta::class, 'id_pendaftaran');  // Relasi dengan id_pendaftaran
    }
}
