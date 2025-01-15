<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset('css/stylehome.css') !!}">
    <script type="module" src="{{ asset('js/home.js') }}"></script>
    
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-RANDOM_HASH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YOUR_HASH" crossorigin="anonymous"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logosenavv.png?v=1') }}" type="image/png" >
    <title>CONTROL FESTO</title>
    <style>
            /*@keyframes changeImages {
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
            }*/

            .card {
            position: relative;
            overflow: hidden; /* Evita que la imagen de fondo se desborde */
            border: none; /* Elimina el borde si no es necesario */
            background-size: cover; /* Asegura que la imagen cubra toda la tarjeta */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            height: 210px; /* Asegura que la tarjeta tenga una altura adecuada */
            box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.16);
            border-color: transparent;
            border-radius: 18px;
            width: 100%;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Añade transición suave */

        }


        .card:hover {
            transform: scale(1.05); /* Hacer zoom al pasar el mouse */
        }

        /* Ocultar las flechas en Chrome, Safari y Edge */
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Ocultar las flechas en Firefox */
            input[type="number"] {
                -moz-appearance: textfield;
            }
        
            .modal-content {
                background-size: cover;
                background-position: center;
                color: white;
                position: relative; /* Necesario para el pseudo-elemento */
                border: none; /* Elimina el borde si no es necesario */
                border-color: transparent ;
                background-position: center; /* Centra la imagen */
                border-radius: 2rem; /* Bordes redondeados más suaves */
                padding: 15px;
                background: rgba(0, 0, 0, 0.7);
            }
    </style>
</head>
<body>
<div id="overlay" class="overlay"></div>
<!-- Modal Carousel 
    <div class="modal fade" id="modalCarousel" tabindex="-1" aria-labelledby="modalCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: white; box-shadow: none;">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="modalCarouselLabel">¡Bienvenido a Control Festo!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        </div>
    </div>
    </div>-->
<!--Navbar--->
    <nav class="navbar navbar-light bg-transparent py-3 fixed-top">
        <div class="container" style="max-width: 1800px; ">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <img src="img/logosenablanco.png" alt="" style="height: 60px" class="ms-md-3">
                <div>                        
                    <button id="msg" class="btn mx-2">
                        <a href="#" id="openModal" role="button" style="color: #39a900; opacity: 1;">
                            <i class="fas fa-screwdriver-wrench"></i>
                        </a>
                    </button>
                    <button id="login" class="btn btn-light mx-2 me-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-right-to-bracket pe-2 " style="font-size: 26px;"></i>Iniciar Sesión
                    </button>

                </div>
            </div>
        </div>
    </nav>
<section id="section1" class="section1">
    <div class="content-wrapper">
<!--Herramientas-->
    <div class="text-content">
    <div id="fondo" style=" background-color: #39a900; overflow-x: hidden;">
        <div class="row">
            <div class="col-md-5 ms-5">
            <div id="carouselExample" class="carousel slide d-none d-lg-block d-md-block" data-bs-ride="carousel">
                <div class="carousel-inner">
                        <!-- Tarjeta 1 -->
                        <div class="carousel-item active" style="padding-top: 90px;">
                        <div class="card" id="card1" style="background: url('img/home/card1.jpg') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Préstamo de recursos</h5>
                            <p class="fw-semibold" style="color: white;">Permite el préstamo de recursos a los instructores que lo requieran.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Tarjeta 2 -->
                        <div class="carousel-item" style="padding-top: 90px;">
                        <div class="card" style="background: url('img/home/card2.jpg') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Incentivo al desarrollo</h5>
                            <p class="fw-semibold" style="color: white;">Incentiva a cada aprendiz, para que pueda acceder a los beneficios de FESTO.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Agrega el resto de las tarjetas aquí de forma similar -->
                        <!-- Tarjeta 3 -->
                        <div class="carousel-item" style="padding-top: 90px;">
                        <div class="card" style="background: url('img/home/card3.avif') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Desarrollo en ambientes</h5>
                            <p class="fw-semibold" style="color: white;">Los ambientes que lo requieran podrán capacitarse con los recursos necesarios.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Tarjeta 4 -->
                        <div class="carousel-item" style="padding-top: 90px;">
                        <div class="card" style="background: url('img/home/card4.jpg') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Herramientas Manuales</h5>
                            <p class="fw-semibold" style="color: white;">Podrán realizarse préstamos de las herramientas manuales que se requieran.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Tarjeta 5 -->
                        <div class="carousel-item" style="padding-top: 90px;">
                        <div class="card" style="background: url('img/home/card5.jpg') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Control Entrada - Salida</h5>
                            <p class="fw-semibold" style="color: white;">Se llevará un control de todos los préstamos que se realicen en el área de FESTO.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Tarjeta 6 -->
                        <div class="carousel-item" style="padding-top: 90px;">
                        <div class="card" style="background: url('img/home/card6.jpg') no-repeat center center; background-size: cover; height: 280px !important;">
                            <div class="card-body position-relative bottom-0 start-0 ">
                            <h5 class="card-title mb-2 fw-bold" style="color: white;">Herramientas Eléctricas</h5>
                            <p class="fw-semibold" style="color: white;">Podrán realizarse préstamos de las herramientas eléctricas que se requieran.</p>
                            </div>
                        </div>
                        </div>
                        <!-- Agregar más tarjetas aquí -->
                    </div>
        
                    </div>
            </div>
            <div class="col-md-6 pt-5">
            <h2 class="fw-bold text-center" id="bienvh">¡Bienvenido(a) a Control Festo!</h2>
            <p class="text-start mt-3" id="bienv">Optimiza el proceso de préstamo, devolución y seguimiento de herramientas de FESTO dentro del CBA.</p>
            </div>
        </div>
    </div>
    <h2 class="fw-bold text-center my-5 mx-4" style="color: #39a900;">DISPONIBLE EN CONTROL FESTO</h2>
    <!--BUSCADOR <form id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control" name="nombre" id="searchName" placeholder="Buscar herramienta por nombre" value="{{ request()->input('nombre') }}">
                
                <select name="categoria" id="searchCategory" class="form-control">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request()->input('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>--->


    <!-- Herramientas -->
            <div class="row" id="herramientasContainer">
                @foreach($herramientas->take(28) as $herramientaVista) <!-- Limita a 30 elementos -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4" id="cardh" >
                        <!-- Añade la clase 'inactive-tool' si la herramienta está inactiva -->
                        <div class="card herramienta-card {{ $herramientaVista->estado == 'inactivo' ? 'inactive-tool' : '' }}" 
                        style="background-image: url('{{ Str::startsWith($herramientaVista->imagen, ['http://', 'https://']) ? $herramientaVista->imagen : asset('imagenes/herramientas/' . $herramientaVista->imagen) }}');  height: 200px;">
                            <div class="card-body">
                                <div class="row" style="margin-bottom: 25%;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="d-flex gap-2" style="position: absolute; top: 25px; left: 20px;">
                                        </div>
                                    </div>
                                </div>
                                <h6 class="card-title fw-bold">{{ $herramientaVista->nombre }}</h6>
                                    <p class="card-text fw-semibold" style="font-size: 15px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.8em;">
                                        {{ $herramientaVista->descripcion }}
                                    </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>

<!-- Modal LogIn -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow" style="background: url('img/login0.jpg');">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="exampleModalLabel"> CONTROL FESTO</h5>
                <button type="button" data-bs-dismiss="modal" class="btn mb-1" style="background-color: transparent;"><i class="fas fa-close" style="color: white; font-size: 28px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-1">
                <img src="img/logov.png" alt="Imagen" style="width: 100px;" alt="logo">
                </div>
                <!-- Spinner de carga (inicialmente oculto) -->
                <div id="loadingSpinner" class="text-center mb-4" style="display: none;">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Formulario para verificar el documento -->
                <form id="checkDocumentForm" method="POST" action="{{ route('verify.code') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="document_number" class="form-label mt-3 fw-bold" style="color: white;"><i class="fas fa-user pe-1" style="font-size: 15px; color: white;" ></i>
                        N° Identificación</label>
                        <input id="document_number" name="document_number" type="text" class="form-control"
                            placeholder="Ingresa tu número de identificación" required />
                    </div>
                    <div class="text-center mb-1">
                    <button type="submit" id="login2" class="btn px-4 fw-semibold">Iniciar Sesión</button>
                    </div>
                </form>
                <hr>
                <div id="loginError" class="mt-3 text-danger" style="display: none;"></div>
                
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <p class="mb-0 me-2" style="font-size: 15px">¿No tienes una cuenta?</p>
                    <button type="button" class="btn btn-outline-success" style="border-radius: 10px;" data-bs-toggle="modal"
                        data-bs-target="#registerModal">Crear una cuenta</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verification -->
<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h4 class="modal-title fw-semibold" id="verificationModalLabel">Código de Verificación</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-1">
                    <i class="fas fa-envelope-open pe-1 pb-2" style="font-size: 75px; color: #39a900;" ></i>
                </div>
                <h6 class="text-center" id="verificationMessage"></h6> 
                <form id="verificationForm" method="POST" action="{{ route('verify.codeIng') }}">
                    @csrf
                    <div class="mb-1">
                        <label for="verification_code" class="form-label mt-3 fw-semibold" style="color: #39a900;"><i class="fas fa-unlock pe-1" style="font-size: 15px; color: #39a900;" ></i>
                        Código</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                            <input type="text" class="form-control code-input mx-1" maxlength="1" value="*" required readonly />
                        </div>

                    <!-- Input oculto para enviar el código completo -->
                    <input type="hidden" name="verification_code" id="verification_code">
                    </div>

                    <div class="text-center mt-3">
                    <button id="code" class="btn px-4 fw-semibold" type="submit">Verificar Código</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-semibold" id="registerModalLabel" style="color: #39a900;">CREAR CUENTA - CONTROL FESTO</h5>
                <button type="button" data-bs-dismiss="modal" class="btn mb-1" style="background-color: transparent;"><i class="fas fa-close" style="color: white; font-size: 28px;"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="name" class="form-label fw-semibold" style="color: #39a900;"><i class="fas fa-user-pen pe-1" style="font-size: 15px; color: #39a900;" ></i>
                                Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name"
                                    placeholder="Ingresa tu nombre" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="lastname" class="form-label fw-semibold" style="color: #39a900;">
                                Apellido</label>
                                <input id="lastname" name="lastname" type="text" class="form-control" :value="old('lastname')" required autofocus autocomplete="lastname"
                                    placeholder="Ingresa tu apellido" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                    <label for="registerIdentity" class="form-label mt-3 fw-semibold" style="color: #39a900;"><i class="fas fa-id-card pe-1" style="font-size: 15px; color: #39a900;" ></i>
                                    N° de identificación</label>
                                    <input id="registerIdentity" name="user_identity" type="number" class="form-control"
                                placeholder="Ingresa tu cédula" required />
                                    <span id="identityError" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="telefono" class="form-label mt-3 fw-semibold" style="color: #39a900;"><i class="fas fa-phone pe-1" style="font-size: 15px; color: #39a900;" ></i>
                                Teléfono</label>
                                <input id="telefono" name="telefono" type="number" class="form-control" :value="old('telefono')" required autofocus autocomplete="telefono"
                                    placeholder="Ingresa tu teléfono" required />
                                <span id="emailError" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="mb-1">
                        <label for="email" class="form-label mt-3 fw-semibold" style="color: #39a900;"><i class="fas fa-at pe-1" style="font-size: 15px; color: #39a900;" ></i>
                        Email</label>
                        <input id="email" name="email" type="email" class="form-control" :value="old('email')" required autofocus autocomplete="email"
                            placeholder="Ingresa tu correo eléctronico" required />
                        <span id="emailError" class="text-danger"></span>
                    </div>
                    <!--<div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    <div class="mb-3">
                                <label for="registerIdentity" class="form-label">No. de documento</label>
                                <input type="number" class="form-control" id="registerIdentity" name="identity" required>
                    </div>--->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="text-center mt-3 mb-3">
                    <button type="submit" id="register" class="btn px-4 fw-semibold">{{ __('Register') }}</button>
                    </div>

                    <div id="registerMessage" class="text-success mt-3" style="display: none;"></div>

                </form>
                <hr>
                <div class="d-flex align-items-center justify-content-center">
                        <p class="mb-0 me-2" style="font-size: 15px">¿Ya tienes una cuenta?</p>
                        <button type="button" class="btn btn-outline-secondary" style="border-radius: 10px;" data-bs-dismiss="modal">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Info -->
<div id="toolModal" class="modal fade" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: white; box-shadow: none; ">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="toolModalLabel" style="color: #39a900">A CERCA DE FESTO | SENA</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-2" style="max-height: 400px; overflow-x: hidden;">
            <div class="content-container px-md-4">
                <div class="left-content ps-4">
                    <h1 class="fw-bold text-center">¿QUÉ ES FESTO?</h1>
                    <p class="pt-3 ps-3  pe-4 fw-semibold" style=" text-align: justify;">Festo es una empresa puntera internacionalmente en técnicas de automatización y líder mundial en formación y perfeccionamiento profesional técnicos. 
                        El ambiente Festo es un sector especializado de la industria que se especializa en las áreas de electricidad, automatización industrial, hidráulica y neumática. 
                    </p>
                </div>
                <div class="divider"></div>
                <div class="right-content">
                    <h1 class="fw-bold text-center">ACERCA DE FESTO</h1>
                    <ul>
                        <li>
                            <p class="fw-semibold pt-4">Fundada en 1925 en Esslingen am Neckar (Alemania)</p> 
                        </li>
                        <li>
                           <p class="fw-semibold pt-2"> Con alrededor de 20500 empleados mundialmente</p>
                        </li>
                        <li>
                            <p class="fw-semibold pt-2">Convenio con el SENA desde hace más de dos décadas</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Contenido de información FESTO-SENA -->
            <div class="container-info" style="margin-top: 10px; margin-bottom: 20px">
                <div class="row align-items-center pt-5" style=right: 5px;">
                    <!-- Columna con imagen circular -->
                    <div class="col col-lg-4 col-md-12  text-center">
                    <img src="img/home/festosb.png" alt="Imagen Circular" class="img-circle">
                    </div>
                    <!-- Columna con contenido -->
                    <div class="col col-lg-8 col-md-12">
                        <h2 class="fw-bold pb-2">FESTO | SENA</h2>
                        <p style="font-size: 18px">Este ambiente de formación se generó por medio de un convenio entre el SENA y la empresa FESTO (Alemana), 
                            cuyo objetivo principal es la preparación técnica de toda la población y la certificación 
                            en los países donde FESTO tiene cobertura.</p>
                    </div>
                    </div>

                </div> 

                <div class="row row2 align-items-center pt-2" >
                <!-- Columna con contenido -->
                <div class="col col-lg-8 col-md-12">
                    <h2 class="fw-bold pb-2">CONTROL FESTO</h2>
                    <p style="font-size: 18px">Este aplicativo está diseñado con el fin de que los recursos alojados en el ambiente FESTO puedan ser utilizados, garantizando organización y
                        control de entrada - salida de elementos del ambiente.</p>
                </div>

                <!-- Columna con imagen circular -->
                <div class="col col-lg-4 col-md-12  text-center">
                    <img src="img/home/info2.jpg" alt="Imagen Circular" class="img-circle">
                </div>
            </div> 
            </div>
        </div>
    </div>
</div>

</section>
</div>

</section>
</div>


<script>
    document.getElementById('checkDocumentForm').addEventListener('submit', function() {
        // Mostrar el spinner
        document.getElementById('loadingSpinner').style.display = 'block';
    });

    // Ocultar el spinner después de un tiempo simulado o cuando el formulario haya sido procesado
    setTimeout(function() {
        document.getElementById('loadingSpinner').style.display = 'none';
    }, 5000); // Ajusta el tiempo según tus necesidades

    var registerFormAction = "{{ route('register') }}";


    document.querySelectorAll('.code-input').forEach((input, index, inputs) => {
    input.addEventListener('focus', function() {
        this.removeAttribute('readonly');
        this.value = '';
    });

    input.addEventListener('blur', function() {
        if (this.value === '') {
            this.value = '*';
            this.setAttribute('readonly', true);
        }
    });

    input.addEventListener('input', function() {
        this.setAttribute('data-real', this.value);
        //this.value = '*';

        // Moverse al siguiente campo
        let nextInput = this.nextElementSibling;
        if (nextInput && nextInput.classList.contains('code-input')) {
            nextInput.focus();
        }

        // Concatenar los valores de los campos
        let verificationCode = Array.from(inputs)
            .map(input => input.getAttribute('data-real') || '')
            .join('');
        document.getElementById('verification_code').value = verificationCode;
    });

    input.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace') {
            if (this.value === '' || this.value === '*') {
                let prevInput = this.previousElementSibling;
                if (prevInput && prevInput.classList.contains('code-input')) {
                    prevInput.removeAttribute('readonly');
                    prevInput.focus();
                    prevInput.value = '';
                }
            } else {
                this.value = '*';
            }
        }
    });
});

</script>

<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.getElementById('openModal');
        const toolModal = new bootstrap.Modal(document.getElementById('toolModal'), {
            keyboard: true // Permite cerrar el modal con el teclado
        });

        // Abre el modal cuando se haga clic en el botón
        openModalButton.addEventListener('click', function (event) {
            event.preventDefault(); // Evitar la acción predeterminada del enlace
            toolModal.show(); // Mostrar el modal
        });
    });


    window.onload = function() {
  var myModal = new bootstrap.Modal(document.getElementById('modalCarousel'));
  var overlay = document.getElementById('overlay');

  // Mostrar el overlay cuando el modal se muestra
  myModal.show();

  // Activar el overlay
  overlay.classList.add('show');

  // Escuchar el evento de cierre del modal
  document.getElementById('modalCarousel').addEventListener('hidden.bs.modal', function () {
    overlay.classList.remove('show'); // Ocultar el overlay cuando el modal se cierre
  });
};


$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        var nombre = $('#searchName').val();  // Obtener el valor de búsqueda por nombre
        var categoria = $('#searchCategory').val();  // Obtener el valor de la categoría seleccionada

        $.ajax({
            url: '{{ route('home') }}',  // Ruta a la que se envía la solicitud AJAX (asegúrate de que sea correcta)
            method: 'GET',
            data: {
                nombre: nombre,
                categoria: categoria
            },
            success: function(response) {
                // Limpiar el contenedor de herramientas
                $('#herramientasContainer').html('');

                // Añadir las herramientas filtradas
                response.herramientas.forEach(function(herramienta) {
                    $('#herramientasContainer').append(
                        '<div class="col-lg-3 col-md-6 col-sm-12 mb-4">' +
                            '<div class="card herramienta-card ' + (herramienta.estado == 'inactivo' ? 'inactive-tool' : '') + '" style="background-image: url(' + (herramienta.imagen.startsWith('http') ? herramienta.imagen : '/imagenes/herramientas/' + herramienta.imagen) + '); height: 200px;">' +
                                '<div class="card-body">' +
                                    '<h6 class="card-title fw-bold">' + herramienta.nombre + '</h6>' +
                                    '<p class="card-text fw-semibold" style="font-size: 15px;">' + herramienta.descripcion + '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });
            }
        });
    });
});



</script>

<style>
    .code-input {
    text-align: center;
    font-size: 2rem; /* Tamaño grande para resaltar el asterisco */
    font-family: monospace; /* Estilo de fuente para que el asterisco sea uniforme */
    background-color: #f8f9fa; /* Color de fondo claro */
    border: none;
    border-bottom: 2px solid #5bb548; /* Línea inferior */
    width: 50px; /* Tamaño del campo */
    height: 60px; /* Altura del campo */
    margin-right: 5px;
}

.code-input:focus {
    outline: none;
    border-color: #2e7d32; /* Cambia el color de la línea cuando está enfocado */
}

.code-input[readonly] {
    color: #a8a8a8; /* Color gris del asterisco antes de ingresar el código */
}

.form-control::placeholder {
    text-align: center;
}

</style>
</body>
</html>


