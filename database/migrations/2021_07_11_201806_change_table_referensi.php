<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableReferensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referensis', function (Blueprint $table) {
            $table->dropColumn('kategori');
            $table->dropColumn('value');
            $table->integer('luas_desa');
            $table->integer('jml_penduduk');
            $table->integer('jarak_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referensis', function (Blueprint $table) {
            //
        });
    }
}
