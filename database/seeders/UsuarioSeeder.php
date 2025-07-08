<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // - - - - - - - ADMINISTRADOR - - - - - - - - - - - 
        $usuario = User::create([
            'name' => 'Admin',
            'apellido_paterno' => 'Paterno Admin',
            'apellido_materno' => 'Materno Admin',
            'dni' => '99999999',
            'persona_id' => '',
            'user_id' => '',
            // 'email' => 'admin@gmail.com',
            'user_name' => 'Admin',
            'password' => bcrypt('123123123'),
        ]);

        $rolAdmin = Role::create(['name' => 'Administrador']);
        $permisosAdmin = Permission::pluck('id', 'id')->all(); // Obtén todos los permisos
        $rolAdmin->syncPermissions($permisosAdmin);
        $usuario->assignRole([$rolAdmin->id]);

        // - - - - - - - FISCALIZADOR - - - - - - - - - - - - 
        // $fiscalizador = User::create([
        //     'name' => 'Fiscalizador PRUEBA',
        //     'apellido_paterno' => 'Paterno Fiscalizador',
        //     'apellido_materno' => 'Materno Fiscalizador',
        //     'dni' => '88888888',
        //     'persona_id' => '',
        //     'user_id' => '',
        //     // 'email' => 'fiscalizador@gmail.com',
        //     'user_name' => 'Fiscalizador',
        //     'password' => bcrypt('123123123'),
        // ]);

        // $rolFiscalizador = Role::create(['name' => 'Fiscalizador']);
        // $rolFiscalizador->syncPermissions(['ver-fiscalizador']); // Asigna solo el permiso específico
        // $fiscalizador->assignRole([$rolFiscalizador->id]);

        // - - - - - - - ADMINISTRADO - - - - - - - - - - - - 
        // $administrado = User::create([
        //     'name' => 'Administrado PRUEBA',
        //     'apellido_paterno' => 'Paterno Fiscalizador',
        //     'apellido_materno' => 'Materno Fiscalizador',
        //     'dni' => '88888888',
        //     'persona_id' => '',
        //     'user_id' => '',
        //     // 'email' => 'fiscalizador@gmail.com',
        //     'user_name' => 'Administrado',
        //     'password' => bcrypt('123123123'),
        // ]);

        // $rolAdministrado = Role::create(['name' => 'Administrado']);
        // $rolAdministrado->syncPermissions(['ver-administrado']); // Asigna solo el permiso específico
        // $administrado->assignRole([$rolAdministrado->id]);
    }
}

