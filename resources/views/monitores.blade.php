@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
    <div class="container">
    <h1 class="col-12 text-center fw-bold mb-4 mt-3">USUARIOS</h1>

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
            <!-- Botón de Instructores -->
            <div class="col-lg-2 col-md-4 col-sm-12 mb-2 text-lg-end text-center">
                <a href="{{ route('monitores', ['role' => 'Instructor']) }}" class="btn btn-outline-success w-100 {{ $role == 'Instructor' ? 'active' : '' }}">
                    <i class="fas fa-eye"></i>
                    Instructores
                </a>
            </div>

            <!-- Botón de Monitores -->
            <div class="col-lg-2 col-md-3 col-sm-12 mb-2 text-lg-start text-center">
                <a href="{{ route('monitores', ['role' => 'Monitor']) }}" class="btn btn-plus w-100 {{ $role == 'Monitor' ? 'active' : '' }}">
                    <i class="fas fa-eye"></i>
                    Monitores
                </a>
            </div>

            <!-- Botón de Nuevo Monitor -->
            <div class="col-lg-3 col-md-5 col-sm-12 offset-lg-5 mb-2 text-center">
                <a href="/crearMonitor" class="btn btn-outline-success w-100">
                    <i class="fas fa-plus"></i>
                    Nuevo Monitor
                </a>
            </div>
        </div>


        <div class="row mt-4">
            @foreach($instructores as $instructor)
                <div class="col-md-3 col-lg-3 col-sm-6 mb-3" id="cardu">
                    <form action="{{ $role == 'Monitor' ? route('convertirInstructor') : route('createMonitor') }}" method="POST" style="display: inline;">
                        <div class="card-client {{ $role == 'Monitor' ? 'monitor' : 'instructor' }}"
                            id="card-{{ $instructor->id }}"
                            style="background-color: {{ $role == 'Monitor' ? '#2b9baa' : 'rgb(29, 148, 40)' }}; 
                                border: 4px solid {{ $role == 'Monitor' ? 'rgb(102, 172, 167)' : 'rgb(68, 177, 80)' }};">
                            <div class="card-inner">
                                <!-- Cara frontal -->
                                <div class="front">
                                    <div class="user-picture" style="border: 4px solid {{ $role == 'Monitor' ? 'rgb(102, 172, 167)' : 'rgb(68, 177, 80)' }};">
                                        <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
                                        </svg>
                                    </div>
                                    <p class="name-client">{{ $instructor->name }} {{ $instructor->lastname }}
                                        <span>{{ $instructor->getRoleNames()->implode(', ') }}</span>
                                    </p>
                                    <div class="social-media">
                                        <div class="row">
                                            <div class="col-md-12 mb-1">
                                                <a href="#" class="tooltip-trigger" onclick="flipCard('{{ $instructor->id }}')">
                                                    <i class="fas fa-address-card" style="color:white; font-size: 30px"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cara trasera (información adicional) -->
                                <div class="back">
                                    <p>CC: {{ $instructor->user_identity }}</p>
                                    <br>
                                    <p>Email: {{ $instructor->email }}</p>
                                    <br>
                                    <p>Teléfono: {{ $instructor->telefono }}</p>

                                    <button type="button" onclick="flipCardBack('{{ $instructor->id }}')" class="btn btn-secondary mt-3">
                                        Volver
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

</div>

    </div>
@endsection


<style>
    /* Estilo de cards */ 
    .card-container {
        perspective: 1000px; /* Profundidad para el efecto de rotación */
    }
    .card-inner {
        transform-style: preserve-3d;
        transition: transform 0.6s ease;
    }

    .front, .back {
        backface-visibility: hidden; /* Esto oculta el frente cuando está volteado */
        position: absolute;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    .front {
        transform: rotateY(0deg); /* La cara frontal está en su posición inicial */
    }

    .back {
        transform: rotateY(180deg); /* La cara trasera está rotada 180° */
        color: white;
        display: inherit !important;
        flex-direction: column;  
        justify-content: center; 
        align-items: center;    
        color: white;            
        height: 100%; 
        max-height: 200px;  /* Ajusta este valor según tus necesidades */
        text-align: left;   /* Asegura que el texto se alinee correctamente */

    }

    .back p {
        margin: 5px 0;           /* Espaciado entre los párrafos */
        font-size: 15px;         /* Ajusta el tamaño de la fuente */
        word-wrap: break-word; /* Asegura que las palabras largas se dividan en varias líneas si es necesario */
    }

    .card-flipped .card-inner {
        transform: rotateY(180deg); /* Aplica el giro de 180° cuando se hace clic en la tarjeta */
    }

    .card-flipped .front {
        display: none; /* Oculta el lado frontal cuando está girado */
    }

    .card-flipped .back {
        display: flex; /* Asegura que el lado trasero se vea cuando se gire la tarjeta */
    }

    .card-flipped .front {
        display: none; /* Oculta el lado frontal cuando está girado */
    }

    .card-flipped .back {
        display: flex; /* Asegura que el lado trasero se vea cuando se gire la tarjeta */
    }

    .card:hover {
        transform: rotateY(180deg); /* Gira la tarjeta cuando pasa el ratón */
    }


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
        height: 280px;
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
    height: 100px;
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

  .tooltip-social.show {
    display: block; /* Mostrar cuando tenga la clase 'show' */
    opacity: 1;
    transform: translate(-50%, -130%);
}
</style>

<style>
    @media (max-width: 677px) {
        .card-client{
            width: 10rem !important;
            height: 310px !important;
        }

        #cardu{
            width: 50% !important;
        }
        .main-content{
        margin-left: 7% !important;
    }
}


/* Pantallas medianas (tablets) */
@media (min-width: 677px) and (max-width: 1000px) {
    .card-client{
            width: 14rem !important;
            height: 290px !important;
        }

        #cardu{
            width: 30% !important;
            margin-right: 3% !important;

        }
        .main-content{
            margin-left: 5% !important;
        }

}

/* Pantallas grandes (escritorio) */
@media (min-width: 1001px) {

}
</style>

<script>
    function flipCard(instructorId) {
    const card = document.getElementById(`card-${instructorId}`);
    card.classList.toggle('card-flipped');
    }

    function flipCardBack(instructorId) {
        const card = document.getElementById(`card-${instructorId}`);
        // Eliminar la clase 'card-flipped' para volver a la cara frontal
        card.classList.remove('card-flipped');
    }


    function toggleTooltip(event, instructorId) {
        event.preventDefault();
        const tooltip = document.getElementById(`tooltip-${instructorId}`);
        if (tooltip.style.display === 'none' || tooltip.style.display === '') {
            tooltip.style.display = 'block';
        } else {
            tooltip.style.display = 'none';
        }
    }

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

