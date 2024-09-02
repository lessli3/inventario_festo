<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usa firstOrCreate para evitar crear roles duplicados
        $role1 = Role::firstOrCreate(['name' => 'Administrador']);
        $role2 = Role::firstOrCreate(['name' => 'Instructor']);

        Permission::firstOrCreate(['name'=>'editarHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'eliminarHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'crearHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'agregarAdministrador'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'editarSolicitud'])->syncRoles([$role1]);
        /*Permission::firstOrCreate(['name'=>'accesoAdministrador'])->syncRoles([$role1]);*/
        Permission::firstOrCreate(['name'=>'solicitarHerramienta'])->syncRoles([$role2]);
        Permission::firstOrCreate(['name'=>'verSolicitud'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name'=>'accesoPerfil'])->syncRoles([$role1,$role2]);
    }
}
