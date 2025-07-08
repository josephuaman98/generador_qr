<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mes')->insert([
            ['promocions_id' => 1, 'nombre' => '1 MES', 'precio' => 110, 'estado' => 'Activo'],
            ['promocions_id' => 1, 'nombre' => '3 MESES', 'precio' => 280, 'estado' => 'Activo'],
            ['promocions_id' => 1, 'nombre' => '6 MESES', 'precio' => 500, 'estado' => 'Activo'],
            ['promocions_id' => 1, 'nombre' => '12 MESES', 'precio' => 800, 'estado' => 'Activo'],
            ['promocions_id' => 2, 'nombre' => '1 MES', 'precio' => 90, 'estado' => 'Activo'],
            ['promocions_id' => 3, 'nombre' => '1 MES', 'precio' => 199, 'estado' => 'Activo'],
            ['promocions_id' => 3, 'nombre' => '3 MESES', 'precio' => 480, 'estado' => 'Activo'],
            ['promocions_id' => 3, 'nombre' => '6 MESES', 'precio' => 850, 'estado' => 'Activo'],
            ['promocions_id' => 3, 'nombre' => '12 MESES', 'precio' => 1500, 'estado' => 'Activo'],
            ['promocions_id' => 4, 'nombre' => '1 MES', 'precio' => 160, 'estado' => 'Activo'],
            ['promocions_id' => 4, 'nombre' => '3 MESES', 'precio' => 410, 'estado' => 'Activo'],
            ['promocions_id' => 4, 'nombre' => '6 MESES', 'precio' => 800, 'estado' => 'Activo'],
            ['promocions_id' => 4, 'nombre' => '12 MESES', 'precio' => 1400, 'estado' => 'Activo'],
            ['promocions_id' => 5, 'nombre' => '1 MES', 'precio' => 199, 'estado' => 'Activo'],
            ['promocions_id' => 6, 'nombre' => '1 MES', 'precio' => 299, 'estado' => 'Activo'],
            ['promocions_id' => 7, 'nombre' => '1 MES', 'precio' => 79, 'estado' => 'Activo'],
            ['promocions_id' => 8, 'nombre' => '1 MES', 'precio' => 69, 'estado' => 'Activo'],

        ]);
    }
}
