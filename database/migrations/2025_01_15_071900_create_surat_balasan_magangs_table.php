<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratBalasanMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_balasan_magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->string('nomor_surat', 50);
            $table->string('lampiran', 10);
            $table->string('hal', 100);
            $table->text('alamat_surat');
            $table->text('kalimat_pembuka');
            $table->text('kalimat_penutup');
            $table->unsignedBigInteger('pendaftaran_peserta_id'); // Ganti nama_peserta menjadi pendaftaran_peserta_id
            $table->foreign('pendaftaran_peserta_id')->references('id')->on('pendaftaran_pesertas'); // Menambahkan foreign key
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
        Schema::dropIfExists('surat_balasan_magangs');
    }
}
