<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Rol::create(['rol'=>'Administrador']);
		Rol::create(['rol'=>'Inventariador']);
    }
}
