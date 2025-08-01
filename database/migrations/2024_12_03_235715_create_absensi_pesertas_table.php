<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan users
            $table->string('hari_tanggal'); // Kolom untuk hari dan tanggal
            $table->time('waktu_masuk'); // Kolom untuk waktu masuk
            $table->time('waktu_keluar')->nullable(); // Kolom untuk waktu keluar
            $table->string('status');
            $table->text('keterangan')->nullable(); // Kolom untuk keterangan
            $table->text('alasan')->nullable(); // Kolom untuk alasan
            $table->string('bukti')->nullable();
            $table->foreignId('edited_by')->nullable()->constrained('users')->onDelete('set null');
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
        Schema::dropIfExists('absensi_pesertas');
    }
}
