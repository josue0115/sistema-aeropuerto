<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Ejecutar seeders para datos de prueba
        $this->call([
            AerolineasSeeder::class,
            AeropuertosSeeder::class,
            AvionesSeeder::class,
            VuelosSeeder::class,
            PasajerosSeeder::class,
            BoletosSeeder::class,
        ]);
    }
}
