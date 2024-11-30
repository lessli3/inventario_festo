@extends('layouts.dashboard')
@section('titulo', 'Solicitudes Finalizadas')
@section('content')

    @if(isset($mensaje))
        <div class="alert alert-warning">
            {{ $mensaje }}
        </div>
    @else
    <div class="container">
        <h3 class="fw-bold">SOLICITUDES FINALIZADAS</h3>
        <div class="row mt-5">
            <!-- Cambiar la clase col-md-5 a col-md-3 para que las tarjetas se acomoden mejor -->
            @foreach($solicitudesFinalizadas as $solicitud)
                <div class="col-md-4 mb-4">
                    <div class="book">
                        <!-- Detalles de las herramientas (inicialmente ocultos) -->
                        @foreach($solicitud->detalles as $detalle)
                                <div class="tool-card">
                                    <div class="card " style="height: 90px; width: 260px; margin-left: 10px; background-image: url('{{ $detalle->herramienta->imagen }}');">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <strong>{{ $detalle->herramienta->nombre }}</strong><br>
                                                Cod: {{ $detalle->cod_herramienta }} <br>
                                                Estado: {{ $detalle->estado }} <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Información de la solicitud (por encima de las herramientas) -->
                            <div class="cover">
                                <center>
                                    <h5 class="fw-bold">Instructor {{ $solicitud->nombre }}  <br>{{ $solicitud->user_identity }} <br> {{ $solicitud->fecha }}</h5>
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

</style>
