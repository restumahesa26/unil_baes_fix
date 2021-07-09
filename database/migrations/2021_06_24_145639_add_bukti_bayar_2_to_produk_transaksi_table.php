<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuktiBayar2ToProdukTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_transaksis', function (Blueprint $table) {
            $table->string('nomor_rekening_2')->nullable();
            $table->string('rekening_2')->nullable();
            $table->string('bukti_bayar_2')->nullable();
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
