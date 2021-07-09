<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class ProdukTransaksi extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id', 'produk_id', 'quantitas', 'total_harga', 'total_berat', 'status_bayar', 'status_pengiriman', 'kode_resi', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id', 'alamat_lengkap', 'kode_pos', 'nomor_rekening', 'rekening', 'bukti_bayar', 'metode_pengiriman', 'ongkos_kirim', 'nomor_rekening_2', 'rekening_2', 'bukti_bayar_2'
    ];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'produk_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function provinsi()
    {
        return $this->hasOne(Province::class, 'id', 'provinsi_id');
    }

    public function kota()
    {
        return $this->hasOne(City::class, 'id', 'kota_id');
    }

    public function kecamatan()
    {
        return $this->hasOne(District::class, 'id', 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->hasOne(Village::class, 'id', 'kelurahan_id');
    }
}
