<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConteoInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteo_inventarios', function (Blueprint $table) {
            $table->increments('idconteo');
            $table->integer('idbien')->unsigned()->nullable();
            $table->string('codcatalogo',8)->nullable();
            $table->string('codinventario',50)->nullable();
            $table->string('codpatrimonial',50)->nullable();
         
            $table->datetime('fecha_conteo')->nullable();

            $table->integer('situacion')->nullable();
            $table->integer('idinventario')->nullable();
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
        Schema::dropIfExists('conteo_inventarios');
    }
}
