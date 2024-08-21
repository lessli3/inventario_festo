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
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Instructor']);

        Permission::create(['name'=>'solicitarHerramienta'])->syncRoles([$role2]);
        Permission::create(['name'=>'editarHerramienta'])->syncRoles([$role1]);
        Permission::create(['name'=>'eliminarHerramienta'])->syncRoles([$role1]);
        Permission::create(['name'=>'crearHerramienta'])->syncRoles([$role1]);
        Permission::create(['name'=>'verSolicitud'])->syncRoles([$role2]);
        Permission::create(['name'=>'agregarAdministrador'])->syncRoles([$role1]);
        Permission::create(['name'=>'accesoAdministrador'])->syncRoles([$role1]);
        Permission::create(['name'=>'accesoSolicitudes'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'accesoPerfil'])->syncRoles([$role1,$role2]);
    }
}
