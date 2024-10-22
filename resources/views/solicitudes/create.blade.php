@extends('layouts.dashboard')
@section('titulo', 'Crear Solicitud')
@section('content')
@can('solicitarHerramienta')
<section>
    <center>
        <h4 class="mb-4 fw-bold">COMPLETA LA SOLICITUD</h4>
    </center>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                @if(count($solicituditemsArray) > 0)
                <form action="{{ route('solicitudes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="{{ auth()->user()->name }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 mb-3">
                            <label for="telefono">Teléfono:</label>
                            <input type="number" id="telefono" name="telefono" class="form-control" value="{{ auth()->user()->telefono }}" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                    </div>

                    <h6 class="mt-4">Información de la solicitud</h6>
                    <hr>
                    <div class="card p-3" style="height: 180px">
                        @foreach($solicituditemsArray as $item)
                            <!-- Hidden inputs for storing item data -->
                            <input type="hidden" name="solicituditemsArray[]" value="{{ json_encode($item) }}">
                            <input type="hidden" name="cod_herramienta[]" value="{{ $item['cod_herramienta'] }}">
                            <input type="hidden" name="cantidad[]" value="{{ $item['cantidad'] }}">
                            
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="herramienta"> Herramienta:</label>
                                    <h5 class="fw-semibold ms-2">
                                        {{ $item['nombre'] }}
                                    </h5> 
                                </div>   
                                <div class="form-group col-lg-6">
                                    <label for="cantidad_herramienta">Cantidad:</label>
                                    <h6 class="fw-semibold ms-2">
                                        {{ $item['cantidad'] }} unidad(es)
                                    </h6>  
                                </div>     
                            </div>
                        @endforeach
                        <div class="row">
                                <div class="d-flex col-lg-6 p-3">
                                <a href="/solicitudItems" class="btn btn-outline-info">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-12 col-lg-6">
                <div class="form-group col-lg-12 mb-4">
                            <label for="semana" class="mb-2 fw">Fecha de la solicitud:</label>
                            <div class="cardc">
                            <div id="calendar"></div>
                            <!-- Campos ocultos para fecha y hora -->
                            <input type="hidden" id="fecha" name="fecha">
                            <input type="hidden" id="hora" name="hora">
                            </div>
                        </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-plus fw-bold" >Guardar Solicitud</button>
                </div>
            </form>
        </div>
        @else
            <div class="alert alert-warning">No hay herramientas en la solicitud.</div>
        @endif
    </div>
</section>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
@endsection

<style>
    .card {
    max-height: 600px; /* Si quieres un límite máximo */
    overflow-y: auto;  /* Agrega scroll vertical si excede el máximo */
    }

    .fc-scrollgrid-sync-inner{
        a{
        color: green !important;
        text-decoration: none;
        }
    }
    .fc-timegrid-axis-frame{
        background-color: #f0f0f0; 

    }

    .fc-daygrid-day{
        background-color: #f0f0f0;
    }
    
    tr{
        height: 30px;
    }

    tbody{
        border-color: white !important;
    }

    /* Cambiar fondo del calendario completo */
    .fc {
        border-radius: 20px;
    }

    .fc-timegrid-axis{
        background-color: #f0f0f0 !important; /* Gris claro para cada celda */
    }
    /* Cambiar fondo de la cuadrícula de días */
    .fc-daygrid-day {
        background-color: #f0f0f0 !important; /* Gris claro para cada celda */
    }

    .fc-col-header-cell{
        background-color: #f0f0f0 !important; /* Gris claro para cada celda */
        border-color: white !important;

    }

    .fc-scrollgrid-section{
        border-color: white !important;
    }

    /* Cambiar fondo de las ranuras de tiempo */
    .fc-timegrid-slot {
        background-color: #f0f0f0; /* Gris claro para ranuras de tiempo */
    }

    /* Cambiar fondo de las filas en timeGrid */
    .fc-timegrid .fc-timegrid-slot {
        background-color: #f0f0f0; /* Gris claro para ranuras de tiempo */
    }

    /* Cambiar fondo de los días en la vista de tiempo */
    .fc-timegrid .fc-daygrid-day {
        background-color: #f0f0f0; /* Asegurarse de que las celdas en la vista de tiempo también tengan el mismo fondo */
    }


    /* Alternativa si la anterior no funciona */
    .fc-view-harness .fc-daygrid-day-top {
        display: none !important; /* Asegúrate de que se aplique a pesar de otros estilos */
    }





    /* Ajustar específicamente el contenedor de la vista */
    .fc-view-harness {
        border-right: none !important; /* Elimina el borde derecho de la vista */
    }

    .cardc{
        position: relative;
        overflow: hidden; /* Evita que la imagen de fondo se desborde */
        border: none; /* Elimina el borde si no es necesario */
        height: 350px; /* Asegura que la tarjeta tenga una altura adecuada */
        /*box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.16);*/
        border-color: transparent;
        border-radius: 18px;
        width: 100%;
        padding: 5%;
        flex-direction: column;
        justify-content: space-between;; /* Si quieres un límite máximo */
        overflow-y: auto;  /* Agrega scroll vertical si excede el máximo */
    }

    .btn-group{
        
    }

</style>

<script>
 var solicitudesAceptadas = @json($solicitudesAceptadas);  // Solicitudes aceptadas con detalles
    var solicitudActual = @json($solicituditemsArray);  // Herramientas que estás solicitando

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var eventAdded = false; // Variable para rastrear si se ha añadido un evento
        var today = new Date(); // Fecha y hora actuales

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            themeSystem: 'bootstrap',
            locale: 'es',
            selectable: true,
            editable: true,
            headerToolbar: {
                left: 'prev,next today',
                right: 'title',
            },
            hiddenDays: [0, 6], // Ocultar domingos y sábados
            validRange: function(nowDate) {
                var start = new Date(nowDate);
                var end = new Date(nowDate);
                end.setDate(end.getDate() + 8);
                return {
                    start: start,
                    end: end
                };
            },
            slotMinTime: '08:00:00',
            slotDuration: '00:30:00', // Intervalo de media hora
            slotMaxTime: '17:00:00',
            slotLabelInterval: '00:30:00', // Etiqueta de las horas en intervalos de media hora
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
                hour12: true
            },
            // Filtrar y mostrar eventos con detalles de la herramienta
            events: solicitudesAceptadas.flatMap(function(solicitud) {
                // Filtrar herramientas aceptadas que coincidan con las solicitadas
                var herramientasFiltradas = solicitud.detalles.filter(function(detalle) {
                    return solicitudActual.some(function(herramientaSolicitada) {
                        return detalle.cod_herramienta === herramientaSolicitada.cod_herramienta;
                    });
                });

                // Si no hay coincidencias, no agregar el evento
                if (herramientasFiltradas.length === 0) return [];

                var startDateTime = solicitud.fecha + 'T' + solicitud.hora; // Fecha y hora de inicio
                var endDate = new Date(startDateTime);
                endDate.setHours(endDate.getHours() + 2); // Añadir 12 horas para el fin del evento

                // Formatear herramientas para el título del evento con cantidad solicitada
                var herramientasEnSolicitud = herramientasFiltradas.map(function(detalle) {
                    return `${detalle.cantidad} unidad(es)`;
                }).join("\n");

                // Devolver el evento
                return {
                    title: `${solicitud.nombre} - ${herramientasEnSolicitud}`,  // Mostrar herramientas y cantidad solicitada
                    start: startDateTime,
                    end: endDate.toISOString(),
                    allDay: false,
                    color: 'green'
                };
            }),
            // Manejador de clics en fechas
            dateClick: function(info) {
                var currentHour = today.getHours();
                var currentMinute = today.getMinutes();

                var selectedDate = info.date;
                var selectedHour = info.date.getHours();
                var selectedMinute = info.date.getMinutes();

                // Validar si la fecha seleccionada está en el pasado
                if (
                    selectedDate.toDateString() === today.toDateString() &&
                    (selectedHour < currentHour || (selectedHour === currentHour && selectedMinute < currentMinute))
                ) {
                    alert("No puedes seleccionar una hora en el pasado.");
                    return;
                }

                if (eventAdded) {
                    alert("Ya se ha creado una solicitud.");
                    return;
                }

                var formattedDate = selectedDate.toISOString().split('T')[0];
                var formattedHour = selectedHour + ":" + ("0" + selectedMinute).slice(-2);

                var confirmMessage = "Confirmar fecha y hora: " + formattedDate + " " + formattedHour;
                if (confirm(confirmMessage)) {
                    document.getElementById('fecha').value = formattedDate;
                    document.getElementById('hora').value = formattedHour;

                    // Añadir el nuevo evento al calendario
                    calendar.addEvent({
                        title: "Tu solicitud",
                        start: formattedDate + 'T' + formattedHour + ':00',
                        allDay: false,
                        color: 'blue'
                    });

                    eventAdded = true;
                    console.log("Evento agregado: ", formattedDate + 'T' + formattedHour + ':00');
                }
            }
        });

        calendar.render();
    });

</script>








