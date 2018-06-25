<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProveedorBien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biens', function (Blueprint $table) {
           $table->integer('idproveedor')->nullable();
           $table->integer('idlocal')->nullable();
           $table->integer('idoficina')->nullable();
        });

         Schema::table('movimientos', function (Blueprint $table) {
           $table->integer('idlocal')->nullable();
           $table->integer('idoficina')->nullable();

           $table->varchar('desde_centrocosto',50)->nullable();
           $table->integer('desde_personal')->nullable();
           $table->integer('desde_local')->nullable();
           $table->integer('desde_oficina')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biens', function (Blueprint $table) {
            $table->dropColumn('idproveedor');
            $table->dropColumn('idlocal');
            $table->dropColumn('idoficina');
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropColumn('idlocal');
            $table->dropColumn('idoficina');

            $table->dropColumn('desde_centrocosto');
            $table->dropColumn('desde_personal');
            $table->dropColumn('desde_local');
            $table->dropColumn('desde_oficina');
        });
    }
}