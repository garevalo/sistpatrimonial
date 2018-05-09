<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('idarticulos');
            $table->integer('cantidad');
            $table->string('umedida');
            $table->string('descripcion');
            $table->integer('idpedido')->unsigned();
            $table->string('estado_articulo');
            $table->timestamps();

            $table->foreign('idpedido')->references('idpedido')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
