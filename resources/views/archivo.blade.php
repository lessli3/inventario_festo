@extends('layouts.dashboard')
@section('titulo', 'Solicitudes Finalizadas')
@section('content')

@if(isset($mensaje))
    <div class="alert alert-warning">
        {{ $mensaje }}
    </div>
@else
<div class="container">
<h2 class="text-center mb-3 mt-4 mb-4 fw-bold">SOLICITUDES FINALIZADAS</h2>
    <div class="row mt-5">
        @foreach($solicitudesFinalizadas as $solicitud)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="book" onclick="toggleCards(this)">
                    <!-- Detalles de las herramientas -->
                    @foreach($solicitud->detalles as $detalle)
                        <div class="tool-card">
                            <div class="card" style="height: 90px; width: 260px; margin: 10px auto; background-image: url('{{ $detalle->herramienta->imagen }}'); background-size: cover;">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>{{ $detalle->herramienta->nombre }}</strong><br>
                                        Cod: {{ $detalle->cod_herramienta }} <br>
                                        Estado: {{ $detalle->proceso }} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Información de la solicitud -->
                    <div class="cover">
                        <center>
                            <h5 class="fw-bold">
                                Instructor {{ $solicitud->nombre }} <br>
                                {{ $solicitud->user_identity }} <br>
                                {{ $solicitud->fecha }}
                            </h5>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection


<style>
    /* From Uiverse.io by eslam-hany */ 
/* Ocultar las tarjetas de herramientas por defecto */
.tool-card {
    opacity: 0;  /* Inicialmente invisibles */
    visibility: hidden; /* No son visibles ni interactivas */
    transition: opacity 0.5s ease-in-out, visibility 0s 0.3s; /* Transición con retardo */
}

/* Mostrar las tarjetas de herramientas cuando el mouse haga hover sobre el book */
.book:hover .tool-card {
    opacity: 1; /* Hacerlas visibles */
    visibility: visible; /* Hacerlas interactivas */
    margin-bottom: 10px; /* Espacio entre las tarjetas */
    transition-delay: 0.3s; /* Retrasar la aparición */
}

/* Opcional: para el contenedor de herramientas si estás usando flex */
.book {
  display: flex;
  flex-direction: column; /* Hace que los elementos se apilen verticalmente */
  align-items: center; /* Alinea las tarjetas al centro, si es necesario */
}

/* Estilo general del book */
.book {
    position: relative;
    border-radius: 10px;
    width: 330px;
    height: 220px;
    background-color: whitesmoke;
    -webkit-box-shadow: 1px 1px 12px #000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra sutil */
    -webkit-transform: preserve-3d;
    -ms-transform: preserve-3d;
    transform: preserve-3d;
    -webkit-perspective: 2000px;
    perspective: 2000px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    color: #000;
}

/* Estilo de la cubierta (cuando no se hace hover) */
.cover {
    top: 0;
    position: absolute;
    background-color: lightgray;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    cursor: pointer;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    -webkit-transform-origin: 0;
    -ms-transform-origin: 0;
    transform-origin: 0;
    -webkit-box-shadow: 1px 1px 12px #000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Sombra sutil */
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
}

/* Estilo cuando el mouse hace hover sobre el book */
.book:hover .cover {
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    -webkit-transform: rotatey(-80deg);
    -ms-transform: rotatey(-80deg);
    transform: rotatey(-80deg);
}


/* Tarjetas ocultas por defecto */
.tool-card {
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px); /* Efecto de desplazamiento inicial */
    transition: opacity 0.5s ease, transform 0.5s ease;
}

/* Mostrar tarjetas al pasar el mouse */
.book:hover .tool-card {
    opacity: 1;
    visibility: visible;
    transform: translateY(0); /* Retorna a su posición */
}

/* Mostrar tarjetas al hacer clic */
.book.active .tool-card {
    opacity: 1;
    visibility: visible;
    transform: translateY(0); /* Retorna a su posición */
}

/* Cubierta (portada) animada */
.cover {
    transition: transform 0.5s;
}

/* Cubierta animada al pasar el mouse */
.book:hover .cover {
    transform: rotateY(-80deg);
}

/* Cubierta animada al hacer clic */
.book.active .cover {
    transform: rotateY(-80deg);
}



/* Responsividad para tamaños pequeños */
@media (max-width: 767px) {
    .book {
        width: 90%; /* Ajustar ancho en móviles */
        height: 250px;
    }

    .tool-card {
        margin: 10px auto; /* Centrar las tarjetas */
    }

    .card{
        width: 190px !important;
        height: 115px !important;
    }

    .main-content{
        margin-left: 15% !important;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .book {
        width: 100%; /* Ajustar ancho en pantallas medianas */
    }
    .tool-card {
        margin: 10px auto; /* Centrar las tarjetas */
    }

    .card{
        width: 210px !important;
        height: 115px !important;
        margin-left: 15px !important; 
    }
}
</style>

<script>
function toggleCards(book) {
    book.classList.toggle('active'); // Alterna la clase "active" para mostrar las tarjetas
}

</script>
