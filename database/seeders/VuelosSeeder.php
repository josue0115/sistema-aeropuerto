<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VuelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos vuelos de prueba
        $vuelos = [
            [
                'IdVuelo' => 1,
                'IdAeropuertoOrigen' => '1',
                'IdAeropuertoDestino' => '2',
                'IdAvion' => '1',
                'FechaSalida' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'FechaLlegada' => Carbon::now()->addDays(1)->addHours(2)->format('Y-m-d'),
                'Precio' => 150.00,
                'Estado' => 'Programado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'IdVuelo' => 2,
                'IdAeropuertoOrigen' => '2',
                'IdAeropuertoDestino' => '1',
                'IdAvion' => '2',
                'FechaSalida' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'FechaLlegada' => Carbon::now()->addDays(2)->addHours(3)->format('Y-m-d'),
                'Precio' => 200.00,
                'Estado' => 'Programado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'IdVuelo' => 3,
                'IdAeropuertoOrigen' => '1',
                'IdAeropuertoDestino' => '3',
                'IdAvion' => '1',
                'FechaSalida' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'FechaLlegada' => Carbon::now()->addDays(3)->addHours(4)->format('Y-m-d'),
                'Precio' => 250.00,
                'Estado' => 'Programado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('vuelo')->insert($vuelos);
    }
}
