<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AeropuertosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos aeropuertos de prueba
        $aeropuertos = [
            [
                'IdAeropuerto' => '1',
                'NombreAeropuerto' => 'Aeropuerto Internacional Benito Juárez',
                'Ciudad' => 'Ciudad de México',
                'Pais' => 'México',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'IdAeropuerto' => '2',
                'NombreAeropuerto' => 'Aeropuerto Internacional de Los Ángeles',
                'Ciudad' => 'Los Ángeles',
                'Pais' => 'Estados Unidos',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'IdAeropuerto' => '3',
                'NombreAeropuerto' => 'Aeropuerto Internacional de Madrid-Barajas',
                'Ciudad' => 'Madrid',
                'Pais' => 'España',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('aeropuerto')->insert($aeropuertos);
    }
}
