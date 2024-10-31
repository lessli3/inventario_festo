<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Solicitud;
use App\Models\DetalleSolicitud;
use App\Models\CarritoTools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = auth()->user();
        
        // Obtener todas las solicitudes con sus detalles
        $solicitudesAceptadas = Solicitud::with('detalles.herramienta');
        
        // Filtrar por número de user_identity si está presente
        if ($user->hasRole('Instructor')) {
            $solicitudesAceptadas->where('user_identity', $user->user_identity);
        } 
        
        // Filtrar por número de solicitud
        if ($request->has('solicitud') && $request->input('solicitud') != '') {
            $solicitudNumber = $request->input('solicitud');
            $solicitudesAceptadas->where('user_identity', 'like', '%' . $solicitudNumber . '%');
        }
    
        // Obtener las solicitudes filtradas
        $solicitudesAceptadas = $solicitudesAceptadas->get();
    
        // Comprobar si la colección está vacía después de aplicar los filtros
        if ($solicitudesAceptadas->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron solicitudes que coincidan.']);
        }
    
        // Cargar herramientas disponibles
        $herramientasDisponibles = Herramienta::query();
        
        // Filtrar herramientas si se ha ingresado un término de búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $herramientasDisponibles->where('nombre', 'LIKE', '%' . $searchTerm . '%');
        }
        // Excluir herramientas usadas
        $herramientasDisponibles = $herramientasDisponibles->get();
    
        return view('solicitudes.index', compact('solicitudesAceptadas', 'herramientasDisponibles'));
    }
    

    public function calendario()
    {
        // Obtener solo las solicitudes con estado pendiente
        $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->get();


        // Pasar las solicitudes pendientes a la vista
        return view('calendario', compact('solicitudesPendientes'));
    }

public function dashboard(){
// Podio
$herramientasMasPedidas = DB::table('detalle_solicitudes')
    ->join('herramientas', 'detalle_solicitudes.cod_herramienta', '=', 'herramientas.cod_herramienta')
    ->select('herramientas.*', DB::raw('COUNT(DISTINCT solicitud_id) as total_solicitudes'))
    ->groupBy('herramientas.id')
    ->orderBy('total_solicitudes', 'desc')
    ->take(3) // Puedes ajustar el número de herramientas que quieras mostrar
    ->get();


//Para el carrusel
$herramientasAl = Herramienta::inRandomOrder()->take(8)->get();
//todas las herramientas disponibles
$herramientas = DB::table('herramientas')->get();     
//ID del usuario autenticado
$userId = Auth::user()->user_identity;
// Consultar las herramientas más pedidas por el usuario autenticado
$herramientasMasPedidasUser = DB::table('detalle_solicitudes')
    ->join('solicitudes', 'detalle_solicitudes.solicitud_id', '=', 'solicitudes.id')
    ->select('detalle_solicitudes.cod_herramienta', DB::raw('COUNT(DISTINCT solicitudes.id) as total'))
    ->where('solicitudes.user_identity', $userId) // Filtrar por el usuario autenticado
    ->groupBy('detalle_solicitudes.cod_herramienta')
    ->take(3) // Limitar el número de herramientas más pedidas
    ->get();

//Consultar numero de todas las solicitudes
$solicitudesContador = DB::table('solicitudes')
    ->select('estado', DB::raw('COUNT(*) as total'))
    ->groupBy('estado')
    ->get();
//Herramientas con el stock bajo
$herramientaBajoStock = Herramienta::orderBy('stock', 'asc')->take(5)->get();

    return view('dashboard', compact('herramientasMasPedidas', 'herramientas', 'herramientasAl', 'herramientasMasPedidasUser', 'solicitudesContador', 'herramientaBajoStock'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create(Request $request)
    {
        $solicitudes = Solicitud::all(); // Obtenemos todas las solicitudes
        $user = auth()->user();
        $solicituditems = CarritoTools::where('user_identity', $user->user_identity)->get();

        $solicituditemsArray = [];

        foreach ($solicituditems as $item) {
            $itemArray = [];
            if ($item->herramienta) {                
                $itemArray = [
                    'id' => $item->herramienta->id,
                    'nombre' => $item->herramienta->nombre,
                    'cod_herramienta' => $item->herramienta->cod_herramienta,
                    'cantidad' => $item->cantidad,
                    /*'id_instructor' => $item->herramienta->user_identity,
                ];
            } 
            $solicituditemsArray[] = $itemArray;
        }

        return view('solicitudes.create', compact('solicituditemsArray', 'solicitudes'));
    }*/

    public function create(Request $request)
    {
        $user = auth()->user();
        $solicituditems = CarritoTools::where('user_identity', $user->user_identity)->get();

        $solicituditemsArray = [];

        foreach ($solicituditems as $item) {
            $itemArray = [];
            if ($item->herramienta) {                
                $itemArray = [
                    'id' => $item->herramienta->id,
                    'nombre' => $item->herramienta->nombre,
                    'cod_herramienta' => $item->herramienta->cod_herramienta,
                    'cantidad' => $item->cantidad,
                ];
            } 
            $solicituditemsArray[] = $itemArray;
        }

        // Obtener los códigos de las herramientas en el carrito
        $codigosHerramientas = array_column($solicituditemsArray, 'cod_herramienta');

        // Obtener las solicitudes aceptadas que contienen estas herramientas
        $solicitudesAceptadas = Solicitud::where('estado', 'aceptada')
            ->whereHas('detalles', function($query) use ($codigosHerramientas) {
                $query->whereIn('cod_herramienta', $codigosHerramientas);
            })
            ->with('detalles') // Obtener los detalles de las solicitudes aceptadas
            ->get();

        return view('solicitudes.create', compact('solicituditemsArray', 'solicitudesAceptadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

            // Validar los datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|numeric',
                'email' => 'required|email',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'cod_herramienta.*' => 'required|exists:herramientas,cod_herramienta',
                'cantidad.*' => 'required|integer|min:1',
            ]);
    
            // Crear una nueva solicitud
            $solicitud = Solicitud::create([
                'user_identity' => auth()->user()->user_identity,
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
            ]);
    
            // Crear los detalles de la solicitud
            foreach ($request->cod_herramienta as $index => $codHerramienta) {
                DetalleSolicitud::create([
                    'solicitud_id' => $solicitud->id,
                    'cod_herramienta' => $codHerramienta,
                    'cantidad' => $request->cantidad[$index],
                    'estado' => 'pendiente', // Estado por defecto
                ]);
            }
            $this->eliminarItemDelCarrito(auth()->user()->user_identity);
    
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada con éxito.');
    }

    
    public function actualizarEstado(Request $request, $id)
    {
        $detalleSolicitud = DetalleSolicitud::findOrFail($id);
        $detalleSolicitud->estado = $request->input('estado');
        $detalleSolicitud->save();

        return redirect()->route('solicitudes.index');
    }

    public function actualizar(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = $request->input('estado', 'aceptada');
        $solicitud->save();
    
        // Obtener los códigos de herramienta únicos en los detalles de la solicitud
        $codHerramientasUnicas = $solicitud->detalles->pluck('cod_herramienta')->unique();
    
        // Para cada herramienta única, incrementar el contador de solicitudes
        foreach ($codHerramientasUnicas as $cod_herramienta) {
            $herramienta = Herramienta::where('cod_herramienta', $cod_herramienta)->first();
    
            if ($herramienta) {
                // Incrementar el contador de solicitudes una vez por herramienta única
                $herramienta->solicitudes_count += 1;
                $herramienta->save();
            }
        }
    
        return response()->json(['message' => 'Solicitud actualizada correctamente']);
    }
    
    private function eliminarItemDelCarrito($instructorId)
    {
        CarritoTools::where('user_identity', $instructorId)->delete();
    }

    public function agregarHerramienta(Request $request, $solicitudId) {
        // Encontrar la solicitud
        $solicitud = Solicitud::findOrFail($solicitudId);
        
        // Obtener el código de herramienta del request
        $codHerramienta = $request->input('cod_herramienta');
    
        // Verificar que el cod_herramienta existe en la tabla herramientas
        $herramienta = Herramienta::where('cod_herramienta', $codHerramienta)->first();
    
        if (!$herramienta) {
            return redirect()->back()->withErrors(['cod_herramienta' => 'El código de herramienta no existe en la base de datos.']);
        }
    
        // Eliminar la verificación de existencia previa o la dejamos si se desea manejar reactivación
        $detalleExistente = DetalleSolicitud::where('solicitud_id', $solicitud->id)
            ->where('cod_herramienta', $codHerramienta)
            ->first();
        
        if ($detalleExistente) {
            return redirect()->route('solicitudes.index')->withErrors(['cod_herramienta' => 'La herramienta ya fue agregada a esta solicitud.']);
        } 
    
        // Crear un nuevo detalle de solicitud con la herramienta seleccionada
        $detalleSolicitud = new DetalleSolicitud();
        $detalleSolicitud->solicitud_id = $solicitudId;
        $detalleSolicitud->cod_herramienta = $codHerramienta;
        $detalleSolicitud->cantidad = 1; // Puedes ajustar la cantidad según la lógica
        $detalleSolicitud->estado = 'aceptada'; // Estado por defecto
    
        $detalleSolicitud->save();
    
        return redirect()->route('solicitudes.index')->with('success', 'Herramienta agregada exitosamente.');
    
    }
    
    public function eliminarHerramienta($solicitudId, $codHerramienta) {
        // Buscar el detalle de la solicitud con la herramienta correspondiente
        $detalle = DetalleSolicitud::where('solicitud_id', $solicitudId)
            ->where('cod_herramienta', $codHerramienta)
            ->first();
    
        if ($detalle) {
            // Eliminar el detalle si existe
            $detalle->delete();
            return redirect()->back()->with('success', 'Herramienta eliminada correctamente.');
        }
    
        return redirect()->back()->withErrors('No se pudo encontrar la herramienta para eliminar.');
    }
        
    
    public function verificarCodigo($herramientaId, $codigoBarras)
{
    $herramienta = Herramienta::find($herramientaId);

    if ($herramienta && $herramienta->cod_herramienta == $codigoBarras) {
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
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