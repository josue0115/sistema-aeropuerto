<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);

        \App\Models\User::create([
            'name' => 'Operador Test',
            'email' => 'operador@test.com',
            'password' => bcrypt('password'),
            'role' => 'operador',
        ]);

        \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
