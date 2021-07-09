<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wisata_transaksis', function (Blueprint $table) {
            $table->integer('jumlah_orang')->nullable()->change();
            $table->date('tanggal_tiket')->nullable()->change();
            $table->time('jam_sewa')->nullable();
            $table->date('tanggal_sewa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wisata_transaksis', function (Blueprint $table) {
            //
        });
    }
}
