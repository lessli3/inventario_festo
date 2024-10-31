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


    <link rel="stylesheet" href="{{ asset('css/styledashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styletools.css') }}">
    @livewireStyles

</head>
<body>
@livewireScripts
<div class="row mt-3">
    <header class="header d-flex align-items-center" style="z-index: 1">
        <span class="hamburger-menu material-symbols-outlined">menu</span>
        @auth
        @if (Auth::user())
        <div class="col-md-5 ms-auto d-flex align-items-center">
            @can('solicitarHerramienta')
                <!-- Contador de solicitudes -->
                <div class="Usuario me-2" style="margin-left: 7%">
                    <livewire:solicitud-contador />
                </div>
            @endcan
            @can('editarSolicitud')
                <!-- Contador de solicitudes -->
                <div class="Usuario me-2" style="margin-left: 7%">
                    <div style="background-color: rgb(25, 161, 13); width: 48px; border-radius: 50%; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
                        <a href="/solicitudIndex" style="color: rgb(242, 243, 243);">
                            <i class="fas fa-clipboard-check icono" style="font-size: 25px;"></i>
                        </a>
                    </div>
                </div>
            @endcan
            @can('crearHerramienta')
                <!-- Contador de solicitudes -->
                <div class="Usuario me-2" style="margin-left: 7%">
                    <div style="background-color: rgb(25, 161, 13); width: 48px; border-radius: 50%; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
                        <a href="/herramientas" style="color: rgb(242, 243, 243);">
                            <i class="fas fa-tools icono" style="font-size: 25px;"></i>
                        </a>
                    </div>
                </div>
            @endcan
            
            <!-- Contenedor del usuario -->
            <div class="user d-flex align-items-center mx-3" style="background-color: #b5b8b477; border-radius: 15px; color: rgb(25, 161, 13); height: 55px; width: 200px;justify-content: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); padding: 1%;">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                     <!-- Círculo con la inicial del nombre -->
                     <div class="user-b inline-flex justify-center items-center fw-bold pb-1 ms-1" style="background-color: rgb(25, 161, 13);border-radius: 50%;height: 40px;text-align: center;width: 40px;align-content: center; color:white; font-size: 22px">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }} <!-- Mostrar la inicial en mayúscula -->
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Botón con el nombre completo -->
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


    <aside class="sidebar">
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
            @canany(['solicitarHerramienta', 'editarSolicitud'])
                <li>
                    <a href="/solicitudIndex">
                        <span class="material-symbols-outlined">folder</span>Solicitudes
                    </a>
                </li>
            @endcanany

            @can('editarSolicitud')
            <li>
                <a href="/calendario">
                    <span class="material-symbols-outlined">event</span>Calendario
                </a>
            </li>
            @endcan

            @can('crearHerramienta')
            <li>
                <a href="/monitores"><span class="material-symbols-outlined">groups</span>Monitores</a>
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
        document.querySelector('.hamburger-menu').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>


