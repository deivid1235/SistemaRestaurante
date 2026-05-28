<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'ADMINISTRATOR'],
            ['id' => 2, 'nombre' => 'ADMINISTRADOR'],
            ['id' => 3, 'nombre' => 'CAJERO'],
            ['id' => 4, 'nombre' => 'PRODUCCION'],
            ['id' => 5, 'nombre' => 'MOZO'],
            ['id' => 6, 'nombre' => 'REPARTIDOR'],
            ['id' => 7, 'nombre' => 'PERSONALIZADO'],
        ]);
    }
}
