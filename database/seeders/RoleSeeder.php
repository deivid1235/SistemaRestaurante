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
            ['id' => 2, 'nombre' => 'CAJERO'],
            ['id' => 3, 'nombre' => 'PRODUCCION'],
            ['id' => 4, 'nombre' => 'MOZO'],
            ['id' => 5, 'nombre' => 'REPARTIDOR'],
            ['id' => 6, 'nombre' => 'PERSONALIZADO'],
        ]);
    }
}
