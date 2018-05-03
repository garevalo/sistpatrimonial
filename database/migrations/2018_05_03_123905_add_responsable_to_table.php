<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponsableToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centro_costos', function (Blueprint $table) {
            $table->string('idgerencia',50)->nullable();
            $table->string('idsubgerencia',50)->nullable();
            $table->string('idlocal',50)->nullable();
            $table->string('idpersonal',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centro_costos', function (Blueprint $table) {
            $table->dropColumn('idgerencia');
            $table->dropColumn('idsubgerencia');
            $table->dropColumn('idlocal');
            $table->dropColumn('idpersonal');
        });
    }
}
