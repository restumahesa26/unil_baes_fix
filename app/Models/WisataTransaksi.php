<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataTransaksi extends Model
{
    use HasFactory;

    public $fillable = [
        'jumlah_orang', 'total_bayar', 'tanggal_tiket', 'nomor_rekening', 'bukti_bayar', 'qr_code'
    ];

    public function wisata()
    {
        return $this->hasOne(Wisata::class, 'id', 'wisata_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
