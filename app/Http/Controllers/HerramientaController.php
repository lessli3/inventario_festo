<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Categoria;
use App\Models\Post;
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

    public function handlePost(Request $request, $id = null)
    {
        if ($request->isMethod('get')) {
            $inventario = Herramienta::all();
            return view('inventario.index', compact('inventario'));
        }

        // Si es una solicitud POST, creamos un nuevo post
        if ($request->isMethod('post')) {
            // Validar los datos del post
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cod_herramienta' => 'required|string|max:255|unique:herramientas,cod_herramienta',
            ]);

            // Subir la imagen del post si existe
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $validatedData['image_url'] = basename($imagePath);
            }

            // Marcar el post como activo y guardarlo en la base de datos
            $validatedData['active'] = true;
            Herramienta::create($validatedData);

            return redirect()->route('inventario.index')->with('success', 'Post creado exitosamente');
        }

        // Si es una solicitud DELETE, eliminamos el post correspondiente
        if ($request->isMethod('delete') && $id) {
            $inventario = Herramienta::findOrFail($id);
            $inventario->delete();

            return redirect()->route('inventario.index')->with('success', 'Post eliminado exitosamente');
        }

        // Si no es una acción válida, redirigir con un mensaje de error
        return redirect()->route('inventario.index')->with('error', 'Acción no válida');
    }

    public function handlePost2()
    {
            $inventario = Herramienta::orderBy('id')->get();
            return view('inventario.index', compact('inventario'));

    }

    public function adjustarStock(Request $request, $id, $action)
{
    // Validar que el cod_herramienta esté presente
    $validatedData = $request->validate([
        'cod_herramienta' => 'required|string',
    ]);

    $herramienta = Herramienta::find($id);

    if ($action == 'increase') {
        $herramienta->stock += 1;
    } elseif ($action == 'decrease') {
        $herramienta->stock -= 1;
    }

    $herramienta->save();
    
    return redirect()->back();
}

    
}
