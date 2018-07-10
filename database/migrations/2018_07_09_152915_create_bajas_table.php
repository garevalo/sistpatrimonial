<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bajas', function (Blueprint $table) {
            $table->increments('idbaja');
            $table->integer('idlocal')->nullable();
            $table->integer('idoficina')->nullable();
            $table->string('centrocosto',10)->nullable();
            $table->integer('idpersonal')->nullable();
            $table->string('imagen',100)->nullable();
            $table->date('fechabaja')->nullable();
            $table->string('descripcion',100)->nullable();
            $table->integer('idbien');
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
        Schema::dropIfExists('bajas');
    }
}
