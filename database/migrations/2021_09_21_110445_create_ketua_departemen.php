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
            $table->string('email_kadep')->nullable();
            $table->string('password')->nullable();
            $table->string('nama_kadep')->nullable();
            $table->bigInteger('NIP')->nullable();
            $table->bigInteger('prodi_id');
            $table->string('ttd_kadep')->nullable();
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
