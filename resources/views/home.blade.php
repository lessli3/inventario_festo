<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('css/stylehome.css') !!}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>HOME</title>
    <style>
            @keyframes changeImages {
                0% {
                    background-image: url('img/home/bg1.jpg');
                }
                33% {
                    background-image: url('img/home/bg2.jpg');
                }
                66% {
                    background-image: url('img/home/bg3.jpg');
                }
                100% {
                    background-image: url('img/home/bg1.jpg');
                }
            }

            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                }
                33%{
                    opacity: 0;
                }
                75% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    opacity: 0;
                }
            }

        .card{
            width: 100%;
            height: 100%; /* Ocupa toda la altura del contenedor */
            max-width: 450px; /* Tamaño máximo opcional para la tarjeta */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8); /* Sombra */
            display: flex;
            flex-direction: column; /* Organiza los elementos de la tarjeta en columna */
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Añade transición suave */
        }

        .card:hover {
            transform: scale(1.05); /* Hacer zoom al pasar el mouse */
        }
        
    </style>
</head>
<body>
<div class="overlay"></div> <!-- Fondo verde semitransparente -->

    <!-- Sección de imagen con texto -->
    <section class="carousel-section">
        <!-- Carrusel como fondo -->
        <div id="carouselBackground" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/home/home1.jpg" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="img/home/home2.jpg" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="img/home/home3.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
        </div>
        
        <div class="carousel-content">
    <!--Navbar-->
            <nav class="navbar navbar-light bg-transparent pt-4 fixed-top">
                <div class="container" style="max-width: 1800px; ">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <img src="img/senalogo.png" alt="" style="height: 50px">
                        <div>                        
                            <button id="msg" class="btn mx-2 ">
                                <a href="/home" class="" role="button" style="color: white; opacity: 1;">
                                <i class="fas fa-screwdriver-wrench"></i></a>
                            </button>
                            <button id="login" class="btn btn-light mx-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-right-to-bracket pe-2 " style="font-size: 26px;"></i>Iniciar Sesión
                            </button>

                        </div>
                    </div>
                </div>
            </nav>
            <div class="container container-text" style="width: 100%; height:100%">
                <img src="img/senalogo.png" alt="">
                <h1 class=" fw-bold" >Centro de Biotecnología Agropecuaria <br> SENA MOSQUERA</h1>
                
            </div>
            
            <a href="#section1" class="scroll-down-button">
                <i class="fas fa-circle-arrow-up"></i>
            </a>
        </div>
    </section>

    <!-- Sección con otra información -->
    <section id="section1" class="section1">
        <div class="content-wrapper">
    <!--Contenido de información-->
        <div class="text-content">
            <div class="content-container">
                <div class="left-content ps-4">
                    <h1 class="fw-bold">¿Qué es FESTO?</h1>
                    <h5 class="pt-3 ps-3  pe-4 fw-semibold" style=" text-align: justify;">Festo es una empresa puntera internacionalmente en técnicas de automatización y líder mundial en formación y perfeccionamiento profesional técnicos. 
                        El ambiente Festo es un sector especializado de la industria que se especializa en las áreas de electricidad, automatización industrial, hidráulica y neumática. 
                    </h5>
                </div>
                <div class="divider"></div>
                <div class="right-content">
                    <h1 class="fw-bold">Acerca de FESTO</h1>
                    <ul>
                        <li>
                            <h5 class="fw-semibold pt-4">Fundada en 1925 en Esslingen am Neckar (Alemania)</h5> 
                        </li>
                        <li>
                           <h5 class="fw-semibold pt-2"> Con alrededor de 20500 empleados mundialmente</h5>
                        </li>
                        <li>
                            <h5 class="fw-semibold pt-2">Convenio con el SENA desde hace más de dos décadas</h5>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Contenido de información FESTO-SENA -->
    <div class="container-info" style="margin-top: 10px; margin-bottom: 20px">
            <div class="row align-items-center pt-5" style="padding-left: 20px; padding-right: 10px;">
                <!-- Columna con imagen circular -->
                <div class="col col-lg-4  col-md-2  text-center">
                <img src="img/home/festosb.png" alt="Imagen Circular" class="img-circle">
                </div>
                <!-- Columna con contenido -->
                <div class="col col-lg-8">
                    <h2 class="fw-bold pb-2">FESTO | SENA</h2>
                    <p style="font-size: 18px">Este ambiente de formación se generó por medio de un convenio que existió entre el SENA y la empresa FESTO (Alemana), 
                        cuyo objetivo principal es la preparación técnica de toda la población, así como la certificación 
                        en competencias de manera internacional en los países donde FESTO tiene cobertura.</p>
                </div>
                </div>

            </div> 

            <div class="row row2 align-items-center pt-2" style="padding-right: 10px;">
                <!-- Columna con contenido -->
                <div class="col col-lg-8">
                    <h2 class="fw-bold pb-2">CONTROL FESTO</h2>
                    <p style="font-size: 18px">Este aplicativo está diseñado con el fin de que los recursos alojados en el ambiente FESTO puedan ser utilizados, garantizando organización y
                        control de entrada - salida de elementos del ambiente, para que así aprendices e instructores puedan sacar provecho de estos.</p>
                </div>

                <!-- Columna con imagen circular -->
                <div class="col col-lg-4  col-md-2  text-center">
                    <img src="img/home/info2.jpg" alt="Imagen Circular" class="img-circle">
                </div>
            </div> 

        
    <!--Contenido de información en cards-->
           <!--Contenido de información en cards-->
           <div class="container-card mt-5">
                    <center>
                    <h2 class="fw-bold">DISPONIBLE EN CONTROL FESTO</h2>
                    </center>
                    <div class="row pt-5 pb-4">
                        <!-- Tarjeta 1 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card1.jpg') no-repeat center center; background-size: cover;">
                                <div class="card-body position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Préstamo de recursos</h5>
                                    <p class="fw-semibold" style="color: white;">Permite el préstamo de recursos a los instructores que lo requieran.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 2 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card2.jpg') no-repeat center center; background-size: cover;">
                                <div class="card-body bodyg position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Incentivo al desarrollo</h5>
                                    <p class="fw-semibold" style="color: white;">Incentiva a cada aprendiz, para que pueda acceder a los beneficios de FESTO.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 3 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card3.avif') no-repeat center center; background-size: cover;">
                                <div class="card-body position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Desarrollo en ambientes</h5>
                                    <p class="fw-semibold" style="color: white;">Los ambientes que lo requieran podrán capacitarse con los recursos necesarios.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 4 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card4.jpg') no-repeat center center; background-size: cover;">
                                <div class="card-body bodyg position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Herramientas Manuales</h5>
                                    <p class="fw-semibold" style="color: white;">Podrán realizarse préstamos de las herramientas manuales que se requieran.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 5 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card5.jpg') no-repeat center center; background-size: cover;">
                                <div class="card-body position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Control Entrada - Salida</h5>
                                    <p class="fw-semibold" style="color: white;">Se llevará un control de todos los préstamos que se realicen en el área de FESTO.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 6 -->
                        <div class="card-home pb-4 col-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                            <div class="card" style="background: url('img/home/card6.jpg') no-repeat center center; background-size: cover;">
                                <div class="card-body bodyg position-relative bottom-0 start-0 ">
                                    <h5 class="card-title mb-2 fw-bold" style="color: white;">Herramientas Eléctricas</h5>
                                    <p class="fw-semibold" style="color: white;">Podrán realizarse préstamos de las herramientas eléctricas que se requieran.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <!-- Modal LogIn -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de inicio de sesión -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Log in</button>
                                <button type="button" class="btn btn-link" id="showRegisterModal">Create an account</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    <!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Create an Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="registerPasswordConfirmation" name="password_confirmation" required>
                        </div>
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="{{ route('terms.show') }}" target="_blank">Terms of Service</a> and <a href="{{ route('policy.show') }}" target="_blank">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var loginModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));

        document.getElementById('showRegisterModal').addEventListener('click', function () {
            loginModal.hide();
            registerModal.show();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93iN/wj1PI/f2BqYDQGAt7b8c6v8pUksbO9GOG3Xp7vcQx8gIoU0eMxI9NezKQ" crossorigin="anonymous"></script>
</body>
</html>
