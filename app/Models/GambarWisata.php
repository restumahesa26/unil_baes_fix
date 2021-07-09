<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarWisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'wisata_id', 'gambar_url'
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id', 'id');
    }
}
