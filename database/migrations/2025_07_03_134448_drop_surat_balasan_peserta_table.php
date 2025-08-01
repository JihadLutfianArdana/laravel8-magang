<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSuratBalasanPesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('surat_balasan_peserta');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optional: kalau mau buat lagi di rollback
        Schema::create('surat_balasan_peserta', function ($table) {
            $table->id();
            $table->unsignedBigInteger('surat_balasan_id');
            $table->unsignedBigInteger('pendaftaran_peserta_id');
            $table->timestamps();
        });
    }
}
