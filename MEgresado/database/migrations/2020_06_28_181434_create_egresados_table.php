<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('celular');
            $table->string('direccion');
            $table->string('referencia');
            $table->unsignedBigInteger('pais_id')->index();
            $table->unsignedBigInteger('departamento_id')->index();
            $table->unsignedBigInteger('provincia_id')->index();
            $table->unsignedBigInteger('distrito_id')->index();
            $table->unsignedBigInteger('persona_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egresados');
    }
}
