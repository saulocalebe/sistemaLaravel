<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->string('codigo')->nullable();
            $table->string('nome');
            $table->integer('estoque');
            $table->string('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->string('estado')->nullable();
            $table->boolean('condicao');
            $table->timestamps();
        });

        Schema::table('categorias', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
