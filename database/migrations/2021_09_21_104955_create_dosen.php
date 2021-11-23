<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('email_dosen');
            $table->string('password');
            $table->string('nama_dosen');
            $table->bigInteger('NIP');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->bigInteger('prodi_id');
            $table->bigInteger('roles_id');
            $table->string('ttd_wd')->nullable();
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
        Schema::dropIfExists('dosen');
    }
}
