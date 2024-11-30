<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Categoria;
use App\Models\Solicitud;
use App\Models\DetalleSolicitud;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HerramientaController extends Controller
{
    /**
     * Muestra una lista de todas las herramientas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Iniciar una consulta básica a la tabla de herramientas
        $query = Herramienta::query();
        // Obtener todas las herramientas activas
        $herramientaCont = Herramienta::where('estado', 'activo')->get();

        // Si se recibe un filtro por categoría, aplicar el filtro en la consulta
        if ($request->has('categoria')) {
            $categorias = $request->input('categoria');
            $query->where('categoria', $categorias);
        }

        // Ejecutar la consulta y obtener las herramientas
        $herramientas = $query->get();
        // Obtener todas las categorías para mostrarlas en la vista
        $categorias = Categoria::all(); 

        // Retornar la vista con las herramientas y las categorías
        return view('herramientas.index', compact('herramientas', 'categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva herramienta.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener al usuario autenticado
        $user = Auth::user();
        $categorias = Categoria::all();
        return view('herramientas.create', compact('categorias'));
    }

    /**
     * Almacena una nueva herramienta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Crear una nueva instancia de la herramienta
        $newHerramienta = new Herramienta();
        // Manejar las imágenes que el usuario sube
        $imagen = $request->file('imagen');
        $imagencode = $request->file('imagencode');
        // Asignar nombres únicos a las imágenes
        $nombreimg = time().'.'.$imagen->getClientOriginalExtension();
        $nombreimgcode = time().'.'.$imagencode->getClientOriginalExtension();

        // Definir las rutas de almacenamiento para las imágenes
        $destino = public_path('imagenes/herramientas');
        $destinocode = public_path('imagenes/codeb');
        // Mover las imágenes a las carpetas correspondientes
        $request->imagencode->move($destinocode, $nombreimgcode);
        $request->imagen->move($destino, $nombreimg);

        // Asignar los valores recibidos a los atributos del modelo
        $newHerramienta->imagen = $nombreimg;
        $newHerramienta->imagencode = $nombreimgcode;
        $newHerramienta->cod_herramienta = $request->get('cod_herramienta');
        $newHerramienta->nombre = $request->get('nombre');
        $newHerramienta->descripcion = $request->get('descripcion');
        $newHerramienta->stock = $request->get('stock');
        $newHerramienta->organizador = $request->get('organizador');
        $newHerramienta->cajon = $request->get('cajon');
        $newHerramienta->estado = $request->get('estado');
        $newHerramienta->categoria = $request->get('categoria');
        

        // Guardar la nueva herramienta en la base de datos
        $newHerramienta->save();

        // Redirigir a la lista de herramientas
        return redirect('/herramientas');
    }

    /**
     * Muestra el formulario para editar una herramienta específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Encontrar la herramienta a editar
        $herramientaEditar = Herramienta::findOrFail($id);
        // Obtener todas las categorías
        $categorias = Categoria::all();
        // Retornar la vista de edición, pasando la herramienta y las categorías a la vista
        return view('herramientas.edit', [
            'herramientaEditar' => $herramientaEditar,
            'categorias' => $categorias
        ]);
    }

    /**
     * Actualiza una herramienta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Encontrar la herramienta que se va a actualizar
        $editarherramienta = Herramienta::findOrFail($id);

        // Actualizar los campos de la herramienta
        $editarherramienta->nombre = $request->get('nombreEdit');
        $editarherramienta->cod_herramienta = $request->get('codigoEdit');
        $editarherramienta->estado = $request->get('estadoEdit');
        $editarherramienta->descripcion = $request->get('descripEdit');
        $editarherramienta->stock = $request->get('stockEdit');
        $editarherramienta->organizador = $request->get('organizadorEdit');
        $editarherramienta->cajon = $request->get('cajonEdit');
        $editarherramienta->categoria = $request->get('categoriaEdit');

        // Verificar si se ha subido una nueva imagen y reemplazarla
        if ($request->hasFile('imagen')) {
            if ($editarherramienta->imagen) {
                $rutaImagenActual = public_path('imagenes/herramientas/' . $editarherramienta->imagen);
                if (file_exists($rutaImagenActual)) {
                    unlink($rutaImagenActual); // Eliminar la imagen actual
                }
            }
    
            // Guardar la nueva imagen
            $imagen = $request->file('imagen');
            $nombreimg = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('imagenes/herramientas');
            $imagen->move($destino, $nombreimg);

            $editarherramienta->imagen = $nombreimg;
        }

        // Verificar si se ha subido un nuevo código QR y reemplazarlo
        if ($request->hasFile('imagencode')) {
            if ($editarherramienta->imagencode) {
                $rutaImagenActualCode = public_path('imagenes/codeb/' . $editarherramienta->imagencode);
                if (file_exists($rutaImagenActualCode)) {
                    unlink($rutaImagenActualCode); // Eliminar el código actual
                }
            }
    
            // Guardar el nuevo código QR
            $imagencode = $request->file('imagencode');
            $nombreimgcode = time() . '.' . $imagencode->getClientOriginalExtension();
            $destinocode = public_path('imagenes/codeb');
            $imagencode->move($destinocode, $nombreimgcode);

            $editarherramienta->imagencode = $nombreimgcode;
        }

        // Guardar los cambios en la base de datos
        $editarherramienta->save();

        // Redirigir a la lista de herramientas
        return redirect('/herramientas');
    }

    /**
     * Elimina una herramienta de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Maneja las solicitudes relacionadas con los posts (publicaciones).
     * Puede mostrar, crear o eliminar publicaciones.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|null  $id
     * @return \Illuminate\Http\Response
     */
    public function inventario(Request $request)
    {
        // Obtener todas las herramientas sin filtros iniciales
        $query = Herramienta::query();
        
        // Aplica los filtros solo si están presentes en la solicitud
        if ($request->has('categoria') && $request->input('categoria') !== '') {
            $query->where('categoria', $request->input('categoria'));
        }
        
        if ($request->has('organizador') && in_array($request->input('organizador'), [1, 2])) {
            $query->where('organizador', $request->input('organizador'));
        }
        
        if ($request->has('cajon') && in_array($request->input('cajon'), [1, 2, 3, 4, 5, 6])) {
            $query->where('cajon', $request->input('cajon'));
        }
        
        // Ordenar las herramientas por stock si se solicita
        if ($request->has('ordenar')) {
            if ($request->input('ordenar') === 'asc') {
                $query->orderBy('stock', 'asc');
            } elseif ($request->input('ordenar') === 'desc') {
                $query->orderBy('stock', 'desc');
            }
        }
        
        // Definir la cantidad de resultados por página
        $porPagina = 10;
    
        // Obtener las herramientas con los filtros aplicados y paginados
        $inventario = $query->paginate($porPagina);  // Usamos paginate aquí
        
        // Obtener la página actual, o por defecto la primera
        $paginaActual = $inventario->currentPage();
        
        // Calcular el total de páginas
        $totalPaginas = $inventario->lastPage();
        
        // Obtener las categorías para los filtros
        $categorias = Categoria::all();
        $categoria = $request->input('categoria');
        $organizador = $request->input('organizador');
        $cajon = $request->input('cajon');
        $ordenar = $request->input('ordenar');
        
        // Recorremos todas las herramientas para contar cuántas han sido aceptadas y entregadas
        foreach ($inventario as $herramienta) {
            // Buscamos los detalles de la solicitud para esta herramienta
            $detallesSolicitud = DetalleSolicitud::where('cod_herramienta', $herramienta->cod_herramienta)
                                                  ->whereIn('proceso', ['aceptada', 'entregada'])
                                                  ->get();
            
            // Inicializamos las cantidades
            $cantidadAceptadas = 0;
            $cantidadEntregadas = 0;
    
            // Recorremos los detalles de la solicitud para contar la cantidad de herramientas aceptadas
            foreach ($detallesSolicitud as $detalle) {
                if ($detalle->proceso == 'aceptada') {
                    $cantidadAceptadas += $detalle->cantidad;  // Sumamos la cantidad aceptada
                }
                if ($detalle->proceso == 'entregada') {
                    $cantidadEntregadas += $detalle->cantidad;  // Sumamos la cantidad entregada
                }
            }
    
            // Asignar las cantidades a la herramienta
            $herramienta->cantidadAceptadas = $cantidadAceptadas;
            $herramienta->cantidadEntregadas = $cantidadEntregadas;
        }
        
        // Retornar los datos a la vista
        return view('inventario.index', compact(
            'inventario', 'totalPaginas', 'paginaActual', 
            'categorias', 'categoria', 'organizador', 'cajon', 'ordenar'
        ));
    }
    
    
    

    public function handlePost(Request $request, $id = null)
    {
        if ($request->isMethod('get')) {
            $inventario = Herramienta::all();
            return view('inventario.index', compact('inventario'));
        // Si es una solicitud GET, mostramos todos los posts
        if ($request->isMethod('get')) {
            $posts = Herramienta::all();
            return view('posts.index', compact('posts'));
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

    public function handlePost2()
    {

            $posts = Herramienta::orderBy('id')->get();

            return view('posts.index', compact('posts'));

    }

}
