@php
use Illuminate\Support\Str;
@endphp


<div class="container">
    <!--@include('layouts.mensaje')--->
    <div class="row mb-5">
        <h2 class="col-12 text-center fw-bold mt-4">HERRAMIENTAS</h2>

        @can('crearHerramienta')
            <div class="row mt-3 mb-4" id="opciones">
                <!-- Botón desplegable (Opciones) -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                    <div class="dropdown">
                        <button class="btn btn-plus dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="/inventario">
                                    <i class="fas fa-check me-1"></i> Gestionar Inventario
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/herramientas/create">
                                    <i class="fas fa-plus"></i> Agregar Herramienta
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Botón Filtros -->
                <div class="col-lg-3 offset-lg-6 col-md-6 col-sm-12">
                    <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle w-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtros
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton2">
                            <!-- Opción de Categoría -->
                            <li>
                                <div class="dropdown-item">
                                    <select wire:model="categoriaSeleccionada" class="form-select w-100">
                                        <option value="">Categorías</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>

                            <!-- Opción Herramientas Activas/Inactivas -->
                            <li>
                                <a class="dropdown-item" href="#" wire:click="toggleHerramientasInactivas">
                                    {{ $mostrarInactivas ? 'Herramientas Activas' : 'Herramientas Inactivas' }}
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        @endcan


        @can('solicitarHerramienta')
        <div class="col-lg-3 col-md-6 offset-md-6 offset-lg-9 d-flex justify-content-end">
            <select wire:model="categoriaSeleccionada" class="btn btn-outline-success form-select my-4 me-3">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        @endcan

        @can('editarSolicitud')
        <div class="row my-4">
            <!-- Botón Inventario a la izquierda -->
            <div class="col-lg-3 col-sm-12 col-md-6 d-flex justify-content-start">
                <a href="/inventario" class="btn btn-outline-success my-2" style="width:100%">
                    <i class="fas fa-list"></i> Inventario
                </a>
            </div>

            <!-- Botón Categorías a la derecha con offset -->
            <div class="col-lg-3 col-sm-12 col-md-6 offset-lg-6 d-flex justify-content-end">
                <select wire:model="categoriaSeleccionada" class="btn btn-outline-success form-select my-2">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endcan

        @if($herramientaCont->isEmpty())
            <p>No hay herramientas disponibles.</p>
        @else

        @foreach($herramientaCont as $herramientaVista)
        @if($herramientaVista->estado == ($mostrarInactivas ? 'inactivo' : 'activo'))
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <!-- Añade la clase 'inactive-tool' si la herramienta está inactiva -->
                <div class="card herramienta-card {{ $herramientaVista->estado == 'inactivo' ? 'inactive-tool' : '' }}" 
                style="background-image: url('{{ Str::startsWith($herramientaVista->imagen, ['http://', 'https://']) ? $herramientaVista->imagen : asset('imagenes/herramientas/' . $herramientaVista->imagen) }}');">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: 25%;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                @if($herramientaVista->stock > 0 && $herramientaVista->stock <= 3)
                                    @can('editarHerramienta')
                                    <p class="badge bg-warning m-0"><strong>¡Quedan {{ $herramientaVista->stock }} unidades!</strong></p>
                                    @endcan
                                @elseif($herramientaVista->stock == 0)
                                    <p class="badge bg-danger m-0"><strong>No hay stock disponible.</strong></p>
                                @endif

                                <div class="d-flex gap-2" style="position: absolute; top: 25px; left: 20px;">
                                    @can('editarHerramienta')
                                    <a href="/herramientas/{{$herramientaVista->id}}/edit" class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    @if($herramientaVista->stock > 0)
                                        @can('solicitarHerramienta')
                                        <button type="button" class="btn btn-success d-flex gap-2" wire:click="agregarSolicitud('{{ $herramientaVista->cod_herramienta }}')">
                                            <i class="fas fa-clipboard-list" style="font-size: 20px"></i>
                                        </button>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title fw-bold ">{{ $herramientaVista->nombre }}</h4>
                        <p class="card-text fw-semibold" style="font-size: 18px display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 3.8em;">{{ $herramientaVista->descripcion }}</p>
                        <p class="card-text fw-bold" style="font-size: 15px">{{ $herramientaVista->stock }} en stock</p>
                    </div>
                </div>
            </div>
        @endif
        @endforeach

        @endif
    </div>

    @if($sinResultados)
    <div class="alert alert-success text-center" role="alert">
        {{ $sinResultados }}
    </div>
    @endif
</div>


<style>
    .discount-badge {
        top: 0;
        left: 0;
        transform: translate(10%, -400%);
    }
</style>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('herramientasActualizados', herramientas => {
            // Actualizar la lista de herramientas en la vista
            document.querySelector('.alert').style.display = 'block';
        });
    });


    document.addEventListener('livewire:load', function () {
    Livewire.on('showError', message => {
        alertify.error('<i class="fas fa-times-circle"></i> ' + message);
    });

    Livewire.on('showSuccess', message => {
        alertify.success('<i class="fas fa-check-circle"></i> ' + message);
    });
});

</script>

<style>
    /* Estilo para las herramientas inactivas */
    .inactive-tool {
        .card-body{
            color: gray; /* Color de fondo gris */
        }
    }

    .header{
        padding-bottom: 15% !important;
    }  
    /* Pantallas pequeñas (móviles) */
@media (max-width: 677px) {
    #cardh{
        margin-top: 10%;
        width: 110% !important;
        max-width: 120% !important;
    }
    .herramienta-card{
        height: 250px !important;
    }

    #opciones{
        padding-left: 40px;
    }
}
/* Pantallas medianas (tablets) */
@media (min-width: 677px) and (max-width: 1000px) {
    .herramienta-card{
        height: 250px !important;
    }

}
</style>
