<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioComercianteSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'comerciante@example.com'],
            [
                'name' => 'Comerciante Demo',
                'email' => 'comerciante@example.com',
                'password' => Hash::make('password123'),
                'rol' => 'comerciante',
            ]
        );
    }
}

