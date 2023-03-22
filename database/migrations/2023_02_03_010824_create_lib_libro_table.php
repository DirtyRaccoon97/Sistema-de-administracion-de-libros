<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_libro', function (Blueprint $table) {
            $table->increments('id_libro');
            $table->string('titulo',100)->unique();
            $table->string('descripcion',290)->nullable();
            $table->date('fecha_publicacion');

            $table->unsignedInteger('id_idioma')->nullable();
            $table->foreign('id_idioma')->references('id_idioma')->on('lib_idioma');
        });
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_libro');
    }
}
