<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('idpersonal');
            $table->string("nombres",50);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->integer('dni')->unique();

            $table->integer('idcargo_personal')->unsigned();
            $table->foreign('idcargo_personal')->references('idcargo')->on('cargos');

            $table->integer('idgerencia_personal')->unsigned()->nullable();
            $table->foreign('idgerencia_personal')->references('idgerencia')->on('gerencias');

            $table->integer('idsubgerencia_personal')->unsigned()->nullable();
            $table->foreign('idsubgerencia_personal')->references('idsubgerencia')->on('subgerencias');

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
        Schema::dropIfExists('personals');
    }
}
