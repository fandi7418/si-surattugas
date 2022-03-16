<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengguna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('nama');
            $table->bigInteger('NIP');
            $table->bigInteger('jabatan_id');
            $table->bigInteger('golongan_id');
            $table->bigInteger('prodi_id')->nullable();
            $table->bigInteger('roles_id');
            $table->string('ttd')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('pengguna');
    }
}
