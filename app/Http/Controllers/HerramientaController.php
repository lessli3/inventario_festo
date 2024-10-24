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
    public function handlePost(Request $request, $id = null)
    {
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
            ]);

            // Subir la imagen del post si existe
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $validatedData['image_url'] = basename($imagePath);
            }

            // Marcar el post como activo y guardarlo en la base de datos
            $validatedData['active'] = true;
            Herramienta::create($validatedData);

            return redirect()->route('posts.index')->with('success', 'Post creado exitosamente');
        }

        // Si es una solicitud DELETE, eliminamos el post correspondiente
        if ($request->isMethod('delete') && $id) {
            $post = Herramienta::findOrFail($id);
            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Post eliminado exitosamente');
        }

        // Si no es una acción válida, redirigir con un mensaje de error
        return redirect()->route('posts.index')->with('error', 'Acción no válida');
    }

    public function handlePost2()
    {

            $posts = Herramienta::orderBy('id')->get();

            return view('posts.index', compact('posts'));

    }

    public function adjustarStock(Herramienta $post, $action)
    {
        if ($action == 'increase') {
            $post->stock++;
        } elseif ($action == 'decrease' && $post->stock > 0) {
            $post->stock--;
        }
        $post->save();

        return redirect()->back();
    }
}
