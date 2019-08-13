<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplares', function (Blueprint $table) {
            $table->char('code', 7);
            $table->bigInteger('livro_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('status')->default('Utilizavel');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('exemplares', function (Blueprint $table) {
            $table->primary('code');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('livro_id')->references('id')->on('livros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exemplares');
    }
}
