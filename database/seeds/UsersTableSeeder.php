<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'idrol'     => 1,
            'estado'    => 1,
        ]);
    }
}
