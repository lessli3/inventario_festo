<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCodeMail;

class AuthController extends Controller
{
    // Función para verificar el código de usuario
    public function verifyCode(Request $request)
    {
        // Validar que el número de documento es obligatorio y numérico
        $request->validate([
            'document_number' => 'required|numeric',
        ]);

        // Buscar al usuario por su documento de identidad
        $user = User::where('user_identity', $request->document_number)->first();
        
        if (!$user) {
            // Retornar mensaje de error si no se encuentra el usuario
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        try {
            // Generar un código de verificación aleatorio de 6 dígitos
            $verificationCode = rand(100000, 999999);
            
            // Almacenar el código de verificación y el ID del usuario en la sesión
            Session::put('verification_code', $verificationCode);
            Session::put('user_id', $user->id);

            // Enviar el código al correo electrónico del usuario
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            // Retornar respuesta de éxito junto con el correo del usuario
            return response()->json([
                'message' => 'Código de verificación enviado',
                'email' => $user->email
            ]);

        } catch (\Exception $e) {
            // Registrar en el log el error si ocurre durante el envío del correo
            Log::error('Error al enviar el código de verificación: ' . $e->getMessage());
            // Retornar mensaje de error en caso de excepción
            return response()->json(['message' => 'Ocurrió un error. Por favor, intenta nuevamente.'], 500);
        }
    }

    // Función para verificar el código ingresado por el usuario
    public function verifyCodeIng(Request $request)
    {
        // Validar que el código de verificación es obligatorio y numérico
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        // Obtener el código de verificación y el ID de usuario de la sesión
        $sessionCode = Session::get('verification_code');
        $userId = Session::get('user_id');

        // Verificar si no existe el código o el ID de usuario en la sesión
        if (!$sessionCode || !$userId) {
            return response()->json(['message' => 'Código de verificación no válido'], 400);
        }

        // Buscar al usuario por su ID
        $user = User::find($userId);

        if (!$user) {
            // Retornar mensaje si no se encuentra al usuario
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Comparar el código ingresado con el código almacenado en la sesión
        if ($request->verification_code == $sessionCode) {
            // Si el código es correcto, iniciar sesión con el usuario
            Auth::login($user);
            
            // Eliminar el código de verificación y el ID del usuario de la sesión
            Session::forget('verification_code');
            Session::forget('user_id');

            // Retornar mensaje de éxito
            return response()->json(['message' => 'Código de verificación válido']);
        } else {
            // Retornar mensaje de error si el código es incorrecto
            return response()->json(['message' => 'Código de verificación incorrecto'], 400);
        }
    }
}
