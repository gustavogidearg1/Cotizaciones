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
            <div class="col-md-12">
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
                                <h4 class="text-success">{{ __('隆Bienvenido!') }}</h4>
                                <p class="mb-0">{{ __('Has iniciado sesion correctamente.') }}</p>
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


                            <a href="{{ route('pedidos.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Nuevas Cotizaciones
                            </a>
                            

        <a href="{{ route('cotizaciones.buscar_producto') }}" class="btn btn-info">
            <i class="bi bi-search"></i> Buscar Producto
        </a>




<hr class="my-4">
<h5 class="text-center">Resumen de Cotizaciones </h5>
<div class="row">
    <div class="col-md-6">
        <h6>Top 10 productos</h6>
        <canvas id="graficoImplementos"></canvas>
    </div>
    <div class="col-md-6">
        <h6>Cotizaciones por Usuario</h6>
        <canvas id="graficoUsuarios"></canvas>
    </div>
</div>





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
    
    

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>


<script>
    const porImplemento = @json($porImplemento);
    const porUsuario = @json($porUsuario);
    const porMes = @json($porMes);

    // ✅ Registrar el plugin desde window (UMD)
    Chart.register(window.ChartDataLabels);

    const opcionesBarraConEtiquetas = {
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'top',
                color: '#000',
                font: {
                    weight: 'bold'
                },
                formatter: value => value
            },
            legend: {
                display: false
            }
        },
scales: {
    y: {
        beginAtZero: true,
        // Esto suma un 10% extra al máximo (puede ajustar el factor según necesidad)
        afterDataLimits: scale => {
            scale.max = scale.max * 1.1;
        }
    }
}
    };

    // 🟠 Productos
    new Chart(document.getElementById('graficoImplementos'), {
        type: 'bar',
        data: {
            labels: porImplemento.map(i => i.producto),
            datasets: [{
                label: 'Cantidad',
                data: porImplemento.map(i => i.cantidad),
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: opcionesBarraConEtiquetas,
        plugins: [window.ChartDataLabels]
    });

    // 🟢 Usuarios
    new Chart(document.getElementById('graficoUsuarios'), {
        type: 'bar',
        data: {
            labels: porUsuario.map(i => i.usuario),
            datasets: [{
                label: 'Cantidad',
                data: porUsuario.map(i => i.cantidad),
                backgroundColor: 'rgba(255, 159, 64, 0.6)'
            }]
        },
        options: opcionesBarraConEtiquetas,
        plugins: [window.ChartDataLabels]
    });
</script>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
