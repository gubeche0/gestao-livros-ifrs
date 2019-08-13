<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->bigInteger('curso_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->year('ano')->useCurrent();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreign('curso_id')->references('id')->on('cursos');
        });

        Schema::table('emprestimos', function (Blueprint $table) {
            $table->bigInteger('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}
