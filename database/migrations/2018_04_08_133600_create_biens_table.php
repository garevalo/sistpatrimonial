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
            $table->string('codinventario',50)->nullable();
            $table->string('codpatrimonial',50)->nullable();
            $table->string('ordencompra',50)->nullable();
            $table->string('denominacion',50)->nullable();
            $table->integer('idmarca')->unsigned()->nullable();
            $table->integer('idmodelo')->unsigned()->nullable();
            $table->string('numserie',50)->nullable();
            $table->integer('idestado')->unsigned()->nullable();
            $table->decimal('valor',5,2)->nullable();
            $table->integer('idadquisicion')->unsigned()->nullable();
            $table->datetime('fecha_adquision')->nullable();
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