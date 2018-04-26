<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            
            $table->increments('idmovimiento');
            $table->integer('idbien')->unsigned()->nullable();
            $table->string('codcatalogo',8)->nullable();
            $table->string('codinventario',50)->nullable();
            $table->string('codpatrimonial',50)->nullable();
            $table->string('imagen',200)->nullable();
            $table->string('centrocosto',50)->nullable();
            $table->integer('idpersonal')->unsigned()->nullable();
            $table->integer('idestado')->unsigned()->nullable();
            $table->decimal('valor',5,2)->nullable();
            $table->datetime('fecha_movimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
