@extends('layouts.dashboard')
@section('titulo', 'Crear Solicitud')
@section('content')
@can('solicitarHerramienta')
<section>
    <center>
        <h4 class="mb-4 fw-bold">COMPLETA LA SOLICITUD</h4>
    </center>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(count($solicituditemsArray) > 0)
                <form action="{{ route('solicitudes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-lg-6 mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="{{ auth()->user()->name }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-lg-6 mb-3">
                            <label for="telefono">Teléfono:</label>
                            <input type="number" id="telefono" name="telefono" class="form-control" value="{{ auth()->user()->telefono }}" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-lg-12 mb-5">
                        <label for="semana">Fecha de la solicitud:</label>
                        <div id="calendar"></div>
                    </div>

                    <!-- Campos ocultos para fecha y hora -->
                    <input type="hidden" id="fecha" name="fecha">
                    <input type="hidden" id="hora" name="hora">
            
                    <h5 class="mt-5 pt-4">Información de la solicitud</h5>
                    <hr>

                   <div class="card p-3">
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
                    
                    <hr>

                    <div class="text-center">
                        <button type="submit" class="btn btn-plus fw-bold" >Guardar Solicitud</button>
                    </div>

                </form>
                @else
                    <div class="alert alert-warning">No hay herramientas en la solicitud.</div>
                @endif
            </div>
        </div>
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

    /* Ocultar la sección de "Todo el día" */
    .fc-daygrid-day-top {
        display: none;
    }

    .fc-scrollgrid-sync-inner{
        a{
        color: #2b991b;
        text-decoration: none;
        }
        span{
            display: none;
        }
    }
    .fc-timegrid-axis-frame{
        span{
            display: none;
        }
    }
    
tr{
    height: 30px;
}
</style>
<script>
    var solicitudesAceptadas = @json($solicitudesAceptadas);

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var eventAdded = false; // Variable para rastrear si se ha añadido un evento
        var today = new Date(); // Fecha y hora actuales

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
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
            slotMaxTime: '17:00:00',
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
                hour12: true
            },
            events: solicitudesAceptadas.map(function(solicitud) {
                return {
                    title: `${solicitud.nombre}`,
                    start: solicitud.fecha + 'T' + solicitud.hora, // Asumiendo que solicitud.fecha y solicitud.hora están formateados correctamente
                    allDay: false,
                    color: 'green'
                };
            }),
            dateClick: function(info) {
                // Obtener fecha y hora actuales
                var currentHour = today.getHours();
                var currentMinute = today.getMinutes();

                var selectedDate = info.date;
                var selectedHour = info.date.getHours();
                var selectedMinute = info.date.getMinutes();

                // Si el día seleccionado es hoy, y la hora seleccionada es anterior a la actual, mostrar alerta
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








