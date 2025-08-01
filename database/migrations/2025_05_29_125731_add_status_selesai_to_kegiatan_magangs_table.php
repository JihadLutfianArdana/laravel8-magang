<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusSelesaiToKegiatanMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_magangs', function (Blueprint $table) {
            $table->boolean('status_selesai')->default(false); // status checkbox
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan_magangs', function (Blueprint $table) {
            $table->dropColumn('status_selesai');
        });
    }
}
