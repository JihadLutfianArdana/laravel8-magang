<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_magangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan relasi ke tabel users
            $table->string('nama_kegiatan', 100);
            $table->date('tanggal_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->string('lokasi_kegiatan', 100);
            $table->string('dok_kegiatan')->nullable();
            $table->text('revisi')->nullable();
            $table->string('status_revisi', 20)->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_magangs');
    }
}
