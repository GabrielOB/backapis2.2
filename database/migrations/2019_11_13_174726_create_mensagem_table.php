<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_chat');
            $table->boolean('provider');
            $table->text('content');
            $table->boolean('read')->nullable();
            $table->timestamps();

            $table->foreign('id_chat')->references('id')->on('chat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagem');
    }
}
