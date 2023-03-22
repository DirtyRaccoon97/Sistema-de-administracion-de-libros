<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibAsignarAutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_asignar_autores', function (Blueprint $table) {
            $table->unsignedInteger('id_libro');
            $table->foreign('id_libro')->references('id_libro')->on('lib_libro')->onDelete('cascade');


            $table->unsignedInteger('id_autor');
            $table->foreign('id_autor')->references('id_autor')->on('lib_autor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_asignar_autores');
    }
}
