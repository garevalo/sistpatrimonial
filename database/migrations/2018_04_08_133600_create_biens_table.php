<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->increments('idbien');
            $table->string('codcatalogo',8)->nullable();
            $table->string('codinventario',50)->nullable();
            $table->string('codpatrimonial',50)->nullable();
            $table->string('ordencompra',50)->nullable();
            $table->integer('idmarca')->unsigned()->nullable();
            $table->integer('idmodelo')->unsigned()->nullable();
            $table->integer('idcolor')->unsigned()->nullable();
            $table->string('imagen',200)->nullable();
            $table->string('numserie',50)->nullable();
            $table->string('centrocosto',50)->nullable();
            $table->integer('idpersonal')->unsigned()->nullable();
            $table->integer('idestado')->unsigned()->nullable();
            $table->decimal('valor',5,2)->nullable();
            $table->integer('idadquisicion')->unsigned()->nullable();
            $table->datetime('fecha_adquisicion')->nullable();
            $table->text('descripcion');
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
        Schema::dropIfExists('biens');
    }
}
