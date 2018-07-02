<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaordenToBien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biens', function (Blueprint $table) {
            $table->datetime('fecha_ordencompra')->nullable();
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
            $table->dropColumn('fecha_ordencompra');  
        });
    }
}
