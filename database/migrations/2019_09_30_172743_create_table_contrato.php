<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_prestador');
            $table->unsignedBigInteger('id_servico');
            $table->time('hora');
            $table->date('data');
            $table->float('valor');
            $table->text('descricao');
            $table->unsignedBigInteger('status');
            $table->boolean('conf_cli');
            $table->boolean('conf_pre');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('usuarios');
            $table->foreign('id_prestador')->references('id')->on('usuarios');
            $table->foreign('id_servico')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_contrato');
    }
}
