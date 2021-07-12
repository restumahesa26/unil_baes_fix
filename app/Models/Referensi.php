<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    use HasFactory;

    public $fillable = [
        'luas_desa', 'jml_penduduk', 'jarak_kecamatan'
    ];
}
