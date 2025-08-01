<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_magang_id');
            $table->foreign('detail_magang_id')->references('id')->on('detail_magangs')->onDelete('cascade');
            $table->unsignedBigInteger('user_id'); // Kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('ruangan_id'); // Relasi ke tabel ruangans
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
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
        Schema::dropIfExists('jadwal_magangs');
    }
}
