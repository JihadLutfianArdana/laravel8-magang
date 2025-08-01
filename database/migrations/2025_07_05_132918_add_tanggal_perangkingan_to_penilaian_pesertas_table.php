<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalPerangkinganToPenilaianPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_pesertas', function (Blueprint $table) {
            $table->date('tanggal_perangkingan')->nullable()->after('is_penilaian_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_pesertas', function (Blueprint $table) {
            $table->dropColumn('tanggal_perangkingan');
        });
    }
}
