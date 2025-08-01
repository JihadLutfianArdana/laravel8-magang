<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePendaftaranPesertaIdFromSuratBalasanMagangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_balasan_magangs', function (Blueprint $table) {
            $table->dropForeign(['pendaftaran_peserta_id']); // Hapus foreign key
            $table->dropColumn('pendaftaran_peserta_id');    // Hapus kolom
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_balasan_magangs', function (Blueprint $table) {
            $table->unsignedBigInteger('pendaftaran_peserta_id')->nullable();
            $table->foreign('pendaftaran_peserta_id')->references('id')->on('pendaftaran_pesertas');
        });
    }
}
