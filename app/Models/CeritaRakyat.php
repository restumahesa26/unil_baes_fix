<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeritaRakyat extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'isi_cerita', 'gambar_cerita'
    ];
}
