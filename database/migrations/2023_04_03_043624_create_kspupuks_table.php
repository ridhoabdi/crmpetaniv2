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
        Schema::create('kspupuks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('lokasisawah_id');
            $table->bigInteger('kegiatansawah_id');
            $table->bigInteger('jenispupuk_id');
            $table->bigInteger('merkpupuk_id');
            $table->date('ks_pupuk_tgl_rabuk');
            $table->float('ks_pupuk_jumlah_takaran');
            $table->string('ks_pupuk_keterangan')->nullable();
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
        Schema::dropIfExists('kspupuks');
    }
};
