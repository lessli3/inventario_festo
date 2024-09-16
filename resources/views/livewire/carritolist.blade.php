<div class="min-h-screen pt-3">
  <h1 class="mb-10 text-center text-2xl font-bold" style="color: green">Herramientas para Solicitud <i class="fas fa-clipboard-check"></i></h1>
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
          <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start" style="min-height: 150px; max-height: 160px" wire:key="item{{ $item->id }}">
            @if($item->herramienta)
              <img src="imagenes/herramientas/{{$item->herramienta->imagen}}" alt="product-image" class="w-40 h-25 object-cover rounded-lg sm:w-40 d-block mx-auto mb-4 xs:mx-auto" />
              <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between sm:items-center">
                <div>
                  <h2 class="text-lg font-bold text-gray-900 text-center">{{$item->herramienta->nombre}}</h2>
                  <p class="mt-1 text-xs text-gray-700 text-center ms-4" style="font-size: 18px">{{$item->herramienta->descripcion}}</p>
                  <p class="mt-1 text-xs text-center ms-2 mt-3" style="font-size: 15px; color:gray;">Stock Disponible: {{$item->herramienta->stock}}</p>
                </div>
                <div class="mt-4 flex flex-col items-center sm:space-y-6 sm:mt-0 sm:flex sm:flex-row sm:items-center sm:space-x-6">
                  <div class="flex items-center gap-1 border-gray-100">
                    <button class="w-7 h-7 rounded-full border border-gray-300 cursor-pointer" wire:click="decrementCant({{ $item->id }})">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                      </svg>
                    </button>
                    <input type="text" readonly="readonly" value="{{$item->cantidad}}" class="w-9 h-9 text-center text-gray-900 text-sm outline-none border border-gray-300 rounded-sm">
                    <button class="w-7 h-7 rounded-full border border-gray-300 cursor-pointer" 
                            wire:click="incrementCant({{ $item->id }})"
                            @if($item->cantidad >= $item->herramienta->stock) disabled @endif>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 5v14M5 12h14" />
                      </svg>
                    </button>
                  </div>
                  <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 cursor-pointer mb-2  duration-150 hover:text-red-500" wire:click="eliminarItem({{ $item->id }})">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </div>
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
      @endif
    </div>
  </div>
</div>
