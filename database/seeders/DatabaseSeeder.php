<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        // Usuario de prueba
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('12345678'),
                'role' => 'cliente',
            ]
        );

        // SuperAdmin
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Director DIRESA',
                'password' => Hash::make('12345678'),
                'role' => 'superAdmin',
            ]
        );

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Enfermero',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        // Cliente
        User::updateOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'Gestante',
                'password' => Hash::make('12345678'),
                'role' => 'cliente',
            ]
        );
           $this->call(GestanteSeeder::class);
    }
}
