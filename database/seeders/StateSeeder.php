<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['name' => 'Inhabilitado', 'description' => 'Inhabilitado'],
            ['name' => 'Habilitado', 'description' => 'Habilitado'],
            ['name' => 'Etapa-1', 'description' => 'Etapa-1'],
            ['name' => 'Etapa-2', 'description' => 'Etapa-2'],
            ['name' => 'Etapa-3', 'description' => 'Etapa-3'],



        ]);
    }
}
