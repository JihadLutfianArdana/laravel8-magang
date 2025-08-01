<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiPembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('keterampilan_arahan');
            $table->integer('kepedulian_sikap');
            $table->integer('membimbing_solusi');
            $table->integer('disiplin_tanggung_jawab');
            $table->integer('kesiapan_materi');
            $table->text('komentar')->nullable();
            $table->date('tanggal_penilaian');
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
        Schema::dropIfExists('evaluasi_pembimbings');
    }
}
