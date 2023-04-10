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
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('pengepul_id');
            $table->bigInteger('lokasisawah_id');
            $table->bigInteger('kegiatansawah_id');
            // $table->bigInteger('kspestisida_id');
            // $table->bigInteger('kspupuk_id');
            $table->date('panen_tanggal');
            $table->float('panen_jumlah');
            $table->float('panen_kualitas_a')->nullable();
            $table->float('panen_kualitas_b')->nullable();
            $table->float('panen_kualitas_c')->nullable();
            $table->float('panen_harga');
            $table->string('panen_status')->nullable();
            $table->string('statusdaripengepul')->nullable();
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
        Schema::dropIfExists('panens');
    }
};
