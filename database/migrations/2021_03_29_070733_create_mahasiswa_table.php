<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu')->unique();
            $table->string('nim')->unique();
            $table->string('nama_mhs');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('alamat');
            $table->string('no_telfon');
            $table->string('password');
            $table->string('email')->unique();
            $table->rememberToken();
            $table->string('saldo');
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
        Schema::dropIfExists('mahasiswa');
    }
}
