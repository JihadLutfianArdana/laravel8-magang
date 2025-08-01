<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nism', 10)->unique();
            $table->string('nama_lengkap', 50);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 10);
            $table->text('alamat');
            $table->string('no_telepon', 15);
            $table->string('email', 30)->unique();
            $table->string('asal_sekolah_universitas', 50);
            $table->string('kelas_jurusan', 30);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('surat_pengantar_path');
            $table->boolean('is_checked')->default(false);
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
        Schema::dropIfExists('pendaftaran_pesertas');
    }
}
