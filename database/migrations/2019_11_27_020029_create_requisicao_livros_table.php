<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicaoLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_livros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('volume')->nullable();
            $table->string('autor')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('assunto_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('assunto_id')->references('id')->on('assuntos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisicao_livros');
    }
}
