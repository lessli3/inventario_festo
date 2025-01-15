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
use Illuminate\Support\Str; 
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudEntregada; 
use App\Mail\SolicitudFinalizada; 



class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = auth()->user();
        
        // Inicializar la consulta para obtener todas las solicitudes con sus detalles
        $solicitudesAceptadas = Solicitud::with('detalles.herramienta');
    
        // Filtrar por rol de monitor, excluyendo las solicitudes pendientes
        if ($user->hasRole('Monitor')) {
            $solicitudesAceptadas->whereNotIn('estado', ['pendiente', 'finalizada']);
        }
        
    
        // Filtrar por número de user_identity si el usuario tiene rol de Instructor
        if ($user->hasRole('Instructor')) {
            $solicitudesAceptadas = $solicitudesAceptadas->where('user_identity', $user->user_identity);
        }
    
        // Filtrar por número de solicitud si se proporciona un número específico
        if ($request->has('solicitud') && $request->input('solicitud') != '') {
            $solicitudNumber = $request->input('solicitud');
            $solicitudesAceptadas = $solicitudesAceptadas->where('user_identity', 'like', '%' . $solicitudNumber . '%');
        }
    
        // Obtener las solicitudes filtradas
        $solicitudesAceptadas = $solicitudesAceptadas->get();
    
        // Comprobar si la colección está vacía después de aplicar los filtros
        // Si no hay solicitudes aceptadas, redirigir con un mensaje de notificación
        if ($solicitudesAceptadas->isEmpty()) {
            return redirect()->route('solicitudes.index')->with('error', 'No hay solicitudes para mostrar.');
        }

        return view('solicitudes.index', compact('solicitudesAceptadas'));
    }
    

    public function calendario()
    {
        // Obtener solo las solicitudes con proceso pendiente
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
        $herramientasAl = Herramienta::inRandomOrder()->take(15)->get();
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
                    'estado'=> 'activa',
                    'proceso' => 'pendiente', // proceso por defecto
                ]);
            }
            $this->eliminarItemDelCarrito(auth()->user()->user_identity);
    
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada con éxito.');
    }

    
    public function actualizarEstado(Request $request, $id)
    {
        $detalleSolicitud = DetalleSolicitud::findOrFail($id);
        $detalleSolicitud->proceso = $request->input('proceso');
        $detalleSolicitud->save();

        return redirect()->route('solicitudes.index');
    }

    public function actualizar(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = $request->input('estado', 'aceptada');
        $solicitud->save();
         // Obtener los detalles de la solicitud (herramientas asociadas)
        $detalles = $solicitud->detalles;

        // Actualizar el estado de cada herramienta asociada a la solicitud
        foreach ($detalles as $detalle) {
            // Aquí asumo que 'estado' es el campo de cada herramienta que quieres actualizar
            $detalle->proceso = 'aceptada';
            $detalle->save();
        }
    
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
    
        return response()->json(['success' => 'Solicitud aceptada correctamente']);
        }

    
    private function eliminarItemDelCarrito($instructorId)
    {
        CarritoTools::where('user_identity', $instructorId)->delete();
    }

    public function agregarHerramienta(Request $request, $solicitudId)
    {
        $solicitud = Solicitud::findOrFail($solicitudId);
        $codHerramienta = $request->input('cod_herramienta');
    
        // Verificación de existencia de la herramienta
        $herramienta = Herramienta::where('cod_herramienta', $codHerramienta)->first();
        if (!$herramienta) {
            return redirect()->route('solicitud.update', ['id' => $solicitudId])
            ->with('error', 'Ocurrió un error al agregar la herramienta.');
        
        }
    
        // Verificación de si la herramienta ya fue agregada
        $detalleExistente = DetalleSolicitud::where('solicitud_id', $solicitud->id)
                                           ->where('cod_herramienta', $codHerramienta)
                                           ->first();
        if ($detalleExistente) {
            return redirect()->route('solicitud.update', ['id' => $solicitudId])
            ->with('error', 'La herramienta ya fue agregada.');

        }
    
        // Si no, agregar la herramienta
        $detalleSolicitud = new DetalleSolicitud();
        $detalleSolicitud->solicitud_id = $solicitud->id;
        $detalleSolicitud->cod_herramienta = $codHerramienta;
        $detalleSolicitud->cantidad = 1;  // Ajustar según necesidad
        $detalleSolicitud->estado = 'activa';  // Estado por defecto
        $detalleSolicitud->proceso = 'aceptada';  // Estado por defecto
        $detalleSolicitud->save();
    
        return redirect()->route('solicitud.update', ['id' => $solicitudId])
                         ->with('success', 'Herramienta agregada exitosamente.');
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
            session()->flash('active_solicitud_id', $solicitudId);
    
        return redirect()->back()->withErrors('No se pudo encontrar la herramienta para eliminar.');
    }
        

    public function confirmacion($solicitudId)
    {
        $solicitudes = Solicitud::where('id', $solicitudId)->get();
        // Obtener las herramientas asociadas a la solicitud
        $herramientas = DetalleSolicitud::with('herramienta')->where('solicitud_id', $solicitudId)->get();
        // Verificar si se obtuvieron herramientas
        if ($herramientas->isEmpty()) {
            return redirect()->route('home')->with('error', 'No se encontraron herramientas para esta solicitud.');
        }

        // Pasar las herramientas a la vista
        return view('confirmacion', compact('herramientas', 'solicitudes'));
    }

    public function recibirH($solicitudId)
    {
        $solicitudes = Solicitud::where('id', $solicitudId)->get();
        $herramientas = DetalleSolicitud::with('herramienta')->where('solicitud_id', $solicitudId)->get();

        return view('recibirH', compact('herramientas', 'solicitudes'));
    }

    // vista archivo
    public function finalizadas(Request $request) {
        $user = auth()->user();
        
        $solicitudesFinalizadas = Solicitud::with('detalles.herramienta')
                                            ->where('estado', 'finalizada');
        $solicitudesFinalizadas = $solicitudesFinalizadas->get();
        
        // Comprobar si la colección está vacía
        if ($solicitudesFinalizadas->isEmpty()) {
            return view('archivo', ['mensaje' => 'No se encontraron solicitudes finalizadas.']);
        }
        
        return view('archivo', compact('solicitudesFinalizadas'));
    }
 

    public function actualizarCantidad(Request $request, $solicitudId, $detalleId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $detalle = DetalleSolicitud::where('solicitud_id', $solicitudId)
                                    ->where('id', $detalleId)
                                    ->firstOrFail();
        $detalle->cantidad = $request->input('cantidad');
        $detalle->save();

        return redirect()->back()->with('success', 'Cantidad actualizada exitosamente.');
    }

    
    public function generarPDF($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Herramientas asociadas a la solicitud
        $herramientas = $solicitud->detalles()->with('herramienta')->get();
        $hora_salida = Carbon::now('America/Bogota');
        $hora_entrega = $hora_salida->copy()->addHours(24);

        $solicitud->hora_salida = $hora_salida->format('Y-m-d H:i:s');
        $solicitud->hora_entrega = $hora_entrega->format('Y-m-d H:i:s');
        $solicitud->estado = 'entregada';
        $solicitud->save();

        foreach ($herramientas as $detalleSolicitud) {
            $detalleSolicitud->proceso = 'entregada';
            $herramienta = Herramienta::where('cod_herramienta', $detalleSolicitud->cod_herramienta)->first();
        
            if ($herramienta && !$herramienta->descontarStock($detalleSolicitud->cantidad)) {
                return redirect()->back()->withErrors([
                    'mensaje' => 'No hay suficiente stock para la herramienta: ' . $herramienta->nombre
                ]);
            }
            $detalleSolicitud->save();
        }
        

        $pdf = PDF::loadView('pdf.solicitud', compact('solicitud', 'herramientas'));

        try {
            Mail::to($solicitud->email)->send(new SolicitudEntregada($solicitud, $pdf));
        } catch (\Exception $e) {
            return redirect()->route('solicitudes.index')
                ->withErrors(['error' => 'Error al enviar el correo: ' . $e->getMessage()]);
        }

        return $pdf->download('solicitud_' . $solicitud->id . '.pdf');
    }

    public function finalizarRecepcion($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->estado = 'finalizada';
        $hora_entrega = Carbon::now('America/Bogota');
        $solicitud->hora_entrega = $hora_entrega->format('Y-m-d H:i:s');
        $solicitud->save();

        // Obtener las herramientas asociadas a la solicitud
        $herramientas = $solicitud->detalles()->with('herramienta')->get();

        try {
            foreach ($herramientas as $detalleSolicitud) {
                $detalleSolicitud->proceso = 'recibida';
                $herramienta = Herramienta::where('cod_herramienta', $detalleSolicitud->cod_herramienta)->first();
            
                if ($herramienta && !$herramienta->agregarStock($detalleSolicitud->cantidad)) {
                    throw new \Exception('No hay suficiente stock para la herramienta: ' . $herramienta->nombre);
                }
                $detalleSolicitud->save();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['mensaje' => $e->getMessage()]);
        }

        // Generar el PDF con los detalles de la solicitud y las herramientas
        $pdf = PDF::loadView('pdf.solicitudfinalizada', compact('solicitud', 'herramientas'));
        
        try{
            Mail::to($solicitud->email)->send(new SolicitudFinalizada($solicitud, $pdf));
        } catch (\Exception $e) {
            return redirect()->route('solicitudes.index')
                ->withErrors(['error' => 'Error al enviar el correo: ' . $e->getMessage()]);
        }

        return $pdf->download('solicitudfinalizada_' . $solicitud->id . '.pdf');
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
        // Encuentra la solicitud por ID
        $solicitud = Solicitud::findOrFail($id);

        $herramientas = Herramienta::query();
    
        // Filtrar herramientas si se ha ingresado un término de búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $herramientas = $herramientas->where('nombre', 'LIKE', '%' . $searchTerm . '%');
        }
    
        // Obtener las herramientas disponibles
        $herramientas = $herramientas->get();

        return view('solicitudes.update', compact('solicitud', 'herramientas'));
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