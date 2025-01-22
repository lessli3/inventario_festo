<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;

//Componente para el contador (simbolo) de solicitudes
class SolicitudContador extends Component
{
    // Escucha el evento 'updateSolicitudCount' y llama al método 'obtenerSolicitudCount'
    protected $listeners = ['updateSolicitudCount' => 'obtenerSolicitudCount'];

        public $total;
    // Método que se ejecuta para renderizar la vista
    public function render()
    {
        $this->obtenerSolicitudCount(); // Actualiza el conteo de solicitudes

        return view('livewire.solicitud-contador'); // Devuelve la vista del contador
    }

    // Método para obtener el conteo de elementos en el carrito
    public function obtenerSolicitudCount()
    {
        // Verifica si el usuario está autenticado
        if(auth()->check()) {
            // Cuenta cuántas herramientas tiene el usuario en su carrito
            $this->total = CarritoTools::where('user_identity', auth()->user()->user_identity)->count();
        } else {
            $this->total = 0; // Si no está autenticado, el conteo es 0
        }
    }
}

