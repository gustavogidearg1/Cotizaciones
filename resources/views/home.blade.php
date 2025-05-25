@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-orange {
            background-color: #FF9900 !important;

        }


    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-dashboard">
                    <div class="card-header bg-orange text-white">
                        <h5 class="mb-0">{{ __('Panel de Control') }}</h5>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="text-success">{{ __('¡Bienvenido!') }}</h4>
                                <p class="mb-0">{{ __('Has iniciado sesión correctamente.') }}</p>
                            </div>
                        </div>


                        <div class="card-header bg-orange text-white">
                            <h5 class="mb-0">{{ __('Costizaciones') }}</h5>
                        </div>


                        <div class="mt-4">
                            <h4 class="text-success">{{ __('Cotizaciones / Pedidos!') }}</h4>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-primary me-2">
                                <i class="bi bi-file-earmark-text"></i> Ver Cotizaciones / Pedidos
                            </a>


                            <a href="{{ route('pedidos.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus-circle"></i> Nuevas Cotizaciones
                            </a>





                        </div>

                        <div class="mt-4">
                            <div class="card-header bg-orange text-white">
                                <h5 class="mb-0">{{ __('Costos') }}</h5>
                            </div>
                            @if (auth()->user()->role_id == 1)
                                <h4 class="text-success">{{ __('Listado de Costos!') }}</h4>
                                <a href="{{ route('cotizaciones.index') }}" class="btn btn-primary me-2">
                                    <i class="bi bi-file-earmark-text"></i> Ver Costos
                                </a>
                                <a href="{{ route('cotizaciones.create') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-plus-circle"></i> Nueva Lista Costos
                                </a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
