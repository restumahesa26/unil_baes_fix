<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->references('id')->on('wisatas');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('jumlah_orang');
            $table->integer('total_bayar');
            $table->date('tanggal_tiket');
            $table->string('nomor_rekening')->nullable();
            $table->string('rekening')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->string('status_bayar')->default('belum-bayar');
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
        Schema::dropIfExists('wisata_transaksis');
    }
}
