<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AvionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos aviones de prueba
        $aviones = [
            [
                'IdAvion' => '1',
                'IdAerolinea' => '1',
                'Placa' => 'XA-ABC',
                'Tipo' => 'Comercial',
                'Modelo' => 'Boeing 737-800',
                'Capacidad' => 180,
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'IdAvion' => '2',
                'IdAerolinea' => '1',
                'Placa' => 'XA-DEF',
                'Tipo' => 'Comercial',
                'Modelo' => 'Airbus A320',
                'Capacidad' => 150,
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('avion')->insert($aviones);
    }
}
