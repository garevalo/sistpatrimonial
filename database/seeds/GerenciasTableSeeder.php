<?php

use Illuminate\Database\Seeder;
use App\Gerencia;
use App\CentroCosto;

class GerenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        Gerencia::truncate();
        CentroCosto::truncate();

        Gerencia::create(['gerencia'=>'Alcaldía','centrocosto'=>'10001']);
        Gerencia::create(['gerencia'=>'Gerencia de Administración y Finanzas','centrocosto'=>'10002']);
        Gerencia::create(['gerencia'=>'Gerencia de Asuntos Jurídicos','centrocosto'=>'10003']);
        Gerencia::create(['gerencia'=>'Gerencia de Comunicación','centrocosto'=>'10004']);
        Gerencia::create(['gerencia'=>'Gerencia de Desarrollo Humano','centrocosto'=>'10005']);


        CentroCosto::create(['codcentrocosto'=>'10001',  'centrocosto' => 'Alcaldía']);
        CentroCosto::create(['codcentrocosto'=>'10002',  'centrocosto' => 'Gerencia de Administración y Finanzas']);
        CentroCosto::create(['codcentrocosto'=>'10002',  'centrocosto' => 'Gerencia de Asuntos Jurídicos']);
        CentroCosto::create(['codcentrocosto'=>'10004',  'centrocosto' => 'Gerencia de Comunicación']);
        CentroCosto::create(['codcentrocosto'=>'10005',  'centrocosto' => 'Gerencia de Desarrollo Humano']);
    }
}
