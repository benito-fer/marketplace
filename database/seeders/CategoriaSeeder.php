<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Alimentación',
                'descripcion' => 'Productos de alimentación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cosmética',
                'descripcion' => 'Productos de cosmética',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ropa',
                'descripcion' => 'Productos de ropa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Zapatos',
                'descripcion' => 'Productos de zapatos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 