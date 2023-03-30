<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatansawahs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('lokasisawah_id');
            $table->string('ks_metode_pengairan');
            $table->string('ks_sumber_modal');
            $table->float('ks_luas_lahan');
            $table->float('ks_jumlah_bibit');
            $table->date('ks_waktu_tanam');
            $table->string('ks_status_lahan');
            $table->float('ks_jumlah_modal');
            $table->integer('ks_panen')->nullable();
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
        Schema::dropIfExists('kegiatansawahs');
    }
};
