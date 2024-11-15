@extends('layouts.dashboard')

@section('title', 'INICIO - FESTO')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold" style="color: green;">HERRAMIENTAS EN FESTO</h4>

    <div class="vitrina-carousel mt-4 mb-5">
    <div class="vitrina-track d-flex">
        @foreach ($herramientasAl as $herramienta)
            <div class="vitrina-item">
                <div class="card1">
                <img src="{{ 
                        filter_var($herramienta->imagen, FILTER_VALIDATE_URL) 
                        ? $herramienta->imagen 
                        : asset('imagenes/herramientas/' . $herramienta->imagen) 
                    }}" class="card1-img-top" alt="{{ $herramienta->nombre }}">
                </div>
                <h5 class="fw-bold text-center" style="color:gray;">{{ $herramienta->nombre }}</h5>
            </div>
        @endforeach
        @foreach ($herramientasAl as $herramienta)
            <div class="vitrina-item">
                <div class="card1">
                    <img src="{{ 
                        filter_var($herramienta->imagen, FILTER_VALIDATE_URL) 
                        ? $herramienta->imagen 
                        : asset('imagenes/herramientas/' . $herramienta->imagen) 
                    }}">
                </div>
                <h5 class="fw-bold text-center" style="color:gray;">{{ $herramienta->nombre }}</h5>
            </div>
        @endforeach

            <!-- Clona las herramientaso -->
        @foreach ($herramientasAl as $herramienta)
            <div class="vitrina-item">
                <div class="card1">
                    <img src="{{ 
                        filter_var($herramienta->imagen, FILTER_VALIDATE_URL) 
                        ? $herramienta->imagen 
                        : asset('imagenes/herramientas/' . $herramienta->imagen) 
                    }}">
                </div>
                <h5 class="fw-bold text-center" style="color:gray;">{{ $herramienta->nombre }}</h5>
            </div>
        @endforeach
        </div>
    </div>
</div>


<div class="container" style="margin-bottom: 150px; margin-top: 80px;">
    <div class="row">
    <div class="col-lg-8">
        <div class="cardc" style="width: 100%"> 
        <!--Instructor-->
        @can('solicitarHerramienta')
            <h4 class="fw-bold p-4" style="color: green;"><i class="fas fa-star"></i>  TUS FAVORITOS</h4>
                @if ($herramientasMasPedidasUser->isEmpty())
                    <p style="margin: 20px;">No has realizado solicitudes de herramientas aún.</p>
                @else
                    <div class="row p-2">
                        @foreach ($herramientasMasPedidasUser as $herramientaM)
                            @php
                                // Buscar la herramienta correspondiente
                                $herramienta = $herramientas->firstWhere('cod_herramienta', $herramientaM->cod_herramienta);
                            @endphp

                            <div class="col-md-4"> <!-- Cada card ocupa 4 columnas en pantallas medianas -->
                                <div class="cardm">
                                    <!-- Imagen de la herramienta -->
                                    <img src="{{ 
                                            filter_var($herramienta->imagen, FILTER_VALIDATE_URL) 
                                            ? $herramienta->imagen 
                                            : asset('imagenes/herramientas/' . $herramienta->imagen) 
                                        }}">
                                    <div class="card__content">
                                        @if ($herramienta)
                                            <p class="card__title">{{ $herramienta->nombre }}</p>
                                            <p class="card__description">Esta herramienta ha sido solicitada <strong style="color:green;">{{ $herramientaM->total ?? 0 }}</strong> veces.</p>
                                        @else
                                            <p class="card__description">Herramienta no encontrada</p>
                                        @endif                      
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif  
        @endcan  

        <!--Monitor-->
        @can('editarSolicitud')
            <h4 class="fw-bold p-4" style="color: green;"><i class="fas fa-chart-column"></i>  SOLICITUDES</h4>
            @php
                // Definir un máximo arbitrario
                $maxValue = 30;
            @endphp

            <!-- Barra para "Solicitudes pendientes" -->
            @php $pendientes = $solicitudesContador->firstWhere('estado', 'pendiente')->total ?? 0; @endphp
            <div class="progress-bar mt-1 mb-3" style="height: 40px">
                <div class="progress-fill pt-2" style="width: {{ $pendientes > 0 ? ($pendientes / $maxValue) * 100 : 0 }}%; background-color: {{ $pendientes > 0 ? '#4caf50' : 'transparent' }}; border-radius: 20px">
                    <strong class="me-1">{{ $pendientes }} pendientes </strong>           
            </div>
            </div>

            <!-- Barra para "Solicitudes aceptadas" -->
            @php $aceptadas = $solicitudesContador->firstWhere('estado', 'aceptada')->total ?? 0; @endphp
            <div class="progress-bar my-3" style="height: 40px">
            <div class="progress-fill pt-2" style="width: {{ $aceptadas > 0 ? ($aceptadas / $maxValue) * 100 : 0 }}%; background-color: {{ $aceptadas > 0 ? '#4caf50' : 'transparent' }}; border-radius: 20px">
                    <strong class="me-1">{{ $aceptadas }}  aceptadas  </strong>           
            </div>
            </div>

            <!-- Barra para "Solicitudes entregadas" -->
            @php $entregadas = $solicitudesContador->firstWhere('estado', 'entregada')->total ?? 0; @endphp
            <div class="progress-bar my-3" style="height: 40px">
            <div class="progress-fill pt-2" style="width: {{ $entregadas > 0 ? ($entregadas / $maxValue) * 100 : 0 }}%; background-color: {{ $entregadas > 0 ? '#4caf50' : 'transparent' }}; border-radius: 20px">
                    <strong class="me-1">{{ $entregadas }} entregadas </strong>
            </div>
            </div>

            <!-- Barra para "Solicitudes recibidas" -->
            @php $recibidas = $solicitudesContador->firstWhere('estado', 'recibida')->total ?? 0; @endphp
            <div class="progress-bar my-3" style="height: 40px">
            <div class="progress-fill pt-2" style="width: {{ $recibidas > 0 ? ($recibidas / $maxValue) * 100 : 0 }}%; background-color: {{ $recibidas > 0 ? '#4caf50' : 'transparent' }}; border-radius: 20px">
                    <strong class="me-1">{{ $recibidas }}  recibidas  </strong>           
            </div>
            </div>
        @endcan
        
        <!--Cuentadante-->
        @can('crearHerramienta')
            <h5 class="fw-bold p-4" style="color: green;"><i class="fas fa-arrow-turn-down"></i>  HERRAMIENTAS CON BAJO STOCK</h5>
            @php
                $maxStock = $herramientaBajoStock->max('stock') ?: 1;
            @endphp

            <div class="d-flex justify-content-around">
            @foreach ($herramientaBajoStock as $herramienta)
                <div class="d-flex flex-column align-items-center">
                    <div class="progress-bar-vertical mt-1 mb-3" style="position: relative; display: flex; align-items: center;">
                        <!-- Nombre de la herramienta a la izquierda de la barra -->
                        <div class="progress-name" style="writing-mode: vertical-rl; text-align: center; margin-right: 10px;">
                            <strong style=" color: #4caf50">{{ $herramienta->nombre }} <br>  ({{ $herramienta->cod_herramienta}})</strong>
                        </div>

                        <div class="progress-bar-container" style="border-radius:20px; width: 90px; height: 200px; background-color: #f1f1f1; position: relative;">
                            <div class="progress-fill-vertical" style="width: 100%; height: {{ $herramienta->stock > 0 ? ($herramienta->stock / $maxStock) * 100 : 0 }}%; 
                            height: {{ $herramienta->stock > 0 ? ($herramienta->stock / $maxStock) * 100 : 0 }}%;
                            background-color: {{ $herramienta->stock > 5 ? '#4caf50' : ($herramienta->stock >= 2 ? 'orange' : 'red') }};
                            position: absolute; bottom: 0; border-radius:20px;">
                            </div>
                            <!-- El número dentro de la barra, en la parte inferior -->
                            <span class="fw-bold" style="position: absolute; bottom: 5px; left: 50%; transform: translateX(-50%); z-index: 1; color: white;">
                                {{ $herramienta->stock }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endcan
    </div>
    </div>


        <div class="col-lg-4">
            <div class="cardc p-3">
                <h5 class="text-center fw-bold"><i class="fas fa-fire" style="color: orange"></i>  POPULARES</h5>
                <div class="podio">
                @if ($herramientasMasPedidas->isEmpty())
                    <p style="margin: 20px;">No hay herramientas en el podio aún.</p>
                    @else
                    @foreach ($herramientasMasPedidas ->take(3) as $index => $herramienta) 
                        <div class="podio-item">
                            <span class="podio-number" style="color:green;">{{ $index + 1 }}</span> <!-- Número de posición -->
                            <img src="{{ 
                        filter_var($herramienta->imagen, FILTER_VALIDATE_URL) 
                        ? $herramienta->imagen 
                        : asset('imagenes/herramientas/' . $herramienta->imagen) 
                    }}" class="podio-img">
                            <h6>{{ $herramienta->nombre }}</h6>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

.podio {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Alinea los items al inicio */
}

.podio-item {
    display: flex;
    align-items: center; 
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px 0; 
    padding: 10px;
    width: 100%; 
    height: 70px;
}

.podio-number {
    font-size: 24px; /* Tamaño del número */
    font-weight: bold; /* Negrita para mayor énfasis */
    margin-right: 10px; /* Espacio entre el número y la imagen */
    color: #555; /* Color del número */
}

.podio-img {
    width: 50px; /* Ajusta el tamaño de la imagen */
    height: auto; /* Mantiene la relación de aspecto */
    border-radius: 5px; /* Bordes redondeados para la imagen */
    margin-right: 10px; /* Espacio entre la imagen y el nombre */
}

.podio-item h5 {
    margin: 0; /* Elimina el margen del título */
}


.cardc {
    width: 310px;
    height: 350px; /* Mantener esta altura */
    backdrop-filter: blur(7px);
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 26px;

    /* Aumentar la sombra */
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.4); /* Sombra más pronunciada */
    transition: all 0.3s;
    cursor: pointer;
    overflow: hidden; /* Para que no se salga la imagen */
}

.cardc:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) /* Sombra más pronunciada en hover */
                0 15px 30px rgba(157, 177, 255, 0.4); /* Sombra más difusa en hover */
}


.position-relative {
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5); /* Color de la sombra, puedes ajustar la opacidad */
    border-radius: 26px; /* Para que coincida con la tarjeta */
}


.card1 {
    position: relative;
    overflow: hidden;
    position: relative;
    width: 400px;
    box-shadow: 0px 1px 13px rgba(0,0,0,0.1);
    cursor: pointer;
    align-items: center;
    background: #fff;
    height: 150px;
    border-radius: 15px;
    flex-direction: column;
    justify-content: space-between;
    margin: 10px;
}

.card1-img-top {
    width: 100%; /* La imagen ocupará el ancho completo de la tarjeta */
    height: 100% !important;
    object-fit: cover; /* Mantiene la relación de aspecto */
}

.vitrina-carousel {
    overflow: hidden;
    width: 100%;
}

.vitrina-track {
    display: flex;
    width: max-content;
    animation: scroll 60s linear infinite;
}

.vitrina-item {
    flex: 0 0 3%; /* Ajusta el ancho de cada tarjeta */
    margin-right: 15px;
}


@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-100%);
    }
}



.cardm {
  position: relative;
  width: 200px;
  height: 200px;
  background-color: #f2f2f2;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  perspective: 1000px;
  box-shadow: 0 0 0 5px #ffffff80;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cardm svg {
  width: 48px;
  fill: #333;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cardm:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.card__content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #f2f2f2;
  transform: rotateX(-90deg);
  transform-origin: bottom;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cardm:hover .card__content {
  transform: rotateX(0deg);
}

.card__title {
  margin: 0;
  font-size: 24px;
  color: #333;
  font-weight: 700;
}

.cardm:hover svg {
  scale: 0;
}

.card__description {
  margin: 10px 0 0;
  font-size: 16px;
  color: gray;
  line-height: 1.4;
}


.progress-bar {
    background-color:   #b5b6b5 !important;
    border-radius: 20px;
    margin-right: 15px;
    margin-left: 15px;
    
}

.progress-fill {
    height: 40px;
    padding-right: 10px;
    padding-left: 10px;
    border-radius: 5px;
    background-color: #4caf50; /* Color de la barra, ajustable */
    text-align: right;
    line-height: 20px; /* Centrando el texto */
    color: white;
    padding-right: 10px;
}

</style>

