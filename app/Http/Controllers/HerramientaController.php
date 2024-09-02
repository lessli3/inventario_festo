<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HerramientaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Herramienta::query();

        if ($request->has('categoria')) {
            $categorias = $request->input('categoria');
            $query->where('categoria', $categorias);
        }
    
        $herramientas = $query->get();
        $categorias = Categoria::all();
    
        return view('herramientas.index', compact('herramientas', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categorias = Categoria::all(); 

        return view('herramientas.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newHerramienta = new Herramienta();
        $imagen = $request->file('imagen');
        $nombreimg = time().'.'.$imagen -> getClientOriginalExtension();
        $destino = public_path('imagenes/herramientas');
        $request -> imagen -> move($destino,$nombreimg);

        $newHerramienta -> imagen = $nombreimg;
        $newHerramienta -> nombre = $request->get('nombre');
        $newHerramienta -> descripcion = $request->get('descripcion');
        $newHerramienta -> stock = $request->get('stock');
        $newHerramienta -> categoria = $request->get('categoria');

        $newProduct -> save();

        return redirect('/herramientas');
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
        $herramientaEditar = Herramienta::findOrFail($id);
        $categorias = Categoria::all();
        return view('herramientas.edit', [
            'herramienEditar' => $herramientaEditar,
            'categorias' => $categorias
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
        $editarherramienta = Herramienta::findOrFail($id);

        $editarherramienta -> nombre = $request -> get('nombreEdit');
        $editarherramienta -> descripcion = $request -> get('descripEdit');
        $editarherramienta -> stock = $request -> get('stockEdit');
        $editarherramienta -> categoria = $request -> get('categoriaEdit');

        
        if ($request->hasFile('imagen')) {
            if ($editarherramienta->imagen) {
                $rutaImagenActual = public_path('imagenes/herramientas/' . $editarherramienta->imagen);
                if (file_exists($rutaImagenActual)) {
                    unlink($rutaImagenActual);
                }
            }
    
            $imagen = $request->file('imagen');
            $nombreimg = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('imagenes/herramientas');
            $imagen->move($destino, $nombreimg);
    
            $editarherramienta->imagen = $nombreimg;
        }

        $editarherramienta -> save();

        return redirect('/herramientas');
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
