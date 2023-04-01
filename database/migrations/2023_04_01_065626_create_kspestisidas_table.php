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
        Schema::create('kspestisidas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('lokasisawah_id');
            $table->bigInteger('kegiatansawah_id');
            $table->bigInteger('pestisida_id');
            $table->date('ks_pestisida_tgl_semprot');
            $table->float('ks_pestisida_jumlah_takaran');
            $table->string('ks_pestisida_keterangan')->nullable();
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
        Schema::dropIfExists('kspestisidas');
    }
};
