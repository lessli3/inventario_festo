<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedrole = $this->validator($request->all())->validate();
    
        // Verificar si el correo electrónico ya está registrado
        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json(['errors' => ['email' => 'El correo electrónico ya está registrado.']], 400);
        }
        if (User::where('telefono', $request->input('telefono'))->exists()) {
            return response()->json(['errors' => ['telefono' => 'El teléfono ya está registrado.']], 400);
        }
    
        // Verificar si el documento de identificación ya está registrado
        if (User::where('user_identity', $request->input('user_identity'))->exists()) {
            return response()->json(['errors' => ['user_identity' => 'El documento de identificación ya está registrado.']], 400);
        }
    
        try {
            $user = $this->create($request->all());
    
            auth()->login($user);
    
            // Redirigir a la página principal con un mensaje de éxito
            return response()->json(['success' => true, 'message' => '¡Usuario registrado!']);
        } catch (\Exception $e) {
            // Devolver una respuesta JSON con un mensaje de error en caso de excepción
            return response()->json(['success' => false, 'message' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }

    
    

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_identity' => ['required', 'integer'],
            'telefono' => ['required', 'integer'],

        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
            'telefono.unique' => 'El teléfono ya está registrado.',
            'user_identity.unique' => 'El documento de identificación ya está registrado.',
            'name.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'user_identity.required' => 'El documento de identificación es obligatorio.',
        ]);
    }

    protected function create(array $data)
    {
        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_identity' => $data['user_identity'],
            'telefono' => $data['telefono'],
        ]);

        // Asigna el rol de instructor
        $instructorRole = Role::where('name', 'Instructor')->first();
        if ($instructorRole) {
            $user->assignRole($instructorRole);
        }

        return $user;
    }
}
