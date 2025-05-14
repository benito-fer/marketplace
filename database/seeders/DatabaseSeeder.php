<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar a los seeders necesarios
        $this->call([
            MarketplaceSeeder::class,
            UsuarioComercianteSeeder::class,
            CategoriaSeeder::class,
        ]);
    }
}


