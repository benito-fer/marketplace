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
                'imagen_url' => 'images/categorias/alimentacion.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cosmética',
                'descripcion' => 'Productos de cosmética',
                'imagen_url' => 'images/categorias/cosmetica.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ropa',
                'descripcion' => 'Productos de ropa',
                'imagen_url' => 'images/categorias/ropa.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Zapatos',
                'descripcion' => 'Productos de zapatos',
                'imagen_url' => 'images/categorias/zapatos.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Hogar',
                'descripcion' => 'Artículos para el hogar',
                'imagen_url' => 'images/categorias/hogar.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Deportes',
                'descripcion' => 'Artículos deportivos',
                'imagen_url' => 'images/categorias/deportes.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Electrónica',
                'descripcion' => 'Productos electrónicos',
                'imagen_url' => 'images/categorias/electronica.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 