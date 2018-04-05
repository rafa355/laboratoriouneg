<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputadoraenusoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computadoraenuso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('computadora')->unsigned()->unique();
            $table->integer('estudiante')->unsigned()->unique();
            $table->foreign('computadora')->references('id')->on('computadoras')->onDelete('cascade');
            $table->foreign('estudiante')->references('id')->on('estudiantes')->onDelete('cascade');
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
        Schema::dropIfExists('computadoraenuso');
    }
}
