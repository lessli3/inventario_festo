@extends('layouts.dashboard')
<link rel="icon" href="{{ asset('img/logosenavv.png?v=1') }}" type="image/png" >
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
                    <!-- Nombre y Apellido -->
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label class="fw-bold" for="nombre">Nombre(s)</label>
                        <input type="text" id="nombre" name="nombre" value="{{ auth()->user()->name }}" 
                            class="form-control" readonly 
                            style="border: none; background-color: transparent; padding-left: 0;">
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label class="fw-bold" for="apellido">Apellido(s)</label>
                        <input type="text" id="apellido" name="apellido" value="{{ auth()->user()->lastname }}" 
                            class="form-control" readonly 
                            style="border: none; background-color: transparent; padding-left: 0;">
                    </div>

                    <!-- Email -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label class="fw-bold" for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" 
                            class="form-control" readonly 
                            style="border: none; background-color: transparent; padding-left: 0;">
                    </div>

                    <!-- Teléfono -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label class="fw-bold" for="telefono">Teléfono:</label>
                        <input type="number" id="telefono" name="telefono" 
                            class="form-control" value="{{ auth()->user()->telefono }}" required>
                    </div>
                </div>
                    <h6 class="mt-4">Información de la solicitud</h6>
                    <hr>
                    <div class="card pt-4 mb-5" style="height: 220px">
                    <ol >
                        @foreach($solicituditemsArray as $item)
                            <!-- Hidden inputs for storing item data -->
                            <input type="hidden" name="solicituditemsArray[]" value="{{ json_encode($item) }}">
                            <input type="hidden" name="cod_herramienta[]" value="{{ $item['cod_herramienta'] }}">
                            <input type="hidden" name="cantidad[]" value="{{ $item['cantidad'] }}">
                            
                            <li class="row">
                                <div class="form-group col-md-7 ">
                                    <h6 style="font-size: 20px; text-transform: uppercase;" class="ms-2 mt-2">
                                        <i class="fas fa-tools fw-bold" style="color: green"></i> {{ $item['nombre'] }}
                                    </h6> 
                                </div>  
                                <div class="form-group col-md-4" id="cantidad_herramienta">
                                    <label for="cantidad_herramienta" class="fw-bold">Cantidad:</label>
                                    <h6 style="font-size: 16px" class=" ms-2">
                                        {{ $item['cantidad'] }} unidad(es)
                                    </h6>  
                                </div>     
                            </li>
                        @endforeach
                    </ol>
                    <center class="mb-5">
                        <a href="/solicitudItems" class="btn btn-outline-success">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                    </center>
                        </div>
                </div>
                <div class="col-md-12 col-lg-6">
                <div class="form-group col-lg-12 mb-4">
                            <label for="semana" class="mb-2fw">Fecha de la solicitud:</label>
                            <hr>
                            <div class="cardc">
                            <div id="calendar"></div>
                            <!-- Campos ocultos para fecha y hora -->
                            <input type="hidden" id="fecha" name="fecha">
                            <input type="hidden" id="hora" name="hora">
                            </div>
                        </div>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-outline-success fw-bold" >GENERAR SOLICITUD <i class="fas fa-check"></i></button>
                </div>
                <div class="text-center mt-3 mb-5">
                    <a href="/solicitudItems" class="btn btn-outline-secondary" ><i class="fas fa-arrow-left"></i> Regresar</a>
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
<style>
@media (max-width: 677px) {
        .fc-today-button{
            display: none !important;
        }

        .fc-col-header-cell{
            width: 35px !important;
        }

        .cardc{
            width: 105%;
            max-width: 150% !important;
            padding: 0;
            height: 300px;

        }

        #calendar{
            border-radius: none !important;
            margin-top: 30px;
        }

        #fc-dom-1{
        font-size: 1.5rem !important; 
        text-transform: uppercase !important; 
        }

        .card{
            height: 290px !important;
            width: 100% !important;
        }

        #cantidad_herramienta{
            margin-left: 50px !important;
            margin-top: 4px !important;
        }

}


/* Pantallas medianas (tablets) */
@media (min-width: 677px) and (max-width: 1000px) {
    .card{
            height: 210px !important;
        }
}    
</style>

<script>
 var solicitudesAceptadas = @json($solicitudesAceptadas);  // Solicitudes aceptadas con detalles
 var solicitudActual = @json($solicituditemsArray);  // Herramientas que estás solicitando

 document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('calendar');
     var eventAdded = false; // Variable para rastrear si ya se ha añadido un evento
     var today = new Date(); // Fecha y hora actuales

     var calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'timeGridWeek', // Vista inicial en formato de agenda semanal
         themeSystem: 'bootstrap',
         locale: 'es', // Configurar el idioma en español
         selectable: true, // Permitir seleccionar fechas
         editable: true, // Permitir editar eventos
         headerToolbar: {
             left: 'prev,next today', // Mostrar botones de navegación y hoy
             right: 'title', // Mostrar el título del calendario
         },
         hiddenDays: [0, 6], // Ocultar domingos y sábados
         validRange: function(nowDate) {
             var start = new Date(nowDate); // Rango válido comienza hoy
             var end = new Date(nowDate);
             end.setDate(end.getDate() + 8); // Mostrar solo la próxima semana
             return {
                 start: start,
                 end: end
             };
         },
         slotMinTime: '08:00:00', // Hora mínima (8:00 AM)
         slotDuration: '00:30:00', // Intervalo de tiempo de media hora
         slotMaxTime: '17:00:00', // Hora máxima (5:00 PM)
         slotLabelInterval: '00:30:00', // Mostrar las etiquetas de las horas en intervalos de media hora
         slotLabelFormat: {
             hour: 'numeric',
             minute: '2-digit',
             meridiem: 'short', // Mostrar AM/PM
             hour12: true // Usar formato de 12 horas
         },
         // Filtrar y mostrar eventos que correspondan a las herramientas solicitadas
         events: solicitudesAceptadas.flatMap(function(solicitud) {
             // Filtrar las herramientas aceptadas que coincidan con las solicitadas
             var herramientasFiltradas = solicitud.detalles.filter(function(detalle) {
                 return solicitudActual.some(function(herramientaSolicitada) {
                     return detalle.cod_herramienta === herramientaSolicitada.cod_herramienta;
                 });
             });

             // Si no hay coincidencias, no agregar el evento
             if (herramientasFiltradas.length === 0) return [];

             var startDateTime = solicitud.fecha + 'T' + solicitud.hora; // Fecha y hora de inicio
             var endDate = new Date(startDateTime);
             endDate.setHours(endDate.getHours() + 2); // Duración del evento (2 horas)

             // Formatear las herramientas solicitadas con la cantidad
             var herramientasEnSolicitud = herramientasFiltradas.map(function(detalle) {
                 return `${detalle.cantidad} unidad(es)`;
             }).join("\n");

             // Devolver el evento formateado
             return {
                 title: `${solicitud.nombre} - ${herramientasEnSolicitud}`,  // Mostrar el nombre de la solicitud y cantidad de herramientas
                 start: startDateTime,
                 end: endDate.toISOString(),
                 allDay: false,
                 color: 'green' // Color del evento
             };
         }),
         // Manejar el clic en las fechas para seleccionar una nueva solicitud
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

             // Validar si ya se ha añadido un evento
             if (eventAdded) {
                 alert("Ya se ha creado una solicitud.");
                 return;
             }

             // Formatear la fecha y hora seleccionada
             var formattedDate = selectedDate.toISOString().split('T')[0];
             var formattedHour = ("0" + selectedHour).slice(-2) + ":" + ("0" + selectedMinute).slice(-2);

             // Confirmar la selección de la fecha y hora
             var confirmMessage = "Confirmar fecha y hora: " + formattedDate + " " + formattedHour;
             if (confirm(confirmMessage)) {
                 // Guardar la fecha y hora en los campos ocultos del formulario
                 document.getElementById('fecha').value = formattedDate;
                 document.getElementById('hora').value = formattedHour;

                 // Añadir el evento al calendario
                 calendar.addEvent({
                     title: "Tu solicitud",
                     start: formattedDate + 'T' + formattedHour + ':00',
                     allDay: false,
                     color: 'blue' // Color del evento creado por el usuario
                 });

                 eventAdded = true; // Marcar que ya se ha añadido un evento
                 console.log("Evento agregado: ", formattedDate + 'T' + formattedHour + ':00');
             }
         }
     });

     calendar.render(); // Renderizar el calendario solo una vez
 });

</script>









