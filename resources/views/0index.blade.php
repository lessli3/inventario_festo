<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{!! asset('css/style2.css') !!}">
    <title>Inventario - Festo</title>
</head>
<body>
<div id="carouselExampleIndicators" class="carousel slide">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex h-100">
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-md-6 d-flex flex-column justify-content-center p-4">
                        <h1>Texto de la Diapositiva 1</h1>
                        <p>Descripción de la primera diapositiva.</p>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card col-md-6 d-flex justify-content-center align-items-center p-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 1</h5>
                                <p class="card-text">Contenido de la primera diapositiva.</p>

                                <button class="control carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex h-100">
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-md-6 d-flex flex-column justify-content-center p-4">
                        <h1>Texto de la Diapositiva 2</h1>
                        <p>Descripción de la segunda diapositiva.</p>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card col-md-6 d-flex justify-content-center align-items-center p-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 2</h5>
                                <p class="card-text">Contenido de la segunda diapositiva.</p>

                                <button class="control carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex h-100">
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-md-6 d-flex flex-column justify-content-center p-4">
                        <h1>Texto de la Diapositiva 3</h1>
                        <p>Descripción de la tercera diapositiva.</p>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="active" aria-current="true" aria-label="Slide 3"></button>
                        </div>
                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card col-md-6 d-flex justify-content-center align-items-center p-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 3</h5>
                                <p class="card-text">Contenido de la tercera diapositiva.</p>

                                <button class="control carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
