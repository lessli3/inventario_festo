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
    public function verifyCode(Request $request)
    {
        $request->validate([
            'document_number' => 'required|numeric',
        ]);

        $user = User::where('identity', $request->document_number)->first();
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        try {
            // Generar un código de verificación
            $verificationCode = rand(100000, 999999);
            
            // Almacenar el código en la sesión
            Session::put('verification_code', $verificationCode);
            Session::put('user_id', $user->id);

            // Enviar el código por correo
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            // Enviar la dirección de correo electrónico en la respuesta
            return response()->json([
                'message' => 'Código de verificación enviado',
                'email' => $user->email
            ]);

            return response()->json(['message' => 'Código de verificación enviado']);
        } catch (\Exception $e) {
            // Registrar el mensaje de error
            Log::error('Error al enviar el código de verificación: ' . $e->getMessage());
            return response()->json(['message' => 'Ocurrió un error. Por favor, intenta nuevamente.'], 500);
        }
    }

    public function verifyCodeIng(Request $request)
{
    $request->validate([
        'verification_code' => 'required|numeric',
    ]);

    $sessionCode = Session::get('verification_code');
    $userId = Session::get('user_id');

    if (!$sessionCode || !$userId) {
        return response()->json(['message' => 'Código de verificación no válido'], 400);
    }

    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    if ($request->verification_code == $sessionCode) {
        $user = User::find($userId);
        if ($user) {
            Auth::login($user);
            // Eliminar el código de verificación de la sesión
            Session::forget('verification_code');
            Session::forget('user_id');

            // Redirigir al dashboard o devolver una respuesta adecuada
            return response()->json(['message' => 'Código de verificación válido']);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 400);
        }
    } else {
        return response()->json(['message' => 'Código de verificación incorrecto'], 400);
    }
}
}
