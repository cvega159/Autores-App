<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nombre');
            $table->integer('paginas');
            $table->integer('codLibro');
            $table->float('precio');
            $table->enum('editorial', ['penguin ramdon house','planeta','RBA libros','ediciones urbano','edelvives','anaya']);
            $table->string('imgLibro')->nullable();
            $table->timestamps();
            
            //restricciones
            
            $table->unique(['user_id', 'nombre']);
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
