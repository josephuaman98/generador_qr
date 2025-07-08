<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinaSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('oficinas')->insert([
            ['nombre' => 'LIMA','nro' => '01', 'zona_id' => 1,'state_id' => 2],
            ['nombre' => 'CALLAO','nro' => '02', 'zona_id' => 1,'state_id' => 2],
            ['nombre' => 'HUARAL','nro' => '03','zona_id' => 1,'state_id' => 2],
            ['nombre' => 'HUACHO','nro' => '04', 'zona_id' => 1,'state_id' => 2],
            ['nombre' => 'CAÑETE','nro' => '05', 'zona_id' => 1,'state_id' => 2],
            ['nombre' => 'BARRANCA','nro' => '06', 'zona_id' => 1,'state_id' => 2],
            ['nombre' => 'HUANCAYO','nro' => '01', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'HUANUCO','nro' => '02', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'PASCO','nro' => '03', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'SATIPO','nro' => '04', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'LA MERCED(SELVA CENTRAL)','nro' => '05', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'TARMA','nro' => '06', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'TINGO MARIA','nro' => '07', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'HUANCAVELICA','nro' => '08', 'zona_id' => 2,'state_id' => 2],
            ['nombre' => 'AREQUIPA','nro' => '01', 'zona_id' => 3,'state_id' => 2],
            ['nombre' => 'CAMANA','nro' => '02', 'zona_id' => 3,'state_id' => 2],
            ['nombre' => 'CASTILLA_APLAO','nro' => '03', 'zona_id' => 3,'state_id' => 2],
            ['nombre' => 'ISLAY_MOLLENDO','nro' => '04', 'zona_id' => 3,'state_id' => 2],
            ['nombre' => 'HUARAZ','nro' => '01', 'zona_id' => 4,'state_id' => 2],
            ['nombre' => 'CASMA','nro' => '02', 'zona_id' => 4,'state_id' => 2],
            ['nombre' => 'CHIMBOTE','nro' => '03', 'zona_id' => 4,'state_id' => 2],
            ['nombre' => 'PIURA','nro' => '01', 'zona_id' => 5,'state_id' => 2],
            ['nombre' => 'SULLANA','nro' => '02', 'zona_id' => 5,'state_id' => 2],
            ['nombre' => 'TUMBES','nro' => '03', 'zona_id' => 5,'state_id' => 2],
            ['nombre' => 'CUSCO','nro' => '01', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'ABANCAY','nro' => '02', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'MADRE DE DIOS','nro' => '03', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'QUILLABAMBA','nro' => '04', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'SICUANI','nro' => '05', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'ESPINAR','nro' => '06', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'ANDAHUAYLAS','nro' => '07', 'zona_id' => 6,'state_id' => 2],
            ['nombre' => 'TACNA','nro' => '01', 'zona_id' => 7,'state_id' => 2],
            ['nombre' => 'ILO','nro' => '02', 'zona_id' => 7,'state_id' => 2],
            ['nombre' => 'JULIACA','nro' => '03', 'zona_id' => 7,'state_id' => 2],
            ['nombre' => 'MOQUEGUA','nro' => '04', 'zona_id' => 7,'state_id' => 2],
            ['nombre' => 'PUNO','nro' => '05', 'zona_id' => 7,'state_id' => 2],
            ['nombre' => 'TRUJILLO','nro' => '01', 'zona_id' => 8,'state_id' => 2],
            ['nombre' => 'CHEPEN','nro' => '02', 'zona_id' => 8,'state_id' => 2],
            ['nombre' => 'HUAMACHUCO','nro' => '03', 'zona_id' => 8,'state_id' => 2],
            ['nombre' => 'OTUZCO','nro' => '04', 'zona_id' => 8,'state_id' => 2],
            ['nombre' => 'SAN PEDRO','nro' => '05', 'zona_id' => 8,'state_id' => 2],
            ['nombre' => 'MAYNAS','nro' => '01', 'zona_id' => 9,'state_id' => 2],
            ['nombre' => 'ICA','nro' => '01', 'zona_id' => 10,'state_id' => 2],
            ['nombre' => 'CHINCHA','nro' => '02', 'zona_id' => 10,'state_id' => 2],
            ['nombre' => 'PISCO','nro' => '03', 'zona_id' => 10,'state_id' => 2],
            ['nombre' => 'NAZCA','nro' => '04', 'zona_id' => 10,'state_id' => 2],
            ['nombre' => 'CHICLAYO','nro' => '01', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'CAJAMARCA','nro' => '02', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'JAEN','nro' => '03', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'BAGUA','nro' => '04', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'CHACHAPOYAS','nro' => '05', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'CHOTA','nro' => '06', 'zona_id' => 11,'state_id' => 2],
            ['nombre' => 'MOYOBAMBA','nro' => '01', 'zona_id' => 12,'state_id' => 2],
            ['nombre' => 'TARAPOTO','nro' => '02', 'zona_id' => 12,'state_id' => 2],
            ['nombre' => 'JUANJUI','nro' => '03', 'zona_id' => 12,'state_id' => 2],
            ['nombre' => 'YURIMAGUAS','nro' => '04', 'zona_id' => 12,'state_id' => 2],
            ['nombre' => 'PUCALLPA','nro' => '01', 'zona_id' => 13,'state_id' => 2],
            ['nombre' => 'AYACUCHO','nro' => '01', 'zona_id' => 14,'state_id' => 2],
            ['nombre' => 'HUANTA','nro' => '02', 'zona_id' => 14,'state_id' => 2],

        ]);
    }
}
