<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGruposToCatalogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogos', function (Blueprint $table) {
            $table->string('cod_grupo_generico',50);
            $table->string('cod_clase_generico',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogos', function (Blueprint $table) {
            $table->dropColumn('cod_grupo_generico',50);
            $table->dropColumn('cod_clase_generico',50);
        });
    }
}
