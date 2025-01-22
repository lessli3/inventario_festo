<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Importa la clase Role
use Spatie\Permission\Models\Permission; // Importa la clase Permission
use App\Models\User;

//Seeder para usuarios por defecto
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
        $cuentadanteRole = Role::where('name', 'Cuentadante')->first();
        $monitorRole = Role::where('name', 'Monitor')->first();

        // Crear usuarios y asignarles roles
        $user1 = User::firstOrCreate([
            'name' => 'Orlando',
            'lastname' => 'Castro',
            'email' => 'orlandocastro@gmail.com',
            'user_identity' => '1023456789',
            'telefono' => '312548648',
            'user_estado' => 'activo' 
        ]);
        $user1->assignRole($instructorRole);

        $user2 = User::firstOrCreate([
            'name' => 'Salome',
            'lastname' => 'Lievano',
            'email' => 'salome26u.u@gmail.com',
            'user_identity' => '1070386098',
            'telefono' => '3043035695',
            'user_estado' => 'activo'  
        ]);
        $user2->assignRole($cuentadanteRole);

        $user3 = User::firstOrCreate([
            'name' => 'Lesly',
            'lastname' => 'Lievano',
            'email' => 'lesly@gmail.com',
            'user_identity' => '1070386099',
            'telefono' => '3102511208',
            'user_estado' => 'activo'  
        ]);
        $user3->assignRole($monitorRole);
    }
}
