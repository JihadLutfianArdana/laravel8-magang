<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHariTanggalColumnTypeInAbsensiPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi_pesertas', function (Blueprint $table) {
            $table->date('hari_tanggal')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensi_pesertas', function (Blueprint $table) {
            $table->string('hari_tanggal')->change();
        });
    }
}
