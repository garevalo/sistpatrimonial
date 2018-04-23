<?php

use Illuminate\Database\Seeder;
use App\Subgerencia;

class SubGerenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subgerencia::create(['subgerencia'=>'SG de Organizaciones Sociales','centrocosto'=>'10006']);
        Subgerencia::create(['subgerencia'=>'SG de Áreas Verdes','centrocosto'=>'10007']);
        Subgerencia::create(['subgerencia'=>'SG de Complementación Alimentaria','centrocosto'=>'10008']);
        Subgerencia::create(['subgerencia'=>'SG de Promoción Social, Demuna','centrocosto'=>'10009']);
        Subgerencia::create(['subgerencia'=>'SG de Deportes','centrocosto'=>'10010']);
    }
}
