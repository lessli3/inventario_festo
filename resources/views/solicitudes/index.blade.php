@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('verSolicitud')
<div class="container">
    <div class="row">
        <div class="col-md-7">
        <h4 class="fw-semibold mb-4" style="color: green;">Revisa tus solicitudes <i class="fas fa-pencil icono me-1 mb-1" style="color: green; font-size: 18px"></i></h4>
        </div>
        @can('editarSolicitud')
        <div class="col-md-5">
        <form id="filterForm" method="GET" action="{{ route('solicitudes.index') }}">
            <div class="form-group mb-3 d-flex">
                <input type="text" id="buscarUserIdentity" name="solicitud" class="form-control" placeholder="Buscar por cédula..." >
                <button type="submit" class="btn btn-outline-success ms-2" id="filtrarBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        </div>
        @endcan
    </div>
<!-- Mensaje de éxito o error -->
  @if (session('success'))
  <div class="alert alert-success" id="successAlert">
      {{ session('success') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="alert alert-danger" id="errorAlert">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </div>
  @endif 

@if ($solicitudesAceptadas->isNotEmpty())
@foreach($solicitudesAceptadas as $solicitud)
<div class="row">
  <div class="col-md-12">
    <div id="accordion">
      <!-- Tarjeta colapsable -->
      <div class="cardl">
        <!-- Este enlace activa el colapso dentro de la tarjeta -->
        <a class="card1" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCard-{{ $solicitud->id }}" aria-expanded="false" aria-controls="collapseCard-{{ $solicitud->id }}">
        <h5 class="fw-bold" style="color: green;"> {{ $solicitud->fecha }}</h5>
                    <p><strong style="color: green;">Hora de la solicitud:</strong> {{ $solicitud->hora }}<br>
                        <strong class="mt-1" style="color: green;">Instructor:</strong> {{ $solicitud->nombre }}<br>
                        <strong style="color: green;">Estado:</strong> {{ $solicitud->estado }}
                    </p>         
        <div class="go-corner">
            <div class="go-arrow">
              →
            </div>
          </div>
        </a>

        <!-- Contenido colapsable relacionado a la tarjeta -->
        <div id="collapseCard-{{ $solicitud->id }}" class="collapse" data-bs-parent="#accordion">
          <div class="cardl-body">
            <div class="row">
                    <div class="col-md-9" style="margin-bottom: 10px;">
                    <p style="margin-top: 8px;"><strong style="color: green; "></strong>Información de la solicitud<br>
                    </div>

                    <div class="col-md-3">
                    @if ($solicitud->estado !== 'entregada')
                        @can('editarSolicitud')
                        <button class="btn btn-outline-success agregarHerramientaBtn" data-bs-toggle="modal" data-bs-target="#agregarHerramientaModal" data-solicitud-id="{{ $solicitud->id }}">
                            <i class="fas fa-plus"></i> Agregar herramienta
                        </button>
                        @endcan
                    @endif
                    </div>
                <hr>
                <div class="row">
                  <div class="col-md-9 ">
                  <div class="row">
                    @foreach($solicitud->detalles as $detalle)
                        <div class="col-md-6 mb-3"> <!-- Cambié a col-md-6 para 2 columnas en pantallas medianas -->
                            <div class="card p-1 pt-2" style="background-image: url('{{ filter_var($detalle->herramienta->imagen, FILTER_VALIDATE_URL) ? $detalle->herramienta->imagen : asset('imagenes/herramientas/' . $detalle->herramienta->imagen) }}'); background-size: cover; height: 180px">
                                <div class="card-content col-md-12">
                                    <div class="row mb-1">
                                        <div class="col-md-9">
                                            <h5 class="fw-bold" style="color: white;">{{ $detalle->herramienta->nombre }}</h5> 
                                        </div>
                                        @if ($solicitud->estado !== 'entregada')
                                            @can('editarSolicitud')
                                                <div class="col-md-1">
                                                    <form action="{{ route('eliminar.herramienta', ['solicitudId' => $solicitud->id, 'codHerramienta' => $detalle->herramienta->cod_herramienta]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endcan
                                        @endif
                                    </div>
                                    <p>
                                        <strong style="color: white;">Código:</strong> <span  style="color: white;">{{ $detalle->herramienta->cod_herramienta }}</span><br>
                                        <strong style="color: white;">Estado:</strong> <span class="fw-bold" style="color: green;">{{ $detalle->estado }}</span><br>
                                        <div class="row" style="top: 130;display: flex;position: absolute;">
                                            <div class="col-md-9">
                                                <strong style="color: white;">Cantidad:</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <span style="color: white;">      
                                                @if($solicitud->estado !== 'entregada')
                                                    @can('editarSolicitud')
                                                        <!-- Formulario para editar la cantidad -->
                                                        <form action="{{ route('actualizar.cantidad', ['solicitudId' => $solicitud->id, 'detalleId' => $detalle->id]) }}" method="POST" class="d-flex align-items-center" style="display: inline-flex;" >
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="number" name="cantidad" value="{{ $detalle->cantidad }}" class="form-control" style="width: 40px; color: black;height: 30px;">
                                                            <button type="submit" class="btn btn-outline-info btn-sm ms-1">
                                                                <i class="fas fa-check" style="font-size: 20px;"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    <span style="color: white;">{{ $detalle->cantidad }}</span>
                                                @endif

                                                </span>
                                            </div>
                                        </div>
                                        </p>
                                        @can('editarSolicitud')
                                            <!---<form action="{{ route('solicitud.actualizarEstado', $detalle->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <label for="estado" class="mb-0">Actualizar Estado</label>
                                                <div class="form-group d-flex align-items-center">
                                                    <select name="estado" class="form-control me-2 estado-select" data-herramienta-id="{{ $detalle->id }}">
                                                        <option value="aceptada" {{ $detalle->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                                                        <option value="entregada" {{ $detalle->estado == 'entregada' ? 'selected' : '' }}>Entregada</option>
                                                        <option value="recibida" {{ $detalle->estado == 'recibida' ? 'selected' : '' }}>Recibida</option>
                                                    </select>
                                                    <button type="button" class="btn btn-primary text-white abrirModalBtn" data-herramienta-id="{{ $detalle->id }}" data-bs-toggle="modal" data-bs-target="#codigoBarrasModal">
                                                        <i class="fas fa-sync-alt"></i> 
                                                    </button>
                                                </div>
                                            </form>--->
                                        @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                      <strong style="color: green;">Cédula:</strong> {{ $solicitud->user_identity }}<br>
                      <strong style="color: green;">Email:</strong> {{ $solicitud->email }}<br>
                      <strong style="color: green;">Teléfono:</strong> {{ $solicitud->telefono }}<br>
                    @can('editarSolicitud')
                        @if($solicitud->estado === 'entregada')
                            <a href="{{ route('solicitudes.recibir', $solicitud->id) }}" class="btn btn-outline-success mt-2">
                                <i class="fas fa-box-open"></i> Recibir Herramienta
                            </a>
                        @else
                            @can('editarSolicitud')
                                <a href="{{ route('solicitudes.confirmar', $solicitud->id) }}" class="btn btn-outline-success mt-2">
                                    <i class="fas fa-circle-check"></i> Confirmar solicitud
                                </a>
                            @endcan
                        @endif
                    @endcan


                </div>
              </div>
              </div>
        </div>
    </div>
    </div>
    </div>
  </div>
</div> 
        @endforeach
    </div>
@else
    <p>No se encontraron solicitudes que coincidan con la búsqueda.</p>
@endif
</div>

<!-- Modal para lector de código de barras -->
<div class="modal fade" id="codigoBarrasModal" tabindex="-1" aria-labelledby="codigoBarrasModalLabel" aria-hidden="true" data-bs-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.7); border-radius: 2rem">
      <div class="modal-header">
        <h5 class="modal-title" id="codigoBarrasModalLabel" style="color: white;">Verificar Herramienta</h5>
      </div>
      <div class="modal-body">
        <form id="codigoBarrasForm">
          <div class="mb-3">
            <label for="codigoBarras" class="form-label" style="color: white;">Escanea el código de barras</label>
            <input type="text" class="form-control" id="codigoBarras" placeholder="Escanea aquí">
          </div>
          <div id="errorMensaje" class="text-danger" style="display: none;">Código de herramienta no coincide.</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="verificarCodigoBtn">Verificar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para buscar herramientas 
<div class="modal fade" id="agregarHerramientaModal" tabindex="-1" aria-labelledby="agregarHerramientaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarHerramientaModalLabel">Seleccionar Herramienta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="agregarHerramientaForm" action="" method="POST">
            @csrf
            <div class="form-group mb-3 d-flex">
                <input type="text" id="buscarHerramienta" class="form-control" placeholder="Buscar herramienta...">
                <button type="button" class="btn btn-outline-primary ms-2" id="filtrarBtn">
                    <i class="fas fa-search"></i> Filtrar
                </button>
            </div>
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar herramienta...">
            <div class="form-group">
                <div class="herramientas-list">
                    <ul class="list-group">
                        @foreach($herramientasDisponibles as $herramienta)
                        <li class="list-group-item d-flex justify-content-between align-items-center herramienta-item">
                            {{ $herramienta->nombre }} - {{ $herramienta->cod_herramienta }}
                            <button type="submit" class="btn btn-outline-success agregar-btn" data-herramienta-id="{{ $herramienta->id }}">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
-->
<div class="modal fade" id="agregarHerramientaModal" tabindex="-1" aria-labelledby="agregarHerramientaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarHerramientaModalLabel">Seleccionar Herramienta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="filterForm" method="GET" action="{{ route('solicitudes.index') }}">
                <div class="form-group mb-3 d-flex">
                    <input type="text" id="buscarHerramienta" name="search" class="form-control" placeholder="Buscar herramienta..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary ms-2" id="filtrarBtn">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </div>
            </form>
                <div class="form-group">
                    <div class="herramientas-list">
                        <ul class="list-group">
                            @foreach($herramientasDisponibles as $herramienta)
                                <li class="list-group-item d-flex justify-content-between align-items-center herramienta-item">
                                    {{ $herramienta->nombre }} - {{ $herramienta->cod_herramienta }}
                                    <form id="agregarHerramientaForm" action="{{ route('solicitudes.agregarHerramienta', $solicitud->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          <input type="hidden" name="solicitud_id" id="solicitudIdInput" value="">
                                          <input type="hidden" name="cod_herramienta" value="{{ $herramienta->cod_herramienta }}">
                                          <button type="submit" class="btn btn-outline-success agregar-btn">
                                              <i class="fas fa-plus"></i> Agregar
                                          </button>
                                      </form>
                                   
                                </li>
                            @endforeach
                        </ul>
                        @if (request('search') && $herramientasDisponibles->isEmpty())
                            <div class="alert alert-warning">No se encontraron coincidencias.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
@endsection
<script>
    // Función para ocultar las alertas después de 10 segundos
    function hideAlertAfterDelay(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            setTimeout(() => {
                alertElement.style.display = 'none'; 
            }, 3000); // 3 segundos en milisegundos
        }
    }

    // Llama a la función para cada alerta
    window.onload = function() {
        hideAlertAfterDelay('successAlert');
        hideAlertAfterDelay('errorAlert');
    }
</script>

<style>
    .modal-dialog {
        z-index: 1080 !important; /* Asegúrate de que esté por encima del backdrop */
        top: 20%; 
        transform: translate(-50%, -50%); /* Centrar el modal */
        max-width: 500px; /* Opcional: puedes limitar el ancho */
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 2rem; /* Bordes redondeados más suaves */

    }

    .modal-backdrop {
        display: none !important;
    }

</style>

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<!---<div class="modal-backdrop fade show" style="background-color: transparent"></div>--->

<!-- Estilos para las tarjetas -->
<style>
  .cardl {
    width: 95%; /* Ahora ocupa todo el ancho */
    margin: 12px 0; /* Margen vertical opcional */
  }

  .cardl p {
    font-size: 17px;
    font-weight: 400;
    line-height: 20px;
    color: #666;
  }

  .cardl p.small {
    font-size: 14px;
  }

  .go-corner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: 32px;
    height: 32px;
    overflow: hidden;
    top: 0;
    right: 0;
    background-color: green;
    border-radius: 0 4px 0 32px;
  }

  .go-arrow {
    margin-top: -4px;
    margin-right: -4px;
    color: white;
    font-family: courier, sans;
  }

  .card1 {
    display: block;
    position: relative;
    background-color: #f2f8f9;
    border-radius: 4px;
    padding: 15px;
    text-decoration: none;
    z-index: 0;
    overflow: hidden;
    transition: all 0.3s ease-out;
    width: 100%; /* Asegura que la tarjeta ocupe todo el ancho */
  }

  .card1:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: -16px;
    right: -16px;
    background: green;
    height: 32px;
    width: 32px;
    border-radius: 32px;
    transform: scale(1);
    transform-origin: 90% 50%;
    transition: transform 0.25s ease-out;
  }

  .card1:hover:before {
    transform: scale(21);
  }

  .card1:hover p {
    transition: all 0.3s ease-out;
    color: green;
  }

  .card1:hover h3 {
    transition: all 0.3s ease-out;
    color: #fff;
  }

  /* Estilos para asegurar que el contenido colapsable esté alineado con la tarjeta */
  .collapse {
    transition: height 0.3s ease;
    width: 100%; /* Ahora el contenido ocupa el 100% del ancho de la tarjeta */
  }

  .cardl-body {
    padding: 15px;
    background-color: #e2f1f1;
  }

  .card {
    position: relative;
    overflow: hidden;
    width: 100%; /* Ajusta el ancho según sea necesario */
  }

  .card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8); /* Fondo negro semi-transparente */
      z-index: 1; /* Asegura que el fondo esté encima de la imagen */
  }

  .card img {
      width: 100%;
      height: auto; /* Asegura que la imagen sea responsiva */
  }

  .card-content {
      position: relative;
      z-index: 2; /* Contenido por encima del fondo negro */
      color: white; /* Texto en blanco para que sea visible */
      padding: 10px;
  }

</style>
<script>
    // Cuando se carga la página
    /*window.addEventListener('load', function() {
        // Verifica si el modal debe abrirse
        if (localStorage.getItem('modalOpen') === 'true') {
            const modal = new bootstrap.Modal(document.getElementById('agregarHerramientaModal'));
            modal.show();
        }

        // Escuchar el evento de apertura del modal
        document.getElementById('agregarHerramientaModal').addEventListener('show.bs.modal', function (event) {
            // Obtener el botón que abrió el modal
            const button = event.relatedTarget; // Botón que disparó el evento
            const solicitudId = button.getAttribute('data-solicitud-id'); // Extraer el ID de la solicitud

            // Actualizar la URL
            const nuevaUrl = `http://127.0.0.1:8000/solicitudIndex?solicitud=${solicitudId}`;
            window.history.pushState({ path: nuevaUrl }, '', nuevaUrl);

            // Almacena en localStorage que el modal está abierto
            localStorage.setItem('modalOpen', 'true');
        });

        // Escuchar el evento de cierre del modal
        document.getElementById('agregarHerramientaModal').addEventListener('hide.bs.modal', function () {
            localStorage.removeItem('modalOpen');
        });
    });*/
        // Escuchar el evento de apertura del modal de código de barras
    document.getElementById('codigoBarrasModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // El botón que disparó el evento
        const herramientaId = button.getAttribute('data-herramienta-id'); // Obtener el ID de la herramienta

        // Aquí puedes realizar acciones adicionales, como almacenar el ID de la herramienta si lo necesitas
        console.log("ID de herramienta:", herramientaId);
    });

    document.querySelectorAll('.agregarHerramientaBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            const solicitudId = this.getAttribute('data-solicitud-id');
            document.getElementById('solicitudIdInput').value = solicitudId;
        });
    });

</script>









