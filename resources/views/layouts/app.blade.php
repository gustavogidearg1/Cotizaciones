<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Cotizacion de Comofra'))</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    <style>
        :root {
            --primary-color: #3490dc;
            --secondary-color: #6c757d;
            --success-color: #38c172;
            --danger-color: #e3342f;
        }

        .navbar-bg {
            position: relative;
            background-image: url('{{ asset('images/FondoMenu.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            z-index: 1;
        }

        .navbar-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .navbar .container,
        .navbar .navbar-brand,
        .navbar .navbar-toggler,
        .navbar .navbar-collapse {
            position: relative;
            z-index: 3;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #fff !important;
            height: 100%;
        }

        .navbar .nav-link:hover {
            color: #f0f0f0 !important;
        }

        .navbar-toggler-icon {
            filter: invert(100%);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }

        .dropdown-divider {
            margin: 0.3rem 0;
        }

        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
        }
    </style>

</head>

@stack('scripts')

<body>


    <div id="app">
        <nav class="navbar navbar-expand-lg shadow-sm navbar-bg py-2">
            <div class="container">
                <!-- Logo y nombre -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/Isologotipo_con_anclaje_lateral_Negativo_RGB.png') }}" alt="Logo"
                        height="40" class="me-2">

                </a>

                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del menú -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Menú izquierdo (opcional) -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (auth()->user()->role_id == 1)
                                <!-- Menú desplegable ABM -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarABM" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear"></i> ABM
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarABM">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                                <i class="bi bi-people"></i> Usuarios
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('forma-pagos.index') }}">
                                                <i class="bi-credit-card"></i> Forma de Pago
                                            </a>
                                        </li>

                                        <!-- Puedes agregar más items aquí -->
                                        <li>
                                            <a class="dropdown-item" href="{{ route('colores.index') }}">
                                                <i class="bi bi-palette"></i> Colores
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('familias.index') }}">
                                                <i class="bi bi-collection"></i> Familias
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('monedas.index') }}">
                                                <i class="bi bi-currency-dollar"></i> Monedas
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('pais.index') }}">
                                                <i class="bi bi-globe"></i> Países
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('provincia.index') }}">
                                                <i class="bi bi-map"></i> Provincias
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('localidad.index') }}">
                                                <i class="bi bi-geo-alt"></i> Localidades
                                            </a>
                                        </li>


                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('productos.index') }}">
                                        <i class="bi bi-box-seam"></i> Productos
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cotizaciones.index') }}">
                                        <i class="bi bi-file-earmark-text"></i> Costos
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pedidos.index') }}">
                                        <i class="bi bi-file-earmark-text"></i> Costizaciones
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Menú derecho -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/home') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Panel
                                    </a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-left me-2"></i> {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
