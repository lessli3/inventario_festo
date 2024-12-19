@extends('layouts.dashboard')
@section('title', 'INVENTARIO DE HERRAMIENTAS')
@section('content')
<h2 class="text-center mb-3 mt-4 mb-4 fw-bold">INVENTARIO DE HERRAMIENTAS</h2>

<div class="row">
    <div class="col-md-3 offset-lg-10 offset-md-9 ">
    <button type="button" class="btn btn-plus fw-bold ms-3" id="limpiarFiltros">
        <a href="/inventario" style="text-decoration: none; color:white;">Limpiar filtros</a></button>
    </div>
</div>
<!-- Contenido de la tabla -->
<div class="table-responsive m-3">
    <table class="table table-striped table-hover mt-3">
    <thead>
    <tr style="border-style: hidden;">
        <th style="padding-bottom: 30px;">CÓDIGO</th>
        <th style="padding-bottom: 30px;">NOMBRE</th>
        <!---<th style="padding-bottom: 30px;">DESCRIPCIÓN</th>--->
        <th style="padding-bottom: 30px;">ESTADO</th>
        <!-- Formulario de filtros -->
        <form method="GET" action="{{ route('inventario.index') }}" id="filtroForm">
            <th style="padding-bottom: 22px;">
                <div class="dropdown">
                    <button class="btn btn-light fw-bold dropdown-toggle" type="button" id="categoriaDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;">
                        CATEGORÍA
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoriaDropdown">
                        @foreach ($categorias as $categoria)
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('categoria{{ $categoria->id }}').checked = true; document.getElementById('filtroForm').submit();">
                                    {{ $categoria->nombre }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @foreach ($categorias as $categoria)
                        <input type="radio" id="categoria{{ $categoria->id }}" name="categoria" value="{{ $categoria->id }}" class="d-none" {{ request('categoria') == $categoria->id ? 'checked' : '' }}>
                    @endforeach
                </div>
            </th>

            <th>
                <div class="dropdown" style="padding-bottom:12px">
                    <button class="btn btn-light dropdown-toggle fw-bold" type="button" id="organizadorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        ESTANTE
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="organizadorDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('organizador1').checked = true; document.getElementById('filtroForm').submit();">
                                Organizador 1
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('organizador2').checked = true; document.getElementById('filtroForm').submit();">
                                Organizador 2
                            </a>
                        </li>
                    </ul>
                </div>
                <input type="radio" id="organizador1" name="organizador" value="1" class="d-none" {{ request('organizador') == '1' ? 'checked' : '' }}>
                <input type="radio" id="organizador2" name="organizador" value="2" class="d-none" {{ request('organizador') == '2' ? 'checked' : '' }}>
            </th>

            <th>
                <div class="dropdown" style="padding-bottom:12px">
                    <button class="btn btn-light dropdown-toggle fw-bold" type="button" id="cajonDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        CAJÓN
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="cajonDropdown">
                        @for ($i = 1; $i <= 6; $i++)
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('cajon{{ $i }}').checked = true; document.getElementById('filtroForm').submit();">
                                    Cajón {{ $i }}
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
                @for ($i = 1; $i <= 6; $i++)
                    <input type="radio" id="cajon{{ $i }}" name="cajon" value="{{ $i }}" class="d-none" {{ request('cajon') == $i ? 'checked' : '' }}>
                @endfor
            </th>

            <th style="padding-bottom: 22px;">
                <div class="dropdown">
                    <button class="btn btn-light fw-bold dropdown-toggle" type="button" id="ordenarDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;">
                        STOCK
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="ordenarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('ordenarAsc').checked = true; document.getElementById('filtroForm').submit();">
                                ASCENDENTE
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('ordenarDesc').checked = true; document.getElementById('filtroForm').submit();">
                                DESCENDENTE
                            </a>
                        </li>
                    </ul>
                    <input type="radio" id="ordenarAsc" name="ordenar" value="asc" class="d-none" {{ request('ordenar') == 'asc' ? 'checked' : '' }}>
                    <input type="radio" id="ordenarDesc" name="ordenar" value="desc" class="d-none" {{ request('ordenar') == 'desc' ? 'checked' : '' }}>
                </div>    
            </th>
        </form>
        <th style="padding-bottom: 30px;">ACEPTADAS</th>
        <th style="padding-bottom: 30px;">ENTREGADAS</th>
    </tr>
</thead>

        <tbody>
            @foreach ($inventario as $herramienta)
            <tr>
                <td>{{ $herramienta->cod_herramienta }}</td>
                <td>{{ $herramienta->nombre }}</td>
                <!--<td>{{ Str::limit($herramienta->descripcion, 50) }}</td>-->
                <td class="text-center">{{ $herramienta->estado }}</td>
                <td class="text-center">
                    @php
                        $nombresCategorias = [
                            1 => 'Manual',
                            2 => 'Eléctrica',
                        ];
                    @endphp
                    {{ $nombresCategorias[$herramienta->categoria] ?? $herramienta->categoria->nombre ?? 'Sin categoría' }}
                </td>
                <td class="text-center">{{ $herramienta->organizador}}</td>
                <td class="text-center">{{ $herramienta->cajon }}</td>
                <td class="text-center">{{ $herramienta->stock }}</td>
                <td class="text-center">{{ $herramienta->cantidadAceptadas }}</td>
                <td class="text-center">{{ $herramienta->cantidadEntregadas }}</td>
                <td>
                    <!-- Botones de acciones (similar al original) -->
                </td>
            </tr>
            @endforeach

            <div class="alert alert-info" role="alert" @if ($inventario->count() > 0 || (!$categoria && !$organizador && !$cajon && !$ordenar)) style="display: none;" @endif>
                @if ($inventario->count() == 0)
                    <strong>No hay resultados para:</strong>
                    @if ($categoria)
                        <span>CATEGORÍA SELECCIONADA - </span>
                    @endif
                    @if ($organizador)
                        <span>{{ $organizador == 1 ? 'Organizador 1' : 'Organizador 2' }} - </span>
                    @endif
                    @if ($cajon)
                        <span>Cajón {{ $cajon }} - </span>
                    @endif
                    @if ($ordenar)
                        <span>STOCK: {{ $ordenar == 'asc' ? 'Ascendente' : 'Descendente' }}</span>
                    @endif
                @endif
            </div>


        </tbody>
    </table>
</div>

<!-- Paginación manual -->
<div class="pagination d-flex justify-content-center mb-4">
    <ul class="pagination">
        @if ($paginaActual > 1)
            <li class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}">Primera</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $paginaActual - 1]) }}">Anterior</a>
            </li>
        @endif

        <!-- Páginas intermedias -->
        @for ($i = 1; $i <= $totalPaginas; $i++)
            <li class="page-item {{ $i == $paginaActual ? 'active' : '' }}">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($paginaActual < $totalPaginas)
            <li class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $paginaActual + 1]) }}">Siguiente</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $totalPaginas]) }}">Última</a>
            </li>
        @endif
    </ul>
</div>


@endsection

<style>
.pagination .page-item .page-link svg {
    display: none !important;
}

.pagination .page-item .page-link {
    font-size: 0.8rem; /* Reducir tamaño de los números */
    padding: 5px 10px; /* Reducir padding */
}

.relative.inline-flex.items-center svg {
    display: none;
}

/* Aplica display: flex solo al div con las clases específicas */
.flex.justify-between.flex-1.sm\:hidden {
    display: flex;
    justify-content: center;
}

.hidden > div:nth-child(1){
    display: flex;
    justify-content: center;
}

a.px-4:nth-child(1){
    text-decoration:none;
}
a.px-4:nth-child(2){
    text-decoration:none;
}

.main-content{
    margin-left: 5% !important;
}

</style>

