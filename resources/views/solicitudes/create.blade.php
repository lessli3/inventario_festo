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
                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Ej. 3015488445" required>
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
    
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var eventAdded = false; // Variable para rastrear si se ha añadido un evento

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',  // Vista semanal por defecto
            locale: 'es',
            selectable: true,             // Permite seleccionar días
            editable: true,               // Permite editar eventos
            headerToolbar: {              // Barra de herramientas personalizada
                left: 'prev,next today',
                right: 'title',
            },
            hiddenDays: [0, 6],
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
            dateClick: function(info) {
                if (eventAdded) { // Si ya se añadió un evento, muestra un mensaje
                    alert("Ya se ha creado una solicitud.");
                    return;
                }

                // Extraer la fecha y hora seleccionadas
                var selectedDate = info.date.toISOString().split('T')[0]; // 'YYYY-MM-DD'
                var selectedHour = info.date.getHours();
                var selectedMinute = info.date.getMinutes();
                var formattedHour = selectedHour + ":" + ("0" + selectedMinute).slice(-2); // 'HH:MM'
                var formattedDateTime = selectedDate + " " + formattedHour;

                // Mostrar el mensaje de confirmación con la fecha y hora
                var confirmMessage = "Confirmar fecha y hora: " + formattedDateTime;
                if (confirm(confirmMessage)) {
                    // Asignar la fecha y hora seleccionadas a los campos ocultos
                    document.getElementById('fecha').value = selectedDate;
                    document.getElementById('hora').value = formattedHour;

                    // Agregar el evento al calendario
                    calendar.addEvent({
                        title: "Solicitud",
                        start: selectedDate + 'T' + formattedHour + ':00', // Formato ISO 8601: 'YYYY-MM-DDTHH:MM:SS'
                        allDay: false,
                        color: 'blue' // Color del evento
                    });

                    eventAdded = true; // Marcar que ya se ha añadido un evento
                    
                    // Log para depuración
                    console.log("Evento agregado: ", selectedDate + 'T' + formattedHour + ':00');
                }
            }
        });

        calendar.render();
    });
</script>







