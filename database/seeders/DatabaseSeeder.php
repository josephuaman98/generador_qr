<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        $this->call([
            SeederTablaPermisos::class,
            UsuarioSeeder::class,
            // PromocionSeeder::class,
            // MesSeeder::class,
            // StateSeeder::class,        
            // ZonaSeeder::class,
            // OficinaSeeder::class,
        ]);
    }
}
