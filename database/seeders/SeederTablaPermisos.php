<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos = [
            'Usuarios' => [
                'ver-usuario',
                'crear-usuario',
                'editar-usuario',
                'borrar-usuario',
            ],
            'Roles' => [
                'ver-rol',
                'crear-rol',
                'editar-rol',
                'borrar-rol',
            ],
            'Módulos' => [
                'ver-modulo',
                'crear-modulo',
                'editar-modulo',
                'borrar-modulo',
            ],
            // 'Fiscalizador' => [
            //     'ver-fiscalizador',
            // ],
            // 'Administrado' => [
            //     'ver-administrado',
            // ],
        ];

        

        foreach ($modulos as $modulo => $permisos) {
            // Crear el módulo
            $moduleId = DB::table('modules')->insertGetId([
                'name' => $modulo,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);

            // Crear los permisos y asociarlos al módulo
            foreach ($permisos as $permiso) {
                Permission::create([
                    'name' => $permiso,
                    'module_id' => $moduleId,
                ]);
            }
        }
    }
}
