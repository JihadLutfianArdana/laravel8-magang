<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNilaiSawToPenilaianPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_pesertas', function (Blueprint $table) {
            $table->float('nilai_saw', 8, 4)->nullable()->after('nilai_tanggung_jawab');
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
            $table->dropColumn('nilai_saw');
        });
    }
}
