<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        DB::table('empresas')->updateOrInsert(
            [
            'id' => 1,
            'ruc' => '10038965161',
            'razon_social' => 'SANCHEZ CASTILLO ALEX OMAR',
            'nombre_comercial' => 'GRUPOAOSC',

            'direccion_comercial' => 'PERU',
            'direccion_fiscal' => 'PERU',

            'ubigeo' => '150132',
            'departamento' => 'PIURA',
            'provincia' => 'TALARA',
            'distrito' => 'PARIÑAS',

            'modo' => 'beta',

            'usuariosol' => 'FACTURA1',
            'clave_sol' => 'grupoaosc2025',
            'clavecertificado' => 'grupoaosc2025',

            'logo' => 'logoprint.jpg',
            'celular' => '952167090',
            'email' => 'empresas@example.com',

            'created_at' => now(),
            'updated_at' => now(),
            ]
        );
    }

}
