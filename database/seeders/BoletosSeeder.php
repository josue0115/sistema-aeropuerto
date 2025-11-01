<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BoletosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos boletos de prueba
        $boletos = [
            [
                'idBoleto' => 1,
                'idVuelo' => 1,
                'idPasajero' => 1,
                'FechaCompra' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'Precio' => 150.00,
                'Cantidad' => 1,
                'Descuento' => 0.00,
                'Impuesto' => 15.00,
                'Total' => 165.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idBoleto' => 2,
                'idVuelo' => 2,
                'idPasajero' => 2,
                'FechaCompra' => Carbon::now()->subDays(10)->format('Y-m-d H:i:s'),
                'Precio' => 200.00,
                'Cantidad' => 1,
                'Descuento' => 10.00,
                'Impuesto' => 19.00,
                'Total' => 209.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idBoleto' => 3,
                'idVuelo' => 1,
                'idPasajero' => 3,
                'FechaCompra' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s'),
                'Precio' => 180.00,
                'Cantidad' => 1,
                'Descuento' => 0.00,
                'Impuesto' => 18.00,
                'Total' => 198.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idBoleto' => 4,
                'idVuelo' => 3,
                'idPasajero' => 1,
                'FechaCompra' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s'),
                'Precio' => 250.00,
                'Cantidad' => 1,
                'Descuento' => 25.00,
                'Impuesto' => 22.50,
                'Total' => 247.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idBoleto' => 5,
                'idVuelo' => 2,
                'idPasajero' => 4,
                'FechaCompra' => Carbon::now()->subDays(25)->format('Y-m-d H:i:s'),
                'Precio' => 175.00,
                'Cantidad' => 1,
                'Descuento' => 0.00,
                'Impuesto' => 17.50,
                'Total' => 192.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('boletos')->insert($boletos);
    }
}
