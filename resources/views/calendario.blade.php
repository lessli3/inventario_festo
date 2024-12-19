@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('editarSolicitud')
    <!-- Sección para mostrar el calendario -->
    <div class="container-fluid mb-5">
    <h2 class="text-center mb-3 mt-4 mb-4 fw-bold">CALENDARIO SOLICITUDES PENDIENTES</h2>
        <div id="calendar"></div>
    </div>
   

    <!-- Modal para editar solicitud -->
    <div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
    transform: translateY(-40%); /* Ajusta el modal hacia arriba para centrarlo verticalmente */
}

.modal-backdrop {
    z-index: 1;
}

.header{
        padding-bottom: 15% !important;
}


/* Calendario - Pantallas pequeñas */
@media (max-width: 677px) {
    /* Calendario */
    #calendar {
        width: 100% !important;  /* El calendario ocupa el 100% del ancho disponible */
        margin: 0 auto;  /* Centrado automático */
        margin-top: 8%;
        height: 650px;
    }

    /* Modal */
    #solicitudModal {
        max-width: 90%; /* El modal ocupa el 90% del ancho de la pantalla */
        margin-left: 5%;
        margin-top: 40%;
    }

    .modal-content {
        width: 100%;
        max-width: 100%;
    }


    .fc-dayGridMonth-button{
        display:none !important;
    }

    .fc-today-button, .fc-timeGridDay-button, .fc-timeGridWeek-button{
        display:none !important;
    }

    #fc-dom-1{
        font-size: 1.2rem !important; 
        text-transform: uppercase !important; 
    }

    .header{
        z-index: 2 !important;
        padding-top: 0 !important;
        width: 100% !important;
        margin-left: 3% !important
    }

    .modal-backdrop{
        z-index: -5 !important;
        margin-top: 10%
    }
}

/* Pantallas medianas (tablets) */
@media (min-width: 677px) and (max-width: 1000px) {
    /* Calendario */
    #calendar {
        margin-top:10%;
        height: 800px;
        width: 100%; 
        margin-top: 6%;

    }

    /* Modal */
    #solicitudModal  {
        margin-left: 20%;
        max-width: 75%; 
        margin-top: 20%; 
    }

    .fc-today-button{
        display:none !important;
    }

    #fc-dom-1{
        font-size: 1.5rem !important; 
        text-transform: uppercase !important; 
    }

    .modal-backdrop{
        z-index: -5 !important;
        margin-top: 10%
    }

    .header{
        background: 0 !important;
    }

    .main-content{
        margin-top: 10% !important
    }

    .modal-dialog{
        margin-right: 20% !important;
    }

}

/* Pantallas grandes (escritorio) */
@media (min-width: 1001px) {
    /* Calendario */
    #calendar {
        width: 700px;
        margin: 0 auto; 
        margin-top: 5% !important;
    }

    /* Modal */
    #solicitudModal  {
        max-width: 500px;
        margin-top: 8%; 
        margin-left: 35%;

    }

    #fc-dom-1{
        font-size: 1.5rem !important; 
        text-transform: uppercase !important; 
    }

    .header{
        background: 0 !important;
        width: 90% !important;
    }
    }

    .modal {
        z-index: 1050; 
        top: 50%; 
        transform: translateY(-50%); /
    }

    .modal-backdrop {
        z-index: 1;
    }


</style>

@endsection
