<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibAutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_autor', function (Blueprint $table) {
            $table->increments('id_autor');
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('nombrecompleto',100);

            $table->unsignedInteger('id_sexo')->nullable();

            $table->foreign('id_sexo')->references('id_sexo')->on('lib_sexo');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_autor');
    }
}
