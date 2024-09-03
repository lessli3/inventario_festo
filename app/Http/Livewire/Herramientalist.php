<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Herramienta;
use App\Models\Categoria;

class Herramientalist extends Component
{
    public $herramientaCont;
    public $search = '';
    public $herramientas;
    public $categorias;
    public $categoriaSeleccionada = '';
    public $sinResultados = '';

    public function render()
{
    // Iniciar la consulta base para Herramienta
    $query = Herramienta::query();

    // Aplicar filtros según sea necesario (por ejemplo, categoría, búsqueda)
    if (!empty($this->categoriaSeleccionada)) {
        $query->where('categoria_id', $this->categoriaSeleccionada);
    }

    if (!empty($this->search)) {
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
}