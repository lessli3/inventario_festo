<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Herramienta;
use App\Models\CarritoTools;
use App\Models\Categoria;

class Herramientalist extends Component
{

    public $herramientaCont;         // Contenedor de herramientas
    public $search = '';              // Término de búsqueda
    public $herramientas;             // Lista de herramientas
    public $categorias;               // Lista de categorías
    public $categoriaSeleccionada = ''; // Categoría seleccionada
    public $sinResultados = '';        // Mensaje de sin resultados
    public $mostrarInactivas = false;  // Control para mostrar herramientas inactivas

  // Método que se ejecuta para renderizar la vista
  public function render()
  {
      // Iniciar la consulta base para Herramienta
      $query = Herramienta::query();
  
      // Filtrar herramientas según la opción seleccionada o el estado
      if (!empty($this->categoriaSeleccionada) && $this->categoriaSeleccionada !== 'activas' && $this->categoriaSeleccionada !== 'inactivas') {
          $query->where('categoria', $this->categoriaSeleccionada); // Filtra por categoría
      }
  
      if ($this->mostrarInactivas) {
          $query->where('estado', 'inactivo'); // Solo inactivas
      } else {
          $query->where('estado', 'activo'); // Solo activas
      }
  
      // Obtener las herramientas según la consulta
      $this->herramientaCont = $query->get();
  
      // Verificar si hay resultados después de la búsqueda
      if ($this->herramientaCont->isEmpty() && !empty($this->search)) {
          $this->sinResultados = 'No se encontraron coincidencias'; // Mensaje si no hay resultados
          $this->dispatchBrowserEvent('show-no-results-alert'); // Despacha un evento para mostrar alerta
      } else {
          $this->sinResultados = ''; // Resetea el mensaje si hay resultados
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
    }


    // Método para filtrar herramientas por búsqueda
    public function filtrarPorBusqueda()
    {
        // Filtrar solo por nombre
        $herramientasFiltradas = Herramienta::where('nombre', 'like', '%' . $this->search . '%')->get();

        // Verificar si hay resultados
        if ($herramientasFiltradas->isEmpty()) {
            $this->dispatchBrowserEvent('show-no-results-alert', ['message' => 'No se encontraron coincidencias']); // Mensaje si no hay resultados
        }

        return $herramientasFiltradas; // Devuelve las herramientas filtradas
    }

    // Método para agregar una herramienta a la solicitud
    public function agregarSolicitud($cod_herramienta)
    {
        if (auth()->user()) { // Verifica si el usuario está autenticado
            // Verificar si el código de la herramienta existe en la tabla herramientas
            $herramientaExistente = Herramienta::where('cod_herramienta', $cod_herramienta)->exists();
            // Verifica si ya hay 2 herramientas seleccionadas
            if (!$herramientaExistente) {
                session()->flash('error', 'El código de herramienta "' . $cod_herramienta . '" no existe'); // Mensaje de error
                $this->emit('showError', 'El código de herramienta "' . $cod_herramienta . '" no existe');
                return;
            }
    
            // Verificar cuántas herramientas tiene el usuario en el carrito
            $herramientasEnCarrito = CarritoTools::where('user_identity', auth()->user()->user_identity)->count();
    
            if ($herramientasEnCarrito >= 2) {
                session()->flash('error', 'Solo puedes añadir un máximo de 2 herramientas');
                $this->emit('showError', 'Solo puedes añadir un máximo de 2 herramientas');
                return;
            }
    
            // Define los datos que deseas insertar
            $data = [
                'user_identity' => auth()->user()->user_identity, // Identidad del usuario
                'cod_herramienta' => $cod_herramienta, // Código de la herramienta
            ];
    
            
            // Busca un registro existente con el mismo user_identity y cod_herramienta
            $solicitudItem = CarritoTools::where('user_identity', $data['user_identity'])
                ->where('cod_herramienta', $data['cod_herramienta'])
                ->first();
    
            if ($solicitudItem) {
                session()->flash('error', 'Esta herramienta ya se encuentra en la solicitud'); // Mensaje si ya existe
                $this->emit('showError', 'Esta herramienta ya se encuentra en la solicitud');
            } else {
                CarritoTools::create($data); // Crea un nuevo registro en CarritoTools
                $this->emit('updateSolicitudCount');
                session()->flash('success', 'Herramienta agregada a la solicitud'); // Mensaje de éxito
                $this->emit('showSuccess', 'Herramienta agregada a la solicitud');
            }
        }
    }
    
}
