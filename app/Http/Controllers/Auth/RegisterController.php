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
    // Función principal que maneja el registro de un nuevo usuario
    public function register(Request $request)
    {
        // Valida los datos del formulario de registro
        $validatedrole = $this->validator($request->all())->validate();
    
        // Verificar si el correo electrónico ya está registrado
        if (User::where('email', $request->input('email'))->exists()) {
            // Retorna un mensaje de error si el correo ya existe
            return response()->json(['errors' => ['email' => 'El correo electrónico ya está registrado.']], 400);
        }
        // Verificar si el teléfono ya está registrado
        if (User::where('telefono', $request->input('telefono'))->exists()) {
            // Retorna un mensaje de error si el teléfono ya existe
            return response()->json(['errors' => ['telefono' => 'El teléfono ya está registrado.']], 400);
        }
    
        // Verificar si el documento de identificación ya está registrado
        if (User::where('user_identity', $request->input('user_identity'))->exists()) {
            // Retorna un mensaje de error si el documento ya existe
            return response()->json(['errors' => ['user_identity' => 'El documento de identificación ya está registrado.']], 400);
        }
    
        try {
            // Crear el usuario con los datos proporcionados
            $user = $this->create($request->all());
    
            // Iniciar sesión automáticamente después de registrar al usuario
            auth()->login($user);
    
            // Responder con éxito si el usuario se registra correctamente
            return response()->json(['success' => true, 'message' => '¡Usuario registrado!']);
        } catch (\Exception $e) {
            // Si ocurre un error, devolver una respuesta con el mensaje del error
            return response()->json(['success' => false, 'message' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }

    // Función que valida los datos del formulario de registro
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],  // Validar que el nombre es requerido, string y de máximo 255 caracteres
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  // Validar que el correo es único, requerido y válido
            'user_identity' => ['required', 'integer'],  // Validar que el documento de identificación es requerido y numérico
            'telefono' => ['required', 'integer'],  // Validar que el teléfono es requerido y numérico
        ], [
            // Mensajes personalizados para cada tipo de validación
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

    // Función que crea un nuevo usuario en la base de datos
    protected function create(array $data)
    {
        // Crear un nuevo registro de usuario con los datos proporcionados
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_identity' => $data['user_identity'],
            'telefono' => $data['telefono'],
        ]);

        // Asigna el rol de "Instructor" al nuevo usuario
        $instructorRole = Role::where('name', 'Instructor')->first();
        if ($instructorRole) {
            $user->assignRole($instructorRole);
        }

        return $user;  // Retorna el usuario recién creado
    }
}

