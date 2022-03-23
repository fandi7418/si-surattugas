<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('approve')->nullable();
            $table->string('no_surat')->nullable();
            $table->string('nama')->nullable();
            $table->string('NIP');
            $table->string('prodi_id')->nullable();
            $table->string('golongan_id')->nullable();
            $table->string('jabatan_id')->nullable();
            $table->string('judul');
            $table->string('jenis');
            $table->string('tempat');
            $table->string('kota');
            $table->date('tanggalawal')->nullable();
            $table->date('tanggalakhir')->nullable();
            $table->bigInteger('status_id');
            // $table->string('ttd_kadep')->nullable();
            $table->string('ttd_wd')->nullable();
            // $table->string('ttd_spv')->nullable();
            // $table->string('nama_kadep')->nullable();
            // $table->string('NIP_kadep')->nullable();
            $table->string('nama_wd')->nullable();
            $table->string('NIP_wd')->nullable();
            // $table->string('nama_supervisor')->nullable();
            // $table->string('NIP_supervisor')->nullable();
            $table->bigInteger('notif')->nullable();
            $table->bigInteger('id_pengguna')->nullable();
            $table->bigInteger('roles_id');
            $table->rememberToken();
            $table->timestamps();
        });
        // Schema::table('dosen', function ($table) {
        //     $table->foreign('NIP')
        //     ->references('NIP')
        //     ->on('surat')
        //     ->onUpdate('cascade')
        //     ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat');
    }
}
