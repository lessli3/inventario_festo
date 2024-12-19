<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function Roles(Request $request)
{
    $role = $request->input('role', 'Instructor'); // Por defecto mostramos Instructores

    $instructores = User::role($role)->get(); // Filtra por el rol seleccionado

    return view('monitores', compact('instructores', 'role'));
}

    
public function createMonitor(Request $request)
{
    // Verificar si el usuario autenticado tiene el rol de cuentadante
    if (Auth::user()->hasRole('Cuentadante')) {
        // Obtener el usuario a quien se le va a asignar el rol de monitor
        $userToAssign = User::findOrFail($request->input('user_id'));

        // Verificar si el usuario ya es monitor
        if ($userToAssign->hasRole('Monitor')) {
            return redirect()->route('monitores')->with('info', 'El usuario ya es un monitor.');
        }

        // Reemplazar el rol de instructor con el de monitor
        $userToAssign->syncRoles(['Monitor']);  // Esto asegura que solo tendrá el rol de "Monitor"
        
        return redirect()->route('monitores')->with('success', 'El usuario ha sido designado como monitor.');
    } else {
        return redirect()->route('monitores')->with('error', 'No tienes permiso para asignar monitores.');
    }
}

public function convertirInstructor(Request $request)
{
    // Verificar si el usuario autenticado tiene el rol de cuentadante
    if (Auth::user()->hasRole('Cuentadante')) {
        // Obtener el usuario a quien se le va a asignar el rol de instructor
        $userToAssign = User::findOrFail($request->input('user_id'));

        // Verificar si el usuario ya es instructor
        if ($userToAssign->hasRole('Instructor')) {
            return redirect()->route('monitores')->with('info', 'El usuario ya es un instructor.');
        }

        // Reemplazar el rol de monitor con el de instructor
        $userToAssign->syncRoles(['Instructor']);  // Esto asegura que solo tendrá el rol de "Instructor"
        
        return redirect()->route('monitores')->with('success', 'El usuario ha sido designado como instructor.');
    } else {
        return redirect()->route('monitores')->with('error', 'No tienes permiso para designar instructores.');
    }
}

public function mostrarFormularioCrearMonitor()
{
    return view('users.createmonitor');  // Retorna la vista con el formulario.
}


public function crearMonitor(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string|max:15',
            'user_identity' => 'required|string|max:20',
        ]);

        // Crear el nuevo usuario (monitor)
        $monitor = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'user_identity' => $request->user_identity,
        ]);

        // Asignar el rol de "Monitor"
        $monitor->assignRole('Monitor');

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'El monitor ha sido creado exitosamente.');
    }



}
