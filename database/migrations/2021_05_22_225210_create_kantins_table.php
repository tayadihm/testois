<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mhs_id')->unsigned();
            $table->string('no_kartu');
            $table->datetime('jam_transaksi');
            $table->timestamps();
        });

        Schema::table('kantins', function (Blueprint $table) {
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
        Schema::dropIfExists('kantins');
    }
}
