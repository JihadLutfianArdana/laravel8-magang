<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalPenilaianToPenilaianPembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_pembimbings', function (Blueprint $table) {
            $table->date('tanggal_penilaian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_pembimbings', function (Blueprint $table) {
            $table->dropColumn('tanggal_penilaian');
        });
    }
}
