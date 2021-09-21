<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasPenomoran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petugas_penomoran', function (Blueprint $table) {
            $table->id();
            $table->string('email_petugas');
            $table->string('password');
            $table->string('nama_petugas');
            $table->bigInteger('NIP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petugas_penomoran');
    }
}
