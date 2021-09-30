<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetuaDepartemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketua_departemen', function (Blueprint $table) {
            $table->id();
            $table->string('email_kadep');
            $table->string('password');
            $table->string('nama_kadep');
            $table->bigInteger('NIP');
            $table->string('prodi_kadep');
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
        Schema::dropIfExists('ketua_departemen');
    }
}