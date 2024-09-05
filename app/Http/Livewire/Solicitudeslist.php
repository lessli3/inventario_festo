<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SolicitudTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;


class Solicitudeslist extends Component
{
    public $solicitudItems;

    public function render()
    {
        if (Auth::check()) {
            $this->solicitudItems = SolicitudTools::with(['herramienta'])
                ->where('user_identity', auth()->user()->id)
                ->get();
                
        } else {
            $this->solicitudItems = collect(); // Solicitud vacía si el usuario no está autenticado
        }
        return view('livewire.solicitudeslist');
    }

    public function incrementCant($id){
        $solicitud = SolicitudTools::whereId($id)->first();
        if ($solicitud) {
            $solicitud->cantidad += 1;
            $solicitud->save();
        }
    }
    
    public function decrementCant($id){
        $solicitud = SolicitudTools::whereId($id)->first();
        if($solicitud && $solicitud->cantidad > 1){
            $solicitud->cantidad -= 1;
            $solicitud->save();
        }
    }
    
    public function eliminarItem($id){
        $solicitud = SolicitudTools::whereId($id)->first();
        if($solicitud){
            $solicitud->delete();
            $this->emit('updateSolicitudCount');
        }
    }
    
}
