<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_wisata', 'deskripsi', 'fasilitas', 'harga', 'hari_buka', 'jam_buka', 'jam_tutup', 'kategori', 'waktu', 'ketentuan', 'status', 'story', 'wisata_360', 'youtube_url'
    ];

    public function gambar_wisata()
    {
        return $this->hasMany(GambarWisata::class, 'wisata_id', 'id');
    }

    public function wisata_transaksi()
    {
        return $this->belongsTo(WisataTransaksi::class, 'id', 'wisata_id');
    }
}
