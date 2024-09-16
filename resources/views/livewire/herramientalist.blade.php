<div class="container">
    @include('layouts.mensaje')
    <div class="row mb-5">
        <h1 class="col-12 text-center fw-bold mt-4">Herramientas</h1>
        
        @can('agregarAdministrador')
        <div class="row mt-5 mb-5 ps-5">
            <div class="col-lg-6 d-flex justify-content-start">
                <div class="me-3">
                    <a href="/herramientas/create" class="btn btn-plus">
                        <i class="fas fa-check me-1"></i> Gestionar Inventario
                    </a>
                </div>
                <div>
                    <a href="/herramientas/create" class="btn btn-plus">
                        <i class="fas fa-plus me-1"></i> Agregar Herramienta
                    </a>
                </div>
            </div>

            <div class="col-lg-3  offset-lg-3 d-flex justify-content-end">
            <select wire:model="categoriaSeleccionada" class="btn btn-outline-success form-select">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>
        @endcan

        @can('solicitarHerramienta')
        <div class="col-3 offset-9 d-flex justify-content-end">
            <select wire:model="categoriaSeleccionada" class="btn btn-outline-success form-select my-4 me-3">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        @endcan

        @if($herramientaCont->isEmpty())
            <p>No hay herramientas disponibles.</p>
        @else
            @foreach($herramientaCont as $herramientaVista)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card herramienta-card" style="background-image: url('{{ asset('imagenes/herramientas/' . $herramientaVista->imagen) }}');">
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

                                <div class="d-flex gap-2 ">
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
                        <h4 class="card-title fw-bold">{{ $herramientaVista->nombre }}</h4>
                        <p class="card-text fw-semibold" style="font-size: 18px">{{ $herramientaVista->descripcion }}</p>

                    </div>
                </div>
            </div>
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
</script>