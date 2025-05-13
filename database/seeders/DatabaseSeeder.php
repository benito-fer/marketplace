<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> master
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
<<<<<<< HEAD
{
    $this->call(MarketplaceSeeder::class);
}

    }
=======
    {
        $this->call([
            MarketplaceSeeder::class,
            UsuarioComercianteSeeder::class,
            CategoriaSeeder::class,
        ]);
    }
}

>>>>>>> master

