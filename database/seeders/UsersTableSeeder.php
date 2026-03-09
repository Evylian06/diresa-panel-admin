<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            ['name' => 'Director DIRESA', 'password' => Hash::make('12345678'), 'role' => 'superAdmin']
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Enfermero', 'password' => Hash::make('12345678'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'cliente@example.com'],
            ['name' => 'Gestante', 'password' => Hash::make('12345678'), 'role' => 'cliente']
        );
    }
}
