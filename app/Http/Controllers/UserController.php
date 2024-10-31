<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index()
    {
        $usuario = Auth::user();
        return view('users.index', [
            'usuario' => $usuario
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarioEditar = User::findOrFail($id);
        return view('users.edit', [
            'usuEditar' => $usuarioEditar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editarUsuario = User::findOrFail($id);

        $editarUsuario -> name = $request-> get('nameEdit');
        $editarUsuario -> email = $request-> get('correoEdit');
        $editarUsuario -> telefono = $request-> get('telefonoEdit');


        $editarUsuario -> save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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



}
