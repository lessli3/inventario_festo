<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-semibold" id="exampleModalLabel"> INICIAR SESIÓN - CONTROL FESTO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-1">
                <img src="img/logov.png" alt="Imagen Circular" style="width: 100px;" alt="logo">
                </div>
                <!-- Formulario para verificar el documento -->
                <form id="checkDocumentForm" method="POST" action="{{ route('verify.code') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="document_number" class="form-label mt-3 fw-semibold" style="color: green;"><i class="fas fa-user pe-1" style="font-size: 15px; color: green;" ></i>
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

<!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-semibold" id="registerModalLabel" style="color: rgb(89, 181, 72);">CREAR CUENTA - CONTROL FESTO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-1">
                        <label for="name" class="form-label mt-3 fw-semibold" style="color: rgb(89, 181, 72);"><i class="fas fa-user-pen pe-1" style="font-size: 15px; color: rgb(89, 181, 72);" ></i>
                        Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Ingresa tu nombre" required />
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label mt-3 fw-semibold" style="color: rgb(89, 181, 72);"><i class="fas fa-at pe-1" style="font-size: 15px; color: rgb(89, 181, 72);" ></i>
                        Email</label>
                        <input id="email" name="email" type="email" class="form-control" :value="old('email')" required autofocus autocomplete="email"
                            placeholder="Ingresa tu correo eléctronico" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                            <label for="registerIdentity" class="form-label mt-3 fw-semibold" style="color: rgb(89, 181, 72);"><i class="fas fa-id-card pe-1" style="font-size: 15px; color: rgb(89, 181, 72);" ></i>
                            N° de identificación</label>
                            <input id="registerIdentity" name="identity" type="number" class="form-control"
                                placeholder="Ingresa tu identificación" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-1">
                            <label for="role" class=" mt-3 form-label fw-semibold" style="color: rgb(89, 181, 72);"><i class="fas fa-circle-check pe-1" style="font-size: 15px; color: rgb(89, 181, 72);" ></i>
                            Rol</label>
                            <select class="form-select" id="role" name="role" required>
                                <option disabled selected value="">Seleccionar rol</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                        </div>
                        </div>
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

                    <div class="text-center mt-3">
                    <button type="submit" id="register" class="btn px-4 fw-semibold">{{ __('Register') }}</button>
                    </div>

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
                    <i class="fas fa-envelope-open pe-1 pb-2" style="font-size: 75px; color: rgb(89, 181, 72);" ></i>
                </div>
                <h6 class="text-center" id="verificationMessage"></h6> 
                <form id="verificationForm" method="POST" action="{{ route('verify.codeIng') }}">
                    @csrf
                    <div class="mb-1">
                        <label for="verification_code" class="form-label mt-3 fw-semibold" style="color: rgb(89, 181, 72);"><i class="fas fa-unlock pe-1" style="font-size: 15px; color: rgb(89, 181, 72);" ></i>
                        Código</label>
                        <input id="verification_code" name="verification_code" type="text" class="form-control" placeholder="Código de verificación" required />
                    </div>

                    <div class="text-center mt-3">
                    <button id="code" class="btn px-4 fw-semibold" type="submit">Verificar Código</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



</section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var loginModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
    var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));

    var checkDocumentForm = document.getElementById('checkDocumentForm');
    var verificationForm = document.getElementById('verificationForm');

    if (checkDocumentForm) {
        checkDocumentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
            })
            .then(data => {
                if (data.message === 'Código de verificación enviado') {
                   // Mostrar el correo electrónico en el modal de verificación
                   var emailPart = data.email.replace(/(.{3})(.*)(@.*)/, '$1******$3');
                    var verificationMessage = `Revisa el correo ${emailPart} para obtener el código de verificación`;
                    document.getElementById('verificationMessage').textContent = verificationMessage;

                    loginModal.hide();
                    verificationModal.show();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error. Por favor, inténtalo de nuevo.');
            });
        });
    } else {
        console.error('Formulario #checkDocumentForm no encontrado');
    }

    if (verificationForm) {
        verificationForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
            })
            .then(data => {
                if (data.message === 'Código de verificación válido') {
                    window.location.href = '/dashboard'; // Redirige al dashboard
                } else {
                    // Manejo de mensajes de error en la interfaz
                    alert(data.message); // Muestra un mensaje de error
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Se ha producido un error en la verificación del código.');
            });
        });
    } else {
        console.error('Formulario #verificationForm no encontrado');
    }
});


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93iN/wj1PI/f2BqYDQGAt7b8c6v8pUksbO9GOG3Xp7vcQx8gIoU0eMxI9NezKQ" crossorigin="anonymous"></script>
</body>
</html>
