<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    public $fillable = [
        'nama_rekening', 'nomor_rekening', 'atas_nama'
    ];
}
