<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Categoria;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Lógica para mostrar la vista principal con herramientas y categorías
        $herramientas = Herramienta::all(); // Mostrar todas las herramientas inicialmente
        $categorias = Categoria::all();
        return view('home', compact('herramientas', 'categorias'));
    }
    
    public function buscar(Request $request)
    {
        // Lógica para realizar la búsqueda de herramientas sin recargar la página
        $query = Herramienta::query();
    
        if ($request->has('categoria')) {
            $categorias = $request->input('categoria');
            $query->where('categoria', $categorias);
        }
    
        if ($request->has('nombre')) {
            $nombre = $request->input('nombre');
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }
    
        // Obtener las herramientas filtradas
        $herramientas = $query->get();
        $categorias = Categoria::all();
    
        // Si es una solicitud AJAX, retornar los datos como respuesta JSON
        if ($request->ajax()) {
            return response()->json([
                'herramientas' => $herramientas,
                'categorias' => $categorias
            ]);
        }
    
        // Si no es AJAX, redirigir a la página de inicio
        return redirect()->route('home');
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
        //
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
        //
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
}
