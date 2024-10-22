<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;


class Solicitudeslist extends Component
{
    public $solicitudItems;

    public $search = '';
    public $herramientasDisponibles;

    public function mount()
    {
        $this->obtenerHerramientasDisponibles();
    }

    public function obtenerHerramientasDisponibles()
    {
        // Obtener todas las herramientas disponibles
        $this->herramientasDisponibles = Herramienta::all();
    }

    public function filtrarHerramientas()
    {
        return $this->herramientasDisponibles->filter(function ($herramienta) {
            return stripos($herramienta->nombre, $this->search) !== false; // Filtrar por nombre
        });
    }

    public function render()
    {
        return view('livewire.solicitudeslist', [
            'herramientasFiltradas' => $this->filtrarHerramientas(),
        ]);
    }
    
}
