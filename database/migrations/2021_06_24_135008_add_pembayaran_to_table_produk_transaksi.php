<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembayaranToTableProdukTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_transaksis', function (Blueprint $table) {
            $table->string('nomor_rekening')->nullable();
            $table->string('rekening')->nullable();
            $table->string('bukti_bayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_transaksis', function (Blueprint $table) {
            //
        });
    }
}
