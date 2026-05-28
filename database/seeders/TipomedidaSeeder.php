<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipomedidaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipomedida')->insert([
            [
                'id' => 1,
                'descripcion' => 'UNIDAD',
                'grupo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'descripcion' => 'KILOS',
                'grupo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'descripcion' => 'GRAMOS',
                'grupo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'descripcion' => 'MILIGRAMOS',
                'grupo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'descripcion' => 'LITRO',
                'grupo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'descripcion' => 'MILILITRO',
                'grupo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'descripcion' => 'LIBRAS',
                'grupo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'descripcion' => 'ONZAS',
                'grupo' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}