<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar usuarios
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Juan Pérez',
                'email' => 'juan@cliente.com',
                'password_hash' => bcrypt('cliente123'),
                'tipo_usuario' => 'cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Panadería Los Caballos',
                'email' => 'info@loscaballos.es',
                'password_hash' => bcrypt('comerciante1'),
                'tipo_usuario' => 'comerciante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Miel La Molina',
                'email' => 'contacto@lamolina.es',
                'password_hash' => bcrypt('comerciante2'),
                'tipo_usuario' => 'comerciante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Quesos El Llano Jaral',
                'email' => 'ventas@llanojaral.com',
                'password_hash' => bcrypt('comerciante3'),
                'tipo_usuario' => 'comerciante',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insertar categorías
        DB::table('categorias')->insert([
            [
                'nombre' => 'Alimentación',
                'descripcion' => 'Comida local y productos frescos',
                'imagen_url' => './images/pan.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cosmética',
                'descripcion' => 'Bienestar y belleza natural',
                'imagen_url' => './images/cosmetica.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insertar productos
        DB::table('productos')->insert([
            [
                'nombre' => 'Pan artesanal',
                'descripcion' => 'Pan horneado en leña, receta tradicional.',
                'precio' => 3.50,
                'imagen_url' => './images/pan.jpeg',
                'id_categoria' => 1,
                'id_comerciante' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Miel local',
                'descripcion' => 'Miel pura de abeja cosechada en Álora.',
                'precio' => 8.00,
                'imagen_url' => './images/miel.jpeg',
                'id_categoria' => 1,
                'id_comerciante' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Queso de cabra',
                'descripcion' => 'Queso fresco elaborado con leche de cabra.',
                'precio' => 7.20,
                'imagen_url' => './images/quesos-tiernos.jpg',
                'id_categoria' => 1,
                'id_comerciante' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insertar contactos
        DB::table('contactos')->insert([
            [
                'producto_id' => 1,
                'telefono' => '600123111',
                'email_contacto' => 'info@loscaballos.es',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'producto_id' => 2,
                'telefono' => '600123222',
                'email_contacto' => 'contacto@lamolina.es',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'producto_id' => 3,
                'telefono' => '600123333',
                'email_contacto' => 'ventas@llanojaral.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

