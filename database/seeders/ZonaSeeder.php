<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zonas')->insert([
            ['nombre' => 'ZONA REGISTRAL - SEDE LIMA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE HUANCAYO', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE AREQUIPA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE HUARAZ', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE PIURA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE CUSCO', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE TACNA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE TRUJILLO', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE IQUITOS', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE ICA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE CHICLAYO', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE MOYOBAMBA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE PUCALLPA', 'state_id' => 2],
            ['nombre' => 'ZONA REGISTRAL - SEDE AYACUCHO', 'state_id' => 2],
        ]);
    }
}
