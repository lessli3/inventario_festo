<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <!-- Localización en español -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap/main.min.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styledashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styletools.css') }}">
    @livewireStyles

</head>
<body>
@livewireScripts
<div class="row mt-3">
    <header class="header d-flex align-items-center" style="z-index: 1">
        <!-- Menú hamburguesa alineado a la izquierda -->
        <span class="hamburger-menu material-symbols-outlined d-lg-none" id="menuToggle">menu</span>

        <div class="mobile-menu" id="mobileMenu">
            <ul>
            <ul class="sidebar-links" style="padding: 0;">
            <!---<h4 class="fw-bold">
                <span>Menu</span>
                <div class="menu-separator"></div>
            </h4>-->
            <li class="admin-title fw-bold" style="color: #504f4f;">
                @if(Auth::user()->can('crearHerramienta'))
                    <p>Cuentadante</p>
                @elseif(Auth::user()->can('solicitarHerramienta'))
                    <p>Instructor</p>
                @elseif(Auth::user()->can('editarSolicitud'))
                    <p>Monitor</p>
                @else
                    <p>Sin permisos específicos</p>
                @endif
            </li>
            <li>
                <a href="/dashboard"><span class="material-symbols-outlined">home</span></a>
                <span class="submenu-text">Home</span>

            </li>
            <li>
                <a href="/herramientas"><span class="material-symbols-outlined">build</span></a>
                <span class="submenu-text">Herram.</span>
            </li>

            @can('editarSolicitud')
            <li>
                <a href="/calendario">
                    <span class="material-symbols-outlined">event</span></a>
                <span class="submenu-text">Calendar</span>
            </li>
            @endcan
            @canany(['solicitarHerramienta', 'editarSolicitud'])
                <li>
                    <a href="/solicitudIndex">
                        <span class="material-symbols-outlined">folder</span></a>
                    <span class="submenu-text">Solicitud</span>
                </li>
                
            @endcanany

            @can('editarSolicitud')
            <li>
                <a href="/archivo">
                    <span class="material-symbols-outlined">attach_file</span> </a>
                <span class="submenu-text">Archivo</span>
            </li>
            @endcan

            @can('crearHerramienta')
            <li>
                <a href="/monitores"><span class="material-symbols-outlined">groups</span></a>
                <span class="submenu-text">Usuarios</span>
            </li>
            @endcan
            <hr>
            <li>
                <a href="{{ route('profile') }}"><span class="material-symbols-outlined">account_circle</span></a>
                <span class="submenu-text">Perfil</span>

            </li>
            <li>
                <a href="/home"><span class="material-symbols-outlined">logout</span></a>
                <span class="submenu-text">Cerrar sesión</span>
            </li>
            </ul>
        </div>

        @auth
        @if (Auth::user())
        <div class="col-md-7 col-lg-10 d-flex justify-content-between align-items-center">
            <!-- Contenedor de los iconos o botones -->
            <div class="d-flex align-items-center">
                @can('solicitarHerramienta')
                <div class="Usuario me-2" style="margin-left: 7%">
                    <livewire:solicitud-contador />
                </div>
                @endcan

                @can('editarSolicitud')
                <div class="Usuario me-2" style="margin-left: 7%">
                    <div style="background-color: rgb(25, 161, 13); width: 48px; border-radius: 50%; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
                        <a href="/solicitudIndex" style="color: rgb(242, 243, 243);">
                            <i class="fas fa-clipboard-check icono" style="font-size: 25px;"></i>
                        </a>
                    </div>
                </div>
                @endcan

                @can('crearHerramienta')
                <div class="Usuario me-2" style="margin-left: 7%">
                    <div style="background-color: rgb(25, 161, 13); width: 48px; border-radius: 50%; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
                        <a href="/herramientas" style="color: rgb(242, 243, 243);">
                            <i class="fas fa-tools icono" style="font-size: 25px;"></i>
                        </a>
                    </div>
                </div>
                @endcan
            </div>

            <!-- Contenedor del usuario, alineado a la derecha -->
            <div class="user d-flex align-items-center mx-3" style="background-color: #b5b8b477; border-radius: 15px; color: rgb(25, 161, 13); height: 55px; width: 200px;justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); padding: 1%;">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <div class="user-b inline-flex justify-center items-center fw-bold pb-1 ms-1" style="background-color: rgb(25, 161, 13);border-radius: 50%;height: 40px;text-align: center;width: 40px;align-content: center; color:white; font-size: 22px">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }} <!-- Mostrar la inicial en mayúscula -->
                    </div>
                </div>
                <div class="col-md-8">
                    <button type="button" class="inline-flex items-center py-3" style="background-color: transparent; border: none; color: green;">
                        {{ Auth::user()->name }} <!-- Mostrar el nombre completo del usuario -->
                    </button>
                </div>
            </div>
        </div>
        @endif
        @endauth    
    </header>
</div>



    <aside class="sidebar d-none d-lg-block">
        <div class="sidebar-header">
            <div class="row">
            <img src="img/logov.png" alt="">
            </div>
            <h4 class="mt-2 fw-bold" style="color: rgb(25, 161, 13)">FESTO</h4>
        </div>
        <ul class="sidebar-links" style="padding: 0;">
            <!---<h4 class="fw-bold">
                <span>Menu</span>
                <div class="menu-separator"></div>
            </h4>-->
            <li class="admin-title fw-bold" style="color: #504f4f;">
                @if(Auth::user()->can('crearHerramienta'))
                    <p>Cuentadante</p>
                @elseif(Auth::user()->can('solicitarHerramienta'))
                    <p>Instructor</p>
                @elseif(Auth::user()->can('editarSolicitud'))
                    <p>Monitor</p>
                @else
                    <p>Sin permisos específicos</p>
                @endif
            </li>
            <li>
                <a href="/dashboard"><span class="material-symbols-outlined">home</span>Home</a>
            </li>
            <li>
                <a href="/herramientas"><span class="material-symbols-outlined">build</span>Herramientas</a>
            </li>

            @can('editarSolicitud')
            <li>
                <a href="/calendario">
                    <span class="material-symbols-outlined">event</span>Calendario
                </a>
            </li>
            @endcan
            @canany(['solicitarHerramienta', 'editarSolicitud'])
                <li>
                    <a href="/solicitudIndex">
                        <span class="material-symbols-outlined">folder</span>Solicitudes
                    </a>
                </li>
                
            @endcanany

            @can('editarSolicitud')
            <li>
                <a href="/archivo">
                    <span class="material-symbols-outlined">attach_file</span> Archivo
                </a>
            </li>
            @endcan

            @can('crearHerramienta')
            <li>
                <a href="/monitores"><span class="material-symbols-outlined">groups</span>Usuarios</a>
            </li>
            @endcan
            <hr>
            <li>
                <a href="{{ route('profile') }}"><span class="material-symbols-outlined">account_circle</span>Perfil</a>
            </li>
            <li>
                <a href="/home"><span class="material-symbols-outlined">logout</span>Cerrar Sesión</a>
            </li>
            <!---
            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"><span class="material-symbols-outlined">logout</span>Cerrar Sesión</a>
                </form>
            </li>-->
        </ul>
    </aside>

    <div class="main-content">
        @yield('content')
    </div>

<script>
            document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('menuToggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.style.display = (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') ? 'block' : 'none';
        });

        document.addEventListener('click', function(e) {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuToggle = document.getElementById('menuToggle');
            
            if (!mobileMenu.contains(e.target) && e.target !== menuToggle) {
                mobileMenu.style.display = 'none';
            }
        });
        });
     </script>



<!--<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>  Usando CDN para Hammer.js 
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menu = document.getElementById('mobileMenu');
        const body = document.body;

        // Detectar gestos en el cuerpo de la página
        const hammer = new Hammer(body, {
            inputClass: Hammer.TouchInput
        });

        hammer.on('swiperight', () => {
            console.log('Deslizado hacia la derecha');
            menu.classList.add('active');
        });

        hammer.on('swipeleft', () => {
            console.log('Deslizado hacia la izquierda');
            menu.classList.remove('active');
        });
    });
</script>--->
</body>
</html>

<style>
    /* Menú móvil oculto por defecto en pantallas grandes */
.mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #333;
    color: white;
    padding: 20px;
    z-index: 1050;
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    overflow-y: auto;
}

.mobile-menu.active {
    transform: translateX(0);
}

/* Mostrar el menú en pantallas pequeñas */
@media (max-width: 991.98px) { /* lg y menor */
    .mobile {
        display: block;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }
    

    .mobile ul {
        padding: 0;
    }

    .mobile ul li {
        margin-bottom: 15px;
    }

    .mobile ul li a {
        text-decoration: none;
        color: white;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .mobile ul li a i {
        margin-right: 10px;
        font-size: 20px;
    }
}

</style>


