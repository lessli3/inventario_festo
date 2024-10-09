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
        $role1 = Role::firstOrCreate(['name' => 'Cuentadante']);
        $role2 = Role::firstOrCreate(['name' => 'Instructor']);
        $role3 = Role::firstOrCreate(['name' => 'Monitor']);


        //Cuentadante
        Permission::firstOrCreate(['name'=>'editarHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'crearHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'eliminarHerramienta'])->syncRoles([$role1]);
        Permission::firstOrCreate(['name'=>'agregarMonitor'])->syncRoles([$role1]);

        //Instructor
        Permission::firstOrCreate(['name'=>'solicitarHerramienta'])->syncRoles([$role2]);

        //Monitor
        Permission::firstOrCreate(['name'=>'editarSolicitud'])->syncRoles([$role3]);

        /*Permission::firstOrCreate(['name'=>'accesoCuentadante'])->syncRoles([$role1]);*/
        Permission::firstOrCreate(['name'=>'verSolicitud'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name'=>'accesoPerfil'])->syncRoles([$role1,$role2, $role3]);
    }
}
