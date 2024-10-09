<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Herramienta;
use App\Models\CarritoTools;
use App\Models\Categoria;

class Herramientalist extends Component
{
    public $herramientaCont;
    public $search = '';
    public $categorias;
    public $categoriaSeleccionada = '';
    public $sinResultados = '';
    public $mostrarInactivas = false; // Variable para controlar si se muestran herramientas inactivas


public function render()
{
    // Iniciar la consulta base para Herramienta
    $query = Herramienta::query();

    // Filtrar herramientas según la opción seleccionada
    if ($this->categoriaSeleccionada === 'inactivas') {
        $query->where('estado', 'inactivo');
    } elseif ($this->categoriaSeleccionada === 'activas') {
        $query->where('estado', 'activo');
    } elseif (!empty($this->categoriaSeleccionada)) {
        // Filtrar por categoría si se selecciona una
        $query->where('categoria', $this->categoriaSeleccionada);
    }

    // Si se deben mostrar herramientas inactivas
    if ($this->mostrarInactivas) {
        $query->orWhere('estado', 'inactivo');
    } else {
        $query->where('estado', 'activo');
    }

    if (!empty($this->search)) {
        // Filtrar por búsqueda si es necesario
        $query->where('nombre', 'like', '%' . $this->search . '%');
    }

    // Obtener las herramientas según la consulta
    $this->herramientaCont = $query->get();

    // Verificar si hay resultados después de la búsqueda
    if ($this->herramientaCont->isEmpty() && !empty($this->search)) {
        $this->sinResultados = 'No se encontraron coincidencias.';
        $this->dispatchBrowserEvent('show-no-results-alert');
    } else {
        $this->sinResultados = '';
    }

    // Obtener todas las categorías
    $this->categorias = Categoria::all();

    // Devolver la vista con las variables necesarias
    return view('livewire.herramientalist', [
        'herramientas' => $this->herramientaCont,
        'categorias' => $this->categorias,
    ]);
}

public function toggleHerramientasInactivas()
{
    $this->mostrarInactivas = !$this->mostrarInactivas;
    $this->render(); // Volver a renderizar para aplicar el cambio
}
    


public function agregarSolicitud($cod_herramienta)
{
    if (auth()->user()) {
        // Verificar si el código de la herramienta existe en la tabla herramientas
        $herramientaExistente = Herramienta::where('cod_herramienta', $cod_herramienta)->exists();
        if (!$herramientaExistente) {
            session()->flash('error', 'El código de herramienta "' . $cod_herramienta . '" no existe.');
            return;
        }

        // Define los datos que deseas insertar
        $data = [
            'user_identity' => auth()->user()->user_identity,
            'cod_herramienta' => $cod_herramienta,
        ];

        // Busca un registro existente con el mismo user_identity y cod_herramienta
        $solicitudItem = CarritoTools::where('user_identity', $data['user_identity'])
            ->where('cod_herramienta', $data['cod_herramienta'])
            ->first();

        if ($solicitudItem) {
            session()->flash('error', 'Esta herramienta ya se encuentra en la solicitud.');
        } else {
            CarritoTools::create($data);
            $this->emit('updateCartCount');
            session()->flash('success', 'Herramienta agregada a la solicitud exitosamente.');
        }
    }
}
}

