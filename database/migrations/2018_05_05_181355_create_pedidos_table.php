<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('idpedido');
            $table->string('cc_solicitante',10);
            $table->string('cc_destino',10);
            $table->string('responsable',10);
            $table->string('lugar',100)->nullable();
            $table->integer('estado_pedido');
            $table->string('descripcion')->nullable();
            $table->date('fecha_entrega')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
}
