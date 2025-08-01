<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nism', 10)->unique();
            $table->string('nama_peserta', 50);
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah_universitas', 50);
            $table->string('no_telepon', 15);
            $table->string('email', 30)->unique();
            $table->text('alamat');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('profile_peserta');
    }
}
