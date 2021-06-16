<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataparkirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataparkirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mhs_id')->unsigned();
            $table->string('no_kartu');
            $table->datetime('jam_masuk');
            $table->datetime('jam_keluar');
            $table->timestamps();
        });

        Schema::table('dataparkirs', function (Blueprint $table) {
            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataparkirs');
    }
}
