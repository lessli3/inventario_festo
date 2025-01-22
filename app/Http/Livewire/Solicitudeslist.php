<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;

//Componente para las solicitudes
class Solicitudeslist extends Component
{
    public $solicitudItems; // Almacena los elementos de la solicitud
    public $search = ''; // Almacena el término de búsqueda
    public $herramientasDisponibles; // Almacena todas las herramientas disponibles

    // Método que se ejecuta al inicializar el componente
    public function mount()
    {
        $this->obtenerHerramientasDisponibles(); // Carga las herramientas disponibles al inicio
    }

    // Método para obtener todas las herramientas disponibles
    public function obtenerHerramientasDisponibles()
    {
        // Obtiene todas las herramientas y las almacena en la propiedad
        $this->herramientasDisponibles = Herramienta::all();
    }

    // Método para filtrar las herramientas basadas en el término de búsqueda
    public function filtrarHerramientas()
    {
        return $this->herramientasDisponibles->filter(function ($herramienta) {
            // Filtra herramientas cuyo nombre contenga el término de búsqueda, sin importar mayúsculas o minúsculas
            return stripos($herramienta->nombre, $this->search) !== false; 
        });
    }

    // Método que renderiza la vista del componente
    public function render()
    {
        return view('livewire.solicitudeslist', [
            // Pasa las herramientas filtradas a la vista
            'herramientasFiltradas' => $this->filtrarHerramientas(),
        ]);
    }
}
