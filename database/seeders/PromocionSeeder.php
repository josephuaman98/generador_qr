<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // descripcion

        DB::table('promocions')->insert([
            ['nombre' => 'PLAN DIARIO PERSONAL', 'descripcion' => '1 MES CALENDARIO', 'estado' => 'Activo'],
            ['nombre' => 'PLAN INTER DIARIO PERSONAL','descripcion' => '12 INGRESOS',  'estado' => 'Activo'],
            ['nombre' => '2X1 DIARIO','descripcion' => '1 MES CALENDARIO', 'estado' => 'Activo'],
            ['nombre' => '2X1 INTERDIARIO','descripcion' => '12 INGRESOS', 'estado' => 'Activo'],
            ['nombre' => '3X1 INTERDIARIO','descripcion' => '12 INGRESOS',   'estado' => 'Activo'],
            ['nombre' => 'PLAN DESAFIO','descripcion' => 'DIARIO',   'estado' => 'Activo'],
            ['nombre' => 'PLAN VERANO EXTREMO','descripcion' => 'DIARIO (12PM A 4PM)',   'estado' => 'Activo'],
            ['nombre' => 'PLAN WEEKEND','descripcion' => 'VIERNES, SABADO Y DOMINGO',   'estado' => 'Activo'], 
        ]);
    }
}
