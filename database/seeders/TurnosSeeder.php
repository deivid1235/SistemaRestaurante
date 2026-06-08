<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        DB::table('turnos')->insert([
            [
                'nombre' => 'Turno Mañana',
                'hora_inicio' => '07:00:00',
                'hora_fin' => '12:00:00',
                'estado' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Turno Tarde',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '18:00:00',
                'estado' => 'activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Turno Noche',
                'hora_inicio' => '18:00:00',
                'hora_fin' => '23:00:00',
                'estado' => 'activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
    }
}
