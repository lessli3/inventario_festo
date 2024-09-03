<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Importa la clase Role
use Spatie\Permission\Models\Permission; // Importa la clase Permission
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        // Obtener los roles
        $instructorRole = Role::where('name', 'Instructor')->first();
        $adminRole = Role::where('name', 'Administrador')->first();

        // Crear usuarios y asignarles roles
        $user1 = User::firstOrCreate([
            'name' => 'Angie',
            'email' => 'angie@gmail.com',
            'identity' => '123456789' 
        ]);
        $user1->assignRole($instructorRole);

        $user2 = User::firstOrCreate([
            'name' => 'Salome',
            'email' => 'salome26u.u@gmail.com',
            'identity' => '1070386098' 
        ]);
        $user2->assignRole($adminRole);
    }
}
