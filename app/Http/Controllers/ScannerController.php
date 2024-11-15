<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\CodEscaneado;
use App\Models\Herramienta;
use Illuminate\Support\Facades\DB;

class ScannerController extends Controller
{
// Ejemplo de tu controlador en Laravel
public function scanBarcode(Request $request)
{
    // Obtener el código de barras del request
    $barcode = $request->input('barcode');

    // Buscar la herramienta en la base de datos
    $herramienta = Herramienta::where('cod_herramienta', $barcode)->first();

    if ($herramienta) {
        // Si se encuentra la herramienta, emitir el evento y devolver la respuesta
        return response()->json([
            'status' => 'success',
            'barcode' => (string)$barcode,  // Convertir el código de barras a string explícitamente
            'nombre' => $herramienta->nombre,
            'descripcion' => $herramienta->descripcion
        ]);
    } else {
        // Si no se encuentra la herramienta
        return response()->json([
            'status' => 'error',
            'message' => 'Código no encontrado'
        ]);
    }
}

    
    
    
    private function getDetailsByBarcode($barcode)
    {
        // Asegurarse de que $barcode sea tratado como una cadena
        $barcode = strval($barcode);
    
        // Buscar la herramienta por el código de barras
        $herramienta = DB::table('herramientas')->where('cod_herramienta', $barcode)->first();
    
        if ($herramienta) {
            return [
                'nombre' => $herramienta->nombre,
                'descripcion' => $herramienta->descripcion,
            ];
        } else {
            return 'Código no encontrado';
        }
    }
    
    
}
