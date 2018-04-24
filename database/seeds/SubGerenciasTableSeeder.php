<?php

use Illuminate\Database\Seeder;
use App\Subgerencia;
use App\CentroCosto;


class SubGerenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*Subgerencia::truncate();
        CentroCosto::truncate();

        Subgerencia::create(['subgerencia'=>'SG de Organizaciones Sociales','centrocosto'=>'10006']);
        Subgerencia::create(['subgerencia'=>'SG de Áreas Verdes','centrocosto'=>'10007']);
        Subgerencia::create(['subgerencia'=>'SG de Complementación Alimentaria','centrocosto'=>'10008']);
        Subgerencia::create(['subgerencia'=>'SG de Promoción Social, Demuna','centrocosto'=>'10009']);
        Subgerencia::create(['subgerencia'=>'SG de Deportes','centrocosto'=>'10010']);*/

        CentroCosto::create(['codcentrocosto'=>'10006',  'centrocosto' => 'SG de Organizaciones Sociales']);
        CentroCosto::create(['codcentrocosto'=>'10007',  'centrocosto' => 'SG de Áreas Verdes']);
        CentroCosto::create(['codcentrocosto'=>'10008',  'centrocosto' => 'SG de Complementación Alimentaria']);
        CentroCosto::create(['codcentrocosto'=>'10009',  'centrocosto' => 'SG de Promoción Social, Demuna']);
        CentroCosto::create(['codcentrocosto'=>'10010',  'centrocosto' => 'SG de Deportes']);
    }
}
