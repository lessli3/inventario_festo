<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;

//Componente para el carrito de herramientas
class Carritolist extends Component
{
    // Método que renderiza la vista de la lista del carrito
    public function render()
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene los items del carrito del usuario autenticado y sus herramientas relacionadas
            $this->solicitudItems = CarritoTools::with('herramienta')
                ->where('user_identity', auth()->user()->user_identity)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            // Si no está autenticado, el carrito queda vacío
            $this->solicitudItems = collect();
        }

        // Retorna la vista para mostrar el carrito
        return view('livewire.carritolist');
    }

    // Método para incrementar la cantidad de una herramienta en el carrito
    public function incrementCant($id)
    {
        // Busca el item del carrito por su ID
        $solicitud = CarritoTools::whereId($id)->first();
        $herramienta = $solicitud->herramienta;

        // Verifica que la cantidad no exceda el stock de la herramienta
        if ($solicitud->cantidad < $herramienta->stock) {
            $solicitud->cantidad++; // Incrementa la cantidad
            $solicitud->save();     // Guarda el cambio en la base de datos
        }
    }

    // Método para decrementar la cantidad de una herramienta en el carrito
    public function decrementCant($id)
    {
        // Busca el item del carrito por su ID
        $solicitud = CarritoTools::whereId($id)->first();
        
        // Verifica que la cantidad sea mayor a 1 antes de restar
        if ($solicitud && $solicitud->cantidad > 1) {
            $solicitud->cantidad -= 1; // Decrementa la cantidad
            $solicitud->save();        // Guarda el cambio en la base de datos
        }
    }
    // Método para eliminar un item del carrito
    public function eliminarItem($id)
    {
        // Busca el item del carrito por su ID
        $solicitud = CarritoTools::whereId($id)->first();

        // Si el item existe, lo elimina
        if ($solicitud) {
            $solicitud->delete(); // Elimina el item del carrito
            $this->emit('updateSolicitudCount'); // Emite un evento para actualizar el conteo del carrito
        }
    }
}

