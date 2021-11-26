<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('email_staff');
            $table->string('password');
            $table->string('nama_staff');
            $table->bigInteger('NIP');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->bigInteger('prodi_id')->nullable();
            $table->bigInteger('roles_id');
            $table->string('ttd_spv')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
