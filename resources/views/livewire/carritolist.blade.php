
<div class="min-h-screen">
  <h1 class="text-center mb-5 fw-bold" style="font-size: 28px">HERRAMIENTAS PARA SOLICITUD</h1>
  <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
    <div class="rounded-lg md:w-2/3">
      @if($solicitudItems->isEmpty())
        <div class="max-w-lg mx-auto">
          <div class="alert alert-success text-center" role="alert">
            No tienes herramientas en tu solicitud.
          </div>
        </div>
      @else
      @foreach($solicitudItems as $item)
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex md:flex lg:flex sm:justify-start md:justify-start lg:justify-start relative" style="min-height: 150px; max-height: 190px" wire:key="item{{ $item->id }}">
          @if($item->herramienta)
            <!-- Imagen -->
            <img src="{{ 
                      filter_var($item->herramienta->imagen, FILTER_VALIDATE_URL) 
                      ? $item->herramienta->imagen 
                      : asset('imagenes/herramientas/' . $item->herramienta->imagen) 
                  }}" 
                  alt="product-image" 
                  class="object-cover rounded-lg mx-auto mb-4" 
                  style="width: 160px; height: 120px;" />

            <!-- Contenido encima de la tarjeta (visible en sm y md) -->
            <div class="card-content absolute inset-0 flex flex-col items-center justify-center text-white">
              <h2 class="text-lg text-center font-bold">{{$item->herramienta->nombre}}</h2>
              <p class="text-md text-center">{{$item->herramienta->descripcion}}</p>
              <p class="text-xs">Stock: {{$item->herramienta->stock}}</p>

              <!-- Botones de cantidad (para sm y md) -->
              <div class="flex items-center gap-2 mt-3 ms-5">
                <button class="w-7 h-7 rounded-full border border-gray-300 bg-white text-gray-900 cursor-pointer" 
                        wire:click="decrementCant({{ $item->id }})">
                  -
                </button>
                <input type="text" readonly="readonly" value="{{$item->cantidad}}" 
                      class="w-9 h-9 text-center text-gray-900 text-sm outline-none border border-gray-300 rounded-sm" style="border-radius: 10px;">
                <button class="w-7 h-7 rounded-full border border-gray-300 bg-white text-gray-900 cursor-pointer" 
                        wire:click="incrementCant({{ $item->id }})"
                        @if($item->cantidad >= $item->herramienta->stock) disabled @endif>
                  +
                </button>
                <div class="flex justify-center items-center ms-4">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 cursor-pointer text-red-500" wire:click="eliminarItem({{ $item->id }})">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Contenido normal (oculto en sm y md, visible solo en lg) -->
            <div class="hidden sm:hidden md:hidden lg:flex lg:ml-4 lg:w-full lg:justify-between lg:items-center">
              <div>
                <h2 class="text-lg font-bold text-gray-900">{{$item->herramienta->nombre}}</h2>
                <p class="mt-1 text-md text-gray-700">{{$item->herramienta->descripcion}}</p>
                <p class="mt-1 text-sm mt-3" style="color:gray;">Stock Disponible: {{$item->herramienta->stock}}</p>
              </div>
              <!-- Botones de cantidad (para lg) -->
              <div class="flex items-center gap-2">
                <button class="w-7 h-7 rounded-full border border-gray-300 text-gray-900 cursor-pointer" 
                        wire:click="decrementCant({{ $item->id }})">
                  -
                </button>
                <input type="text" readonly="readonly" value="{{$item->cantidad}}" 
                      class="w-9 h-9 text-center text-gray-900 text-sm outline-none border border-gray-300 rounded-sm " style="border-radius: 10px;">
                <button class="w-7 h-7 rounded-full border border-gray-300 text-gray-900 cursor-pointer" 
                        wire:click="incrementCant({{ $item->id }})"
                        @if($item->cantidad >= $item->herramienta->stock) disabled @endif>
                  +
                </button>
              </div>

              <!-- Botón de eliminación (visible solo en lg) -->
              <div class="flex items-center space-x-4 mt-2 lg:mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 cursor-pointer text-red-500" wire:click="eliminarItem({{ $item->id }})">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </div>
            </div>
          @endif
        </div>
      @endforeach

      @endif
    </div>
    <!-- Sub total -->
    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
      <h5 class="text-center">¿Desea generar una solicitud con las herramientas seleccionadas?</h5>
      <hr class="my-4" />
      @if(!$solicitudItems->isEmpty())
        <div class="text-center mt-4">
            <a href="{{ route('solicitudes.create', [
                'items' => $solicitudItems,
            ]) }}" class="btn fw-semibold btn-outline-success">Confirmar <i class="fas fa-check"></i></a>
        </div>
        <div class="text-center mt-2">
            <a href="/herramientas" class="btn btn-outline-secondary">Regresar <i class="fas fa-arrow-left"></i></a>
        </div>
      @else
        <div class="text-center mt-4">
            <a href="/herramientas" class="btn fw-semibold btn-outline-success">Agregar Herramientas <i class="fas fa-plus"></i></a>
        </div>
      @endif

    </div>
  </div>
</div>
<style>

  /* General: Ocultar contenido superpuesto por defecto */
  .card-content {
  display: none;
  }

@media (max-width: 677px) {
  .card-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 10px;
    color: white;
    padding-top: 60px !important;
    padding-bottom: 60px !important;
    padding-left: 20px;
    padding-right: 20px;

    z-index: 10;
  }

  .lg\\:flex {
    display: none; /* Ocultar contenido normal en pantallas pequeñas */
  }

  
  .header{
    margin-top: 0 !important;
  }
}
@media (min-width: 677px) and (max-width: 1000px) {
  .card-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 10px;
    color: white;
    padding-top: 60px !important;
    padding-bottom: 60px !important;
    padding-left: 20px;
    padding-right: 20px;

    z-index: 10;
  }

  .lg\\:flex {
    display: none; 
  }

}
</style>
  