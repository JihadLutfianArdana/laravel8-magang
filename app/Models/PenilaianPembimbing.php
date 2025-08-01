<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPembimbing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip_pembimbing',
        'poin_1',
        'poin_2',
        'poin_3',
        'poin_4',
        'poin_5',
        'saran',
        'tanggal_penilaian'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Ruangan::class, 'nip_pembimbing', 'nip');
    }

    public function detailMagang()
    {
        return $this->belongsTo(DetailMagang::class, 'user_id', 'user_id');
    }
}
