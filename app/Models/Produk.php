<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 'kategori', 'deskripsi', 'stok', 'berat', 'harga', 'status', 'story'
    ];

    public function gambar_produk()
    {
        return $this->hasMany(GambarProduk::class, 'produk_id', 'id');
    }
}
