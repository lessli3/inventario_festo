<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;

class Carritolist extends Component
{
    public function render()
{
    if (Auth::check()) {
        $this->solicitudItems = CarritoTools::with('herramienta') 
            ->where('user_identity', auth()->user()->user_identity)
            ->orderBy('id', 'asc')
            ->get();
    } else {
        $this->solicitudItems = collect(); // Solicitud vacía si el usuario no está autenticado
    }
    return view('livewire.carritolist');
}

    
    
public function incrementCant($id)
{
    $solicitud = CarritoTools::whereId($id)->first();
    $herramienta = $solicitud->herramienta;
    
    if ($solicitud->cantidad < $herramienta->stock) {
        $solicitud->cantidad++;
        $solicitud->save();
    }
}
    
    public function decrementCant($id){
        $solicitud = CarritoTools::whereId($id)->first();
        if($solicitud && $solicitud->cantidad > 1){
            $solicitud->cantidad -= 1;
            $solicitud->save();
        }
    }
    
    public function eliminarItem($id){
        $solicitud = CarritoTools::whereId($id)->first();
        if($solicitud){
            $solicitud->delete();
            $this->emit('updateSolicitudCount');
        }
    }
}
