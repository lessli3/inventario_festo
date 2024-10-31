@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
    <div class="container">
        <h4 class="fw-bold">ASIGNAR MONITORES</h4>

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

        <!-- Botones para alternar entre Instructores y Monitores -->
        <div class="row mb-4">
            <div class="col-md-12 text-end">
                <a href="{{ route('monitores', ['role' => 'Instructor']) }}" class="btn btn-outline-success me-3 {{ $role == 'Instructor' ? 'active' : '' }}">
                  <i class="fas fa-eye"></i>
                   Instructores
                </a>
                <a href="{{ route('monitores', ['role' => 'Monitor']) }}" class="btn btn-plus {{ $role == 'Monitor' ? 'active' : '' }}">
                  <i class="fas fa-eye"></i>
                  Monitores
                </a>
            </div>
        </div>

        <div class="row mt-4">
            @foreach($instructores as $instructor)
                <div class="col-md-3">
                    <form action="{{ $role == 'Monitor' ? route('convertirInstructor') : route('createMonitor') }}" method="POST" style="display: inline;">
                        <div class="card-client {{ $role == 'Monitor' ? 'monitor' : 'instructor' }}" 
                             style="background-color: {{ $role == 'Monitor' ? '#2b9baa' : 'rgb(29, 148, 40)' }}; 
                                    border: 4px solid {{ $role == 'Monitor' ? 'rgb(102, 172, 167)' : 'rgb(68, 177, 80)' }};">
                            <div class="user-picture" style="border: 4px solid {{ $role == 'Monitor' ? 'rgb(102, 172, 167)' : 'rgb(68, 177, 80)' }};">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
                                </svg>
                            </div>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $instructor->id }}">
                            <p class="name-client">{{ $instructor->name }} 
                                <span>{{ $instructor->getRoleNames()->implode(', ') }}</span>
                            </p>
                            <div class="social-media">
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <a href="#">
                                            <i class="fas fa-address-card" style="color:white; font-size: 30px"></i>
                                            <span class="tooltip-social" style="display: flex; flex-direction: column; text-align: left; max-width: 200px; white-space: normal;">
                                                <div>CC: {{ $instructor->user_identity }}</div>
                                                <div style="display: flex; align-items: center;">
                                                    <i class="fas fa-at" style="font-size: 15px;"></i> 
                                                    <span style="margin-left: 5px; overflow-wrap: anywhere;">{{ $instructor->email }}</span>
                                                </div>
                                                <div><i class="fas fa-phone" style="font-size: 15px"></i>  {{ $instructor->telefono }}</div>
                                            </span>
                                        </a>
                                    </div>

                                    <div class="col-md-12">
                                        @if(($role != 'Instructor') || ($role != 'Monitor'))
                                            <button type="submit" class="btn btn-outline-light">
                                                {{ $role == 'Monitor' ? 'Designar Instructor' : 'Designar Monitor' }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection


<style>
    /* From Uiverse.io by abrahamcalsin */ 
  .card-client {
    width: 14rem;
    padding-top: 25px;
    padding-bottom: 25px;
    padding-left: 20px;
    padding-right: 20px;
    box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
    border-radius: 10px;
    text-align: center;
    color: #fff;
    font-family: "Poppins", sans-serif;
    transition: all 0.3s ease;
  }

  .card-client:hover {
    transform: translateY(-10px);
  }

  .user-picture {
    overflow: hidden;
    object-fit: cover;
    width: 5rem;
    height: 5rem;
    border-radius: 999px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
  }

  .user-picture svg {
    width: 2.5rem;
    fill: currentColor;
  }

  .name-client {
    margin: 0;
    margin-top: 20px;
    font-weight: 600;
    font-size: 18px;
  }

  .name-client span {
    display: block;
    font-weight: 200;
    font-size: 16px;
  }


  .card-client.monitor .social-media:before {
      content: " ";
      display: block;
      width: 100%;
      height: 2px;
      margin: 20px 0;
      background: rgb(102, 172, 167);
  }

  .card-client.instructor .social-media:before {
      content: " ";
      display: block;
      width: 100%;
      height: 2px;
      margin: 20px 0;
      background: rgb(68, 177, 80); /* Color para Instructores */
  }

  .social-media a {
    position: relative;
    margin-right: 15px;
    text-decoration: none;
    color: inherit;
  }

  .social-media a:last-child {
    margin-right: 0;
  }

  .social-media a svg {
    width: 1.1rem;
    fill: currentColor;
  }

  /*-- Tooltip Social Media --*/
  .tooltip-social {
    width: 180px;
    background: white;
    display: block;
    position: absolute;
    bottom: 0;
    left: 50%;
    padding: 0.5rem 0.4rem;
    border-radius: 5px;
    font-size: 0.8rem;
    opacity: 0;
    pointer-events: none;
    transform: translate(-50%, -90%);
    transition: all 0.2s ease;
    z-index: 1;
    top: -30;
    height: 95px;
  }

  .tooltip-social {
      position: absolute; /* Asegúrate de que esté posicionado correctamente */
      background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con un poco de transparencia */
      border-radius: 8px; /* Bordes redondeados */
      padding: 10px; /* Espaciado interno */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para profundidad */
      transition: all 0.3s ease; /* Suavizar la transición */
      z-index: 10; /* Asegúrate de que esté por encima de otros elementos */
      display: none; /* Ocultar inicialmente */
      color: #333; /* Color de texto */
      font-size: 0.9rem; /* Tamaño de fuente */
  }

  .user-card:hover .tooltip-social {
      display: block; /* Mostrar el tooltip al pasar el ratón */
  }


  .tooltip-social:after {
    content: " ";
    position: absolute;
    bottom: 1px;
    left: 50%;
    border: solid;
    border-width: 10px 10px 0 10px;
    border-color: transparent;
    transform: translate(-50%, 100%);
  }

  .social-media a .tooltip-social:after {
    border-top-color: white;
  }

  .social-media a:hover .tooltip-social {
    opacity: 1;
    transform: translate(-50%, -130%);
  }
</style>

<script>
    document.querySelectorAll('#designar-monitor').forEach(button => {
        button.addEventListener('click', function(event) {
            const confirmation = confirm("¿Estás seguro de que deseas designarlo como monitor?");
            if (confirmation) {
                // Aquí puedes enviar el formulario
                event.target.closest('form').submit(); // Esto enviará el formulario que contiene este botón
            } else {
                console.log("Designación cancelada.");
            }
        });
    });

    function confirmConversion(userId) {
        // Aquí puedes mostrar un mensaje de confirmación (puedes usar una ventana modal o un confirm)
        if (confirm('¿Estás seguro de que deseas designar a este usuario como instructor?')) {
            // Si el usuario confirma, enviar el formulario
            event.target.closest('form').submit(); 
            } else {
                console.log("Designación cancelada.");
            }
        
    }
</script>


<script>
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

