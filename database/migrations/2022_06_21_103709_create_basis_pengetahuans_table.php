<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasisPengetahuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basis_pengetahuans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_gejala');
            $table->unsignedBigInteger('id_penyakit');
            $table->foreign('id_gejala')->references('id')->on('gejalas');
            $table->foreign('id_penyakit')->references('id')->on('penyakits');
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
        Schema::dropIfExists('basis_pengetahuans');
    }
}
