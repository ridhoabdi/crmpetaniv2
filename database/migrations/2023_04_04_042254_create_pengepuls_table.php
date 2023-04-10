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
        Schema::create('pengepuls', function (Blueprint $table) {
            $table->id();
            $table->string('pengepul_nama');
            $table->string('pengepul_kontak')->unique();
            $table->string('pengepul_ktp')->nullable();
            $table->string('pengepul_kabupaten');
            $table->string('pengepul_alamat');
            $table->string('password');
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
        Schema::dropIfExists('pengepuls');
    }
};
