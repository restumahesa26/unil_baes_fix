<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOngkosKirimToProdukTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_transaksis', function (Blueprint $table) {
            $table->string('metode_pengiriman')->nullable();
            $table->integer('ongkos_kirim')->nullable();
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
