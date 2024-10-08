@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('verSolicitud')
<div class="container">
    <h4 class="fw-semibold mb-4" style="color: green;">Revisa tus solicitudes <i class="fas fa-pencil icono me-1 mb-1" style="color: green; font-size: 18px"></i></h4>
    <div class="row">
        @foreach($solicitudesAceptadas as $solicitud)
        <div class="col-4 mb-4">
            <div class="card p-3 overflow-auto" style="min-height: 400px; width: 330px">
                <h5 style="color: green;">Solicitud #{{ $solicitud->id }} - {{ $solicitud->fecha }}</h5>
                <p><strong style="color: green;">Hora - Solicitud:</strong>{{ $solicitud->hora }}<br>
                <strong style="color: green;">Instructor:</strong> {{ $solicitud->nombre }}<br>
                <strong style="color: green;">Email:</strong> {{ $solicitud->email }}<br>
                <strong style="color: green;">Teléfono:</strong> {{ $solicitud->telefono }}<br>
                <strong style="color: green;">Estado:</strong> {{ $solicitud->estado }}<br>
                </p>
                <center>
                <div class=" mb-3">
                    <button class="btn btn-outline-success agregarHerramientaBtn" data-bs-toggle="modal" data-bs-target="#agregarHerramientaModal" data-solicitud-id="{{ $solicitud->id }}">
                        <i class="fas fa-plus"></i> Agregar herramienta
                    </button>
                </div>
                </center>

                <div class="row">
                    @foreach($solicitud->detalles as $detalle)
                    <div class="col-md-12 mb-3">
                    @can('solicitarHerramienta')
                    <div class="card p-3 mb-1" style="height: 180px;">
                    @endcan
                    @can('editarSolicitud')
                    <div class="card p-3" style="min-height: 230px;">
                    @endcan
                            <h6 class="fw-bold" style="color: green;">HERRAMIENTA</h6>
                            <p><strong style="color: gray;">Nombre:</strong> {{ $detalle->herramienta->nombre }}<br>
                            <strong style="color: gray;">Código:</strong> {{ $detalle->herramienta->cod_herramienta }}<br>
                            <strong style="color: gray;">Cantidad:</strong> {{ $detalle->cantidad }}<br>
                            <strong style="color: gray;">Estado:</strong> <span style="color: green;">{{ $detalle->estado }}</span></p>

                            @can('editarSolicitud')
                            <form action="{{ route('solicitud.actualizarEstado', $detalle->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <label for="estado" class="mb-0">Actualizar Estado</label>

                                <div class="form-group d-flex align-items-center">
                                    <select name="estado" class="form-control me-2 estado-select" data-herramienta-id="{{ $detalle->id }}">
                                        <option value="aceptada" {{ $detalle->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                                        <option value="entregada" {{ $detalle->estado == 'entregada' ? 'selected' : '' }}>Entregada</option>
                                        <option value="recibida" {{ $detalle->estado == 'recibida' ? 'selected' : '' }}>Recibida</option>
                                    </select>
                                    <button type="button" class="btn btn-primary text-white abrirModalBtn" data-herramienta-id="{{ $detalle->id }}">
                                        <i class="fas fa-sync-alt"></i> 
                                    </button>
                                </div>
                            </form>

                            <div class="mt-3">
                                <button class="btn btn-success agregarHerramientaBtn">
                                    <i class="fas fa-plus"></i> Agregar nueva herramienta
                                </button>
                            </div>

                            
                            @endcan
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
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

<!-- Modal para agregar herramienta -->
<!-- Modal para agregar herramienta -->
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



@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
@endsection

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

<!---<div class="modal-backdrop fade show" style="background-color: transparent"></div>--->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todos los botones que abren el modal
        document.querySelectorAll('.abrirModalBtn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Evitar el envío del formulario

                // Obtener el id de la herramienta desde el atributo data-herramienta-id
                var herramientaId = this.getAttribute('data-herramienta-id');

                // Mostrar el modal
                var modal = new bootstrap.Modal(document.getElementById('codigoBarrasModal'));
                modal.show();

                // Añadir el evento click para verificar el código
                document.getElementById('verificarCodigoBtn').onclick = function() {
                    var codigoBarras = document.getElementById('codigoBarras').value;
                    verificarCodigo(herramientaId, codigoBarras);
                };
            });
        });

        // Verificar código escaneado
        function verificarCodigo(herramientaId, codigoBarras) {
            fetch(`/verificar-codigo-herramienta/${herramientaId}/${codigoBarras}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Código de barras verificado correctamente.');
                        // Cerrar el modal
                        var modal = bootstrap.Modal.getInstance(document.getElementById('codigoBarrasModal'));
                        modal.hide();
                    } else {
                        document.getElementById('errorMensaje').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error al verificar el código de barras:', error);
                });
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
    // Abrir el modal y cargar el ID de la solicitud en el formulario
    document.querySelectorAll('.agregarHerramientaBtn').forEach(button => {
        button.addEventListener('click', function() {
            const solicitudId = this.getAttribute('data-solicitud-id');
            const form = document.getElementById('agregarHerramientaForm');
            form.action = `/solicitud/${solicitudId}/agregar-herramienta`;
        });
    });

    // Función de búsqueda de herramientas
    document.getElementById('buscarHerramienta').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.herramienta-item').forEach(function(item) {
                const herramientaName = item.textContent.toLowerCase();
                item.style.display = herramientaName.includes(searchTerm) ? '' : 'none';
            });
        });

        // Manejo del botón de filtrar

        document.getElementById('buscarHerramienta').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.herramienta-item').forEach(function(item) {
            const herramientaName = item.textContent.toLowerCase();
            item.style.display = herramientaName.includes(searchTerm) ? '' : 'none';
        });
    });
});


</script>






