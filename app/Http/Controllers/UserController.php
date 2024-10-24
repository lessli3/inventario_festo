<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Constructor: Aplica un middleware para asegurarse de que el usuario esté autenticado
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Muestra la lista de usuarios
    public function index()
    {
        // Obtiene el usuario autenticado
        $usuario = Auth::user();
        // Retorna la vista 'users.index' con la información del usuario actual
        return view('users.index', [
            'usuario' => $usuario
        ]);
    }
    // Muestra el formulario para crear un nuevo recurso (aún sin implementación)
    public function create()
    {
        //
    }
    // Almacena un nuevo recurso en la base de datos (aún sin implementación)
    public function store(Request $request)
    {
        //
    }
    // Muestra un recurso específico (aún sin implementación)
    public function show($id)
    {
        //
    }
    // Muestra el formulario para editar un recurso específico
    public function edit($id)
    {
        // Busca el usuario por su ID
        $usuarioEditar = User::findOrFail($id);
        // Retorna la vista 'users.edit' con los datos del usuario a editar
        return view('users.edit', [
            'usuEditar' => $usuarioEditar
        ]);
    }
    // Actualiza un recurso específico en la base de datos
    public function update(Request $request, $id)
    {
        // Busca el usuario por su ID
        $editarUsuario = User::findOrFail($id);

        // Asigna los nuevos valores desde el formulario a los campos del usuario
        $editarUsuario->name = $request->get('nameEdit');
        $editarUsuario->email = $request->get('correoEdit');
        $editarUsuario->telefono = $request->get('telefonoEdit');

        // Guarda los cambios en la base de datos
        $editarUsuario->save();
        // Redirige a la lista de usuarios
        return redirect('/users');
    }
    // Elimina un recurso específico (aún sin implementación)
    public function destroy($id)
    {
        //
    }
}
