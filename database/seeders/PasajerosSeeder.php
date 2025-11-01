<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos pasajeros de prueba
        $pasajeros = [
            [
                'idPasajero' => 1,
                'Nombre' => 'Juan',
                'Apellido' => 'Pérez',
                'Pais' => 'México',
                'TipoPasajero' => 'Adulto',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idPasajero' => 2,
                'Nombre' => 'María',
                'Apellido' => 'García',
                'Pais' => 'México',
                'TipoPasajero' => 'Adulto',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idPasajero' => 3,
                'Nombre' => 'Carlos',
                'Apellido' => 'Rodríguez',
                'Pais' => 'México',
                'TipoPasajero' => 'Adulto',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idPasajero' => 4,
                'Nombre' => 'Ana',
                'Apellido' => 'Martínez',
                'Pais' => 'México',
                'TipoPasajero' => 'Adulto',
                'Estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('pasajeros')->insert($pasajeros);
    }
}
