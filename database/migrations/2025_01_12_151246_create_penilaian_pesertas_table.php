<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pesertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_magang_id'); // Foreign key
            $table->foreign('detail_magang_id')->references('id')->on('detail_magangs')->onDelete('cascade');
            $table->integer('nilai_kehadiran');
            $table->integer('nilai_kegiatan');
            $table->integer('nilai_sikap');
            $table->integer('nilai_kedisiplinan');
            $table->integer('nilai_kerjasama');
            $table->integer('nilai_komunikasi');
            $table->integer('nilai_tanggung_jawab');
            $table->text('komentar')->nullable();
            $table->boolean('is_penilaian_selesai')->default(false);
            $table->unsignedBigInteger('edited_by')->nullable(); // Foreign key ke tabel users
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('penilaian_pesertas');
    }
}
