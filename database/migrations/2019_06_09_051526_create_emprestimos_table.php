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
            $table->char('exemplar_code',7);
            $table->bigInteger('aluno_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('emprestimos', function (Blueprint $table) {
            $table->foreign('exemplar_code')->references('code')->on('exemplares');
            $table->foreign('aluno_id')->references('id')->on('alunos');
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
