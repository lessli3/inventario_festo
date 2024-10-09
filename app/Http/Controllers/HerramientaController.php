<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Categoria;
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
        $herramientaCont = Herramienta::where('estado', 'activo')->get();

        if ($request->has('categoria')) {
            $categorias = $request->input('categoria');
            $query->where('categoria', $categorias);
        }

        $herramientas = $query->get();
        $categorias = Categoria::all(); // Obtener categorías

        return view('herramientas.index', compact('herramientas', 'categorias')); // Pasar categorías a la vista
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
        return view('herramientas.create', compact('categorias'));

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
        $imagencode = $request->file('imagencode');
        $nombreimg = time().'.'.$imagen -> getClientOriginalExtension();
        $nombreimgcode = time().'.'.$imagencode -> getClientOriginalExtension();

        $destino = public_path('imagenes/herramientas');
        $destinocode = public_path('imagenes/codeb');
        $request -> imagencode -> move($destinocode,$nombreimgcode);
        $request -> imagen -> move($destino,$nombreimg);

        $newHerramienta -> imagen = $nombreimg;
        $newHerramienta -> imagencode = $nombreimgcode;
        $newHerramienta -> cod_herramienta = $request->get('cod_herramienta');
        $newHerramienta -> nombre = $request->get('nombre');
        $newHerramienta -> descripcion = $request->get('descripcion');
        $newHerramienta -> stock = $request->get('stock');
        $newHerramienta -> estado = $request->get('estado');
        $newHerramienta -> categoria = $request->get('categoria');

        $newHerramienta -> save();

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
            'herramientaEditar' => $herramientaEditar, 
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
        $editarherramienta -> cod_herramienta = $request -> get('codigoEdit');
        $editarherramienta -> estado = $request -> get('estadoEdit');
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
        if ($request->hasFile('imagencode')) {
            if ($editarherramienta->imagencode) {
                $rutaImagenActualCode = public_path('imagenes/codeb/' . $editarherramienta->imagencode);
                if (file_exists($rutaImagenActualCode)) {
                    unlink($rutaImagenActualCode);
                }
            }
    
            $imagencode = $request->file('imagencode');
            $nombreimgcode = time() . '.' . $imagencode->getClientOriginalExtension();
            $destinocode = public_path('imagenes/codeb');
            $imagencode->move($destinocode, $nombreimgcode);
    
            $editarherramienta->imagencode = $nombreimgcode;
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
