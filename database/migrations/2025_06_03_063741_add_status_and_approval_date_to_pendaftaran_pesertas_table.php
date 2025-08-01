<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndApprovalDateToPendaftaranPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftaran_pesertas', function (Blueprint $table) {
            $table->string('status')->default('Pending');
            $table->timestamp('tanggal_disetujui')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftaran_pesertas', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('tanggal_disetujui');
        });
    }
}
