<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToSubgerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subgerencias', function (Blueprint $table) {
            //$table->integer('idgerencia')->unsigned();
            //$table->foreign('idgerencia')->references('idgerencia')->on('gerencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subgerencias', function (Blueprint $table) {
            //
        });
    }
}
