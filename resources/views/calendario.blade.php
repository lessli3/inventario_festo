@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('editarSolicitud')
    <!-- Sección para mostrar el calendario -->
    <h4 class="fw-bold mb-4" style="color: green;">CALENDARIO SOLICITUDES PENDIENTES</h4>
    <div class="container mb-5" style="width: 700px">
        <div id="calendar"></div>
    </div>    

    <!-- Modal para editar solicitud -->
    <div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solicitudModalLabel">Detalles de la Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="solicitudForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="solicitud_id" id="solicitud_id">

                        <div class="mb-3">
                            <label for="solicitante" class="form-label">Solicitante</label>
                            <input type="text" class="form-control" id="solicitante" readonly>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold" style="color: green;">Herramientas Asociadas</h6>
                            <ul id="herramientasList" class="list-group">
                                <!-- Aquí se llenarán las herramientas -->
                            </ul>
                        </div>

                        <!--<form action="" method="POST" id="formActualizarEstado">
                            @csrf
                            @method('put')
                            <input type="hidden" name="solicitud_id" id="solicitud_id">
                                <label for="estado" class="mb-0">Actualizar Estado</label>

                            <div class="form-group d-flex align-items-center">
                                <select name="estado" id="estado" class="form-control me-2">
                                <option value="" disabled selected>Selecciona un estado</option>
                                    <option value="aceptada">Aceptada</option>
                                    <option value="entregada">Entregada</option>
                                    <option value="recibida">Recibida</option>
                                </select>
                            </div>
                                </div>
                        </form>-->
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar Solicitud</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            hiddenDays: [0, 6], // Ocultar domingos y sábados
        slotMinTime: '08:00:00',
        slotMaxTime: '17:00:00',
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short',
            hour12: true
        },
            events: [
            @foreach($solicitudesPendientes as $solicitud)
            {
                title: 'Solicitud #{{ $solicitud->id }}',
                start: '{{ $solicitud->fecha }}T{{ $solicitud->hora }}',
                description: '{{ $solicitud->nombre }}',
                id: '{{ $solicitud->id }}',
                herramientas: {!! json_encode($solicitud->detalles->map(function($detalle) {
                    return [
                        'id' => $detalle->herramienta->id,
                        'nombre' => $detalle->herramienta->nombre,
                        'cod_herramienta' => $detalle->herramienta->cod_herramienta,
                        'cantidad' => $detalle->cantidad,
                        /*'estado' => $detalle->estado,*/
                    ];
                })->toArray()) !!} 
            },
            @endforeach
        ],
        eventClick: function(info) {
            // Llenar el modal con los datos del evento clicado
            document.getElementById('solicitante').value = info.event.extendedProps.description;
            document.getElementById('solicitud_id').value = info.event.id;

            var herramientasList = document.getElementById('herramientasList');
            herramientasList.innerHTML = '';

            // Agregar las herramientas al modal
            info.event.extendedProps.herramientas.forEach(function(herramienta) {
                var listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.innerHTML = `<strong>${herramienta.nombre}</strong> (Código: ${herramienta.cod_herramienta})`;
                herramientasList.appendChild(listItem);

                // Actualizar el select con el estado actual de la herramienta
               // var estadoSelect = document.getElementById('estado');
                //estadoSelect.value = herramienta.estado; // Establece el valor del select basado en el estado actual
            });

            // Mostrar el modal
            var modal = new bootstrap.Modal(document.getElementById('solicitudModal'));
            modal.show();
        }

        });

        calendar.render();

        document.querySelector('.btn-primary').addEventListener('click', function(event) {
        event.preventDefault();

        var solicitudId = document.getElementById('solicitud_id').value;

        fetch(`/solicitudes/${solicitudId}/actualizar`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                estado: 'aceptada'
            })
        })
        .then(response => response.json())
        .then(data => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('solicitudModal'));
            modal.hide();

            // Recargar la página para reflejar los cambios
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });
    });
</script>

<style>
   .modal {
    z-index: 1050; /* Asegúrate de que esté por encima */
    max-width: 500px; /* Establece un ancho máximo */
    top: 50%; 
    left: 35%; 
    transform: translateY(-40%); /* Ajusta el modal hacia arriba para centrarlo verticalmente */
}

.modal-backdrop {
    z-index: 1;
}

</style>

@endsection
