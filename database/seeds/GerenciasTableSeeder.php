<?php

use Illuminate\Database\Seeder;
use App\Gerencia;

class GerenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gerencia::create(['gerencia'=>'Alcaldía','centrocosto'=>'10001']);
        Gerencia::create(['gerencia'=>'Gerencia de Administración y Finanzas','centrocosto'=>'10002']);
        Gerencia::create(['gerencia'=>'Gerencia de Asuntos Jurídicos','centrocosto'=>'10003']);
        Gerencia::create(['gerencia'=>'Gerencia de Comunicación','centrocosto'=>'10004']);
        Gerencia::create(['gerencia'=>'Gerencia de Desarrollo Humano','centrocosto'=>'10005']);
    }
}
