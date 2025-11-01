<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AerolineasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunas aerolíneas de prueba
        $aerolineas = [
            [
                'IdAerolinea' => '1',
                'NombreAerolinea' => 'Aerolínea Mexicana',
                'Pais' => 'México',
                'Ciudad' => 'CDMX',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('aerolinea')->insert($aerolineas);
    }
}
