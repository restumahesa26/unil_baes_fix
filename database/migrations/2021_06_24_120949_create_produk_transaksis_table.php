<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('produk_id')->references('id')->on('produks');
            $table->integer('quantitas');
            $table->integer('total_harga');
            $table->integer('total_berat');
            $table->string('status_bayar');
            $table->string('status_pengiriman')->nullable();
            $table->string('kode_resi')->nullable();
            $table->char('provinsi_id', 2);
            $table->char('kota_id', 4);
            $table->char('kecamatan_id', 7);
            $table->char('kelurahan_id', 10);
            $table->index('provinsi_id');
            $table->index('kota_id');
            $table->index('kecamatan_id');
            $table->index('kelurahan_id');
            $table->foreign('provinsi_id')->references('id')->on('provinces');
            $table->foreign('kota_id')->references('id')->on('cities');
            $table->foreign('kecamatan_id')->references('id')->on('districts');
            $table->foreign('kelurahan_id')->references('id')->on('villages');
            $table->string('alamat_lengkap');
            $table->integer('kode_pos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_transaksis');
    }
}
