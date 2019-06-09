<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exemplar_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->tinyInteger('periodo_entrega')->nullable();
            $table->bigInteger('user_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('emprestimos', function (Blueprint $table) {
            $table->foreign('exemplar_id')->references('id')->on('exemplares');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
}
