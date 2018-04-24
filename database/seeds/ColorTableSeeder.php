<?php

use Illuminate\Database\Seeder;

use App\Color;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['Color'=>'Rojo']);
        Color::create(['Color'=>'Marron']);
        Color::create(['Color'=>'Verde']);
    }
}
