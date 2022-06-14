<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnuncioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncio', function (Blueprint $table) {
            $table->id(); //Clave primaria
            $table->string('titulo', 80);
            $table->text('descripcion');
            $table->string('telefono', 15);
            $table->string('correo', 150)->nullable();
            $table->string('localidad', 150);
            $table->decimal('precio', 9, 2);
            $table->string('nombre', 50)->nullable();
            $table->timestamps(); //Fecha de creacion y edicion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anuncio');
    }
}
