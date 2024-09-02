<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('css/styledashboard.css') }}">
    @livewireStyles

</head>
<body>
@livewireScripts
    <header class="header">
        <span class="hamburger-menu material-symbols-outlined">menu</span>
        <div class="admin-title">
            @if(Auth::user()->can('agregarAdministrador'))
                <p>Administrador</p>
            @elseif(Auth::user()->can('solicitarHerramienta'))
                <p>Instructor</p>
            @else
                <p>Sin permisos específicos</p>
            @endif
        </div>
        <div class="search-container">
            <input type="text" placeholder="Buscar...">
            <span class="search-icon"><i class="fas fa-search"></i></span>
        </div>
        <div class="user-info">
            @auth
                @if (Auth::user()->currentTeam)
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </span>
                @endif
            @endauth 
        </div>        
    </header>

    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="img/senalogo.png" alt="">
            <h2>FESTO</h2>
        </div>
        <ul class="sidebar-links">
            <h4>
                <span>Menu</span>
                <div class="menu-separator"></div>
            </h4>
            <li>
                <a href="/dashboard"><span class="material-symbols-outlined">home</span>Home</a>
            </li>
            <li>
                <a href="#"><span class="material-symbols-outlined">build</span>Herramientas</a>
            </li>
            <li>
                <a href="#"><span class="material-symbols-outlined">folder</span>Solicitudes</a>
            </li>
            @can('crearHerramienta')
            <li>
                <a href="#"><span class="material-symbols-outlined">groups</span>Administradores</a>
            </li>
            @endcan
            <h4>
                <span>Account</span>
                <div class="menu-separator"></div>
            </h4>
            <li>
                <a href="{{ route('profile.show') }}"><span class="material-symbols-outlined">account_circle</span>Perfil</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"><span class="material-symbols-outlined">logout</span>Cerrar Sesión</a>
                </form>
            </li>
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