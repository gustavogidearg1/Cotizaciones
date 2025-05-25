<!-- Estilos personalizados -->
<style>
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
        background-color: rgba(0, 0, 0, 0.5); /* oscurece para contraste */
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

    /* Responsive fix para el toggler */
    .navbar-toggler-icon {
        filter: invert(100%);
    }
</style>

<!-- Navbar con fondo e imagen oscurecida -->
<nav class="navbar navbar-expand-lg shadow-sm py-3 navbar-bg">
    <div class="container">
        <!-- Logo negativo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/Isologotipo_con_anclaje_lateral_Negativo_RGB.png') }}" alt="Logo" height="40">
        </a>

        <!-- Botón para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Panel
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Acceso
                            </a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
