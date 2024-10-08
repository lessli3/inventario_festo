<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\Solicitud;
use App\Models\DetalleSolicitud;
use App\Models\CarritoTools;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $solicitudesAceptadas = Solicitud::with('detalles.herramienta')->get();
        $herramientasDisponibles = Herramienta::all(); // Cargar todas las herramientas
    
        // Filtrar herramientas que ya están en la solicitud
        $herramientasUsadas = $solicitudesAceptadas->flatMap(function($solicitud) {
            return $solicitud->detalles->pluck('herramienta_id');
        });
        
        $herramientasDisponibles = $herramientasDisponibles->whereNotIn('id', $herramientasUsadas); // Excluir herramientas usadas
    
        return view('solicitudes.index', compact('solicitudesAceptadas', 'herramientasDisponibles'));
    }
    

public function calendario()
{
    // Obtener solo las solicitudes con estado pendiente
    $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->get();


    // Pasar las solicitudes pendientes a la vista
    return view('calendario', compact('solicitudesPendientes'));
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

public function agregarHerramienta(Request $request, $solicitudId)
{
    $solicitud = Solicitud::findOrFail($solicitudId);
    $herramientasDisponibles = Herramienta::all();
    
    // Crear un nuevo detalle de solicitud con la herramienta seleccionada
    $detalleSolicitud = new DetalleSolicitud();
    $detalleSolicitud->solicitud_id = $solicitud->id;
    $detalleSolicitud->herramienta_id = $request->input('herramienta_id');
    $detalleSolicitud->cantidad = 1; // Puedes ajustar la cantidad según la lógica
    $detalleSolicitud->estado = 'aceptada'; // Estado por defecto
    
    $detalleSolicitud->save();
    
    return redirect()->back()->with('success', 'Herramienta agregada correctamente.');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
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
    $solicitud->estado = $request->input('estado', 'pendiente'); // Puedes cambiar 'pendiente' por el estado predeterminado que desees.
    $solicitud->save();

    return response()->json(['message' => 'Solicitud actualizada correctamente']);
}


    private function eliminarItemDelCarrito($instructorId)
    {
        CarritoTools::where('user_identity', $instructorId)->delete();
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
