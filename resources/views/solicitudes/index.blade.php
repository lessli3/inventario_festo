@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('verSolicitud')
<div class="container">
    <div class="row">
        @canany(['solicitarHerramienta', 'crearHerramienta'])
        <div class="col-md-12">
            <h2 class="text-center mb-3 mt-3 mb-4 fw-bold">SOLICITUDES</h2>
        </div>
        @endcanany

        @can('editarSolicitud')
        <div class="col-md-12">
            <h2 class="text-center mb-3 mt-3 mb-4 fw-bold">SOLICITUDES ACEPTADAS Y ENTREGADAS</h2>
        </div>
        @endcan

        @can('editarSolicitud')
        <div class="col-md-5 offset-lg-7 mt-1">
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

    @if($mensaje)
    <div class="alert alert-warning">
        {{ $mensaje }}
    </div>
    @endif
@foreach($solicitudesAceptadas as $solicitud)

<div class="row">
  <div class="col-md-12">
    <div id="accordion">
      <!-- Tarjeta colapsable -->
      <div class="cardl solicitud-card" id="solicitud-{{ $solicitud->id }}">
        <a class="card1" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCard-{{ $solicitud->id }}" aria-expanded="false" aria-controls="collapseCard-{{ $solicitud->id }}">
            <h5 class="fw-bold" style="color: green;"> {{ $solicitud->fecha }}</h5>
                    <p><strong style="color: green;">Hora de la solicitud:</strong> {{ $solicitud->hora }}<br>
                        <strong class="mt-1" style="color: green;">Instructor:</strong> {{ $solicitud->nombre }} {{ $solicitud->apellido }}<br>
                        <strong style="color: green;">Estado:</strong> {{ $solicitud->estado }}
                    </p>         
        <div class="go-corner">
            <div class="go-arrow">
              →
            </div>
          </div>
        </a>

        <!-- Contenido colapsable relacionado a la tarjeta -->
        <div id="collapseCard-{{ $solicitud->id }}" 
        class="collapse {{ session('active_solicitud_id') == $solicitud->id ? 'show' : '' }}" 
        data-bs-parent="#accordion">
          <div class="cardl-body">
            <div class="row">
                    <div class="col-md-9 col-sm-12" style="margin-bottom: 10px;">
                    <p style="margin-top: 8px;"><strong style="color: green; "></strong>Información de la solicitud<br>
                    </div>

                    <div class="col-md-3 col-sm-12 mt-2">
                        @if ($solicitud->estado !== 'entregada')
                            @can('editarSolicitud')
                                <form action="{{ route('solicitud.update', $solicitud->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="fas fa-pencil-alt"></i> Editar Solicitud
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </div>
                <hr class="mt-3">
                <div class="row">
                  <div class="col-md-9 ">
                  <div class="row">
                    @foreach($solicitud->detalles as $detalle)
                        <div class="col-md-6 mb-3"> <!-- Cambié a col-md-6 para 2 columnas en pantallas medianas -->
                            <div class="card p-1 pt-2" style="background-image: url('{{ filter_var($detalle->herramienta->imagen, FILTER_VALIDATE_URL) ? $detalle->herramienta->imagen : asset('imagenes/herramientas/' . $detalle->herramienta->imagen) }}'); background-size: cover; height: 150px">
                                <div class="card-content col-md-12">
                                <div class="row mb-1">
                                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold text-white mb-0 me-2" id="nombre">{{ $detalle->herramienta->nombre }}</h5>
                                    </div>
                                </div>
                                    <p>
                                        <strong style="color: white;">Código:</strong> <span  style="color: white;">{{ $detalle->herramienta->cod_herramienta }}</span><br>
                                        <strong style="color: white;">Cantidad: {{ $detalle->cantidad}}</strong>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <strong style="color: white;">Estado:</strong> <span class="fw-bold" style="color: green;">{{ $detalle->proceso }}</span><br>
                                            </div>
                                        </div>
                                    </p>
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

    document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todas las tarjetas
    const solicitudCards = document.querySelectorAll('.solicitud-card');

    solicitudCards.forEach(card => {
        // Encuentra el contenido colapsable asociado
        const collapseContent = card.querySelector('.collapse');

        // Agrega un evento para cuando se expande el colapsable
        collapseContent.addEventListener('show.bs.collapse', () => {
            solicitudCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.style.display = 'none'; // Oculta las demás tarjetas
                }
            });
        });

        // Agrega un evento para cuando se cierra el colapsable
        collapseContent.addEventListener('hide.bs.collapse', () => {
            solicitudCards.forEach(otherCard => {
                otherCard.style.display = 'block'; // Muestra todas las tarjetas
            });
        });
    });
});

</script>

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









