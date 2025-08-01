<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pembimbings', function (Blueprint $table) {
            $table->id();
            // foreign key peserta magang
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // foreign key pembimbing
            $table->string('nip_pembimbing');
            $table->foreign('nip_pembimbing')->references('nip')->on('ruangans')->onDelete('cascade');
            // kolom penilaian
            $table->string('poin_1');
            $table->string('poin_2');
            $table->string('poin_3');
            $table->string('poin_4');
            $table->string('poin_5');
            $table->text('saran')->nullable();
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
        Schema::dropIfExists('penilaian_pembimbings');
    }
}
