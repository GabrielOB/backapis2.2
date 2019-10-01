<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->text('descricao');
            $table->float('nota')->default(0.0);
            $table->integer('tipo')->default(1);
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
        Schema::dropIfExists('prestadors');
    }
}
