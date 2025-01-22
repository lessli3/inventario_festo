@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('verSolicitud')

<div class="container  overflow-x: hidden;">
    <div class="row">
        <div class="col-md-12">
        <h2 class="mb-3 mt-3 mb-4 fw-bold">SOLICITUD {{ $solicitud->fecha }} - {{ $solicitud->hora }}</h2>
        </div>
    </div>

    @if (session('success'))
        <script>
            alertify.success('<i class="fas fa-check-circle"></i> {{ session('success') }}');
        </script>
    @endif
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                alertify.error('<i class="fas fa-times-circle"></i> {{ session('error') }}');
            @endforeach
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                alertify.error('<i class="fas fa-times-circle"></i> {{ session('error') }}');
            });
        </script>

        @php
            // Limpiar el mensaje de error de la sesión
            session()->forget('error');
        @endphp
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p style="font-size: 18px;">
                <strong class="mt-1" style="color: green;">Instructor:</strong> {{ $solicitud->nombre }}<br>
                <strong style="color: green;">Estado:</strong> {{ $solicitud->estado }}
                </p>  
                @can('editarSolicitud')
                <div >
                    @if($solicitud->estado === 'entregada')
                        <a href="{{ route('solicitudes.recibir', $solicitud->id) }}" class="btn btn-outline-success mt-2 mb-4">
                            <i class="fas fa-box-open"></i> Recibir Herramienta
                        </a>
                    @else
                        @can('editarSolicitud')
                            <a href="{{ route('solicitudes.confirmar', $solicitud->id) }}" class="btn btn-outline-success mt-2 mb-4">
                                <i class="fas fa-circle-check"></i> Confirmar solicitud
                            </a>
                        @endcan
                    @endif
                </div>
                @endcan
            </div>
            <div class="col-md-3">
                <p class="text-center">Datos relacionados</p>
                <hr>
                        <strong style="color: green; margin-left: 10px;">Cédula:</strong> {{ $solicitud->user_identity }}<br>
                        <strong style="color: green;  margin-left: 10px;">Email:</strong> {{ $solicitud->email }}<br>
                        <strong style="color: green;  margin-left: 10px;">Teléfono:</strong> {{ $solicitud->telefono }}<br>
            </div>
        </div>

        <div class="col-md-12 col-sm-12" style="margin-bottom: 10px;">
        <p style="margin-top: 18px;" >
            Información de la solicitud<br>
        </p>
        <hr>
        </div>
    <div class="container">
    <div class="row">
        <!-- Contenedor principal -->
        <div class="col-md-9">
            <div class="row">
                <!-- Tarjetas de herramientas -->
                @foreach($solicitud->detalles as $detalle)
                    <div class="col-md-5 my-3">
                        <div class="card p-1 pt-2" style="background-image: url('{{ filter_var($detalle->herramienta->imagen, FILTER_VALIDATE_URL) ? $detalle->herramienta->imagen : asset('imagenes/herramientas/' . $detalle->herramienta->imagen) }}'); background-size: cover; height: 200px; width: 100% !important">
                            <div class="card-content col-md-12">
                                <div class="row">
                                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold text-white mb-0 me-2">{{ $detalle->herramienta->nombre }}</h5>
                                        @if ($solicitud->estado !== 'entregada')
                                            @can('editarSolicitud')
                                            <form id="eliminarHerramientaForm-{{ $detalle->herramienta->cod_herramienta }}" 
                                                action="{{ route('eliminar.herramienta', ['solicitudId' => $solicitud->id, 'codHerramienta' => $detalle->herramienta->cod_herramienta]) }}" 
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="confirmDeletion('{{ $detalle->herramienta->cod_herramienta }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                                <p>
                                    <strong style="color: white;">Código:</strong> <span style="color: white;">{{ $detalle->herramienta->cod_herramienta }}</span><br>
                                    <strong style="color: white;">Estado:</strong> <span class="fw-bold" style="color: green;">{{ $detalle->proceso }}</span><br>
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if($solicitud->estado !== 'entregada')
                                                @can('editarSolicitud')
                                                    <strong style="color: white;">Cantidad:</strong>
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
                                            @endif
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Botones a la derecha -->
        <div class="col-md-3 d-flex flex-column align-items-start">
            @if ($solicitud->estado !== 'entregada')
                @can('editarSolicitud')
                <div class="mb-3 w-100">
                    @if ($solicitud->detalles->count() < \App\Models\Solicitud::MAX_HERRAMIENTAS)
                        <button class="btn btn-outline-success agregarHerramientaBtn w-100" data-bs-toggle="modal" data-bs-target="#agregarHerramientaModal" data-solicitud-id="{{ $solicitud->id }}">
                            <i class="fas fa-plus"></i> Agregar herramienta
                        </button>
                    @else
                        <p class="text-danger">Límite de herramientas alcanzado ({{ \App\Models\Solicitud::MAX_HERRAMIENTAS }}).</p>
                    @endif
                </div>
                @endcan
            @endif
            <div class=" w-100">
                <a href="/solicitudIndex" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
    </div>
</div>

            </div>
              </div>
        </div>
    </div>


<div class="modal fade" id="agregarHerramientaModal" tabindex="-1" aria-labelledby="agregarHerramientaModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="agregarHerramientaModalLabel">Seleccionar Herramienta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="filterForm" method="GET" action="{{ route('solicitud.update', $solicitud->id) }}">
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
                @foreach($herramientas as $herramienta)
                    <li class="list-group-item d-flex justify-content-between align-items-center herramienta-item">
                        {{ $herramienta->nombre }} - {{ $herramienta->cod_herramienta }}
                        <form id="agregarHerramientaForm" action="{{ route('solicitudes.agregarHerramienta', $solicitud->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="cod_herramienta" value="{{ $herramienta->cod_herramienta }}">
                            <button type="submit" class="btn btn-outline-success agregar-btn">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </form>
                    </li>
                @endforeach
                </ul>

                @if (request('search') && $herramientas->isEmpty())
                    <div class="alert alert-warning">No se encontraron coincidencias.</div>
                @endif

                </div>
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
        // Llama a la función para cada alerta
        window.onload = function() {
        hideAlertAfterDelay('successAlert');
        hideAlertAfterDelay('errorAlert');
    }


    function confirmDeletion(codHerramienta) {
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviamos el formulario
                document.getElementById('eliminarHerramientaForm-' + codHerramienta).submit();

            } else {
                Swal.fire(
                    'Cancelado',
                    'La eliminación ha sido cancelada.',
                    'info'
                );
            }
        });
    }
</script>

<style>
.main-content {
    max-width: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
}
/* Estilo para el modal */
    .modal-dialog {
        position: fixed;
        transform: translate(-50%, -50%);
        width: 90%; /* Ajusta el ancho según sea necesario */
        max-width: 600px;
        height: 90vh; /* Altura fija del modal */
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        height: 100%; /* Ajusta el contenido al tamaño del modal */
    }

    .modal-body {
        flex-grow: 1;
        overflow-y: auto; /* Permite desplazamiento dentro del cuerpo del modal */
    }

    /* Lista desplazable */
    .herramientas-list {
        max-height: 80%; /* Usa el espacio disponible */
        overflow-y: auto; /* Activa el scroll si el contenido es mayor */

    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }


    .cardl {
    width: 50%; /* Ahora ocupa todo el ancho */
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
    width: 60% !important; /* Ajusta el ancho según sea necesario */
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


  /* Solicitud - Pantallas pequeñas */
@media (max-width: 677px) {

.header{
    width: 100% !important;
    z-index: 3 !important;
}

.modal-dialog {
    height: 70vh; /* Ajusta la altura para dispositivos pequeños */
    margin-top: 10% !important;
    width: 90% !important;
    margin-left: 5% !important;
    margin-right: 5% !important;
}

.modal-content {
    top: -50;
    display: flex;
    flex-direction: column;
    height: 60% !important; /* Ajusta el contenido al tamaño del modal */
}

.card{
    width: 100% !important;
    height: 160px !important;
}


}
/* Pantallas medianas (tablets) */
@media (min-width: 677px) and (max-width: 1000px) {
.modal-dialog {
    height: 60% !important; /* Ajusta la altura para dispositivos pequeños */
    margin-top: 5% !important;
    margin-bottom: 20% !important;
}

.modal-content {
    top: -80;
    display: flex;
    flex-direction: column;
    height: 60% !important; /* Ajusta el contenido al tamaño del modal */
}

.card{
    height: 220px !important;
}

#cantidad{
    padding-top: 40px !important;
}

.main-content{
    margin-top: 15% !important;
}
}

/* Pantallas grandes (escritorio) */
@media (min-width: 1001px) {
.modal-dialog {
    height: 90vh; /* Ajusta la altura para dispositivos pequeños */
}
}


  

</style>