<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaseGenericosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_genericos', function (Blueprint $table) {
            $table->increments('idclasegenerico');
            $table->string('cod_clase_generico',10);
            $table->string('clase_generico',50);
            $table->string('cod_grupo_generico',10);
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
        Schema::dropIfExists('clase_genericos');
    }
}
