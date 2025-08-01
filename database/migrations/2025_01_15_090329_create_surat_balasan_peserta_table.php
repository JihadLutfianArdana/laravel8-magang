<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratBalasanPesertaTable extends Migration
{
    public function up()
    {
        Schema::create('surat_balasan_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_balasan_id')->constrained('surat_balasan_magangs')->onDelete('cascade'); // Make sure to reference the correct table name
            $table->foreignId('pendaftaran_peserta_id')->constrained('pendaftaran_pesertas')->onDelete('cascade'); // Make sure to reference the correct table name
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_balasan_peserta');
    }
}
