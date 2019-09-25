<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_servico', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned();
            $table->integer('servico_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')
                ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_servico');
    }
}
