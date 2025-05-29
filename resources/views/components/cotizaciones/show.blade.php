@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-orange {
            background-color: #FF9900 !important;
        }

        .imagen-logo {
            height: 40px;
        }
    </style>

    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-orange text-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <img src="{{ asset('images/Isologotipo con anclaje. Negro CMYK.png') }}" alt="Logo"
                            height="50">
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="mb-0">Lista de costo #{{ $cotizacion->cotizacion }}</h2>
                    </div>
                </div>
            </div>

<div class="row m-2 d-flex justify-content-between align-items-start">
    <div class="col-md-6">
        <p>LISTA DE PRECIO SIN IVA</p>
        <p>EQUIPOS: +IVA 10,5%</p>
        <p>EQUIPOS CON OPCIONALES: +IVA 10,5%</p>
        <p>OPCIONALES SUELTOS: +IVA 21%</p>
    </div>
    <div class="col-md-6 text-end">
        <p><strong>FECHA VIGENCIA:</strong>
            {{ $cotizacion->vencimiento ? \Carbon\Carbon::parse($cotizacion->vencimiento)->format('d/m/Y') : 'N/A' }}
        </p>

        <p><strong>MONEDA:</strong>
            <strong style="color: red">"DOLARES"</strong>
        </p>

        <p>
            <img src="{{ asset('images/logo-iram-iso.jpg') }}" alt="Logo" height="100">
        </p>
    </div>
</div>




        </div>

        @if ($cotizacion->subCotizaciones && $cotizacion->subCotizaciones->count() > 0)
            <div class="table-responsive mt-3">
                @php
                    $agrupados = $cotizacion->subCotizaciones
                        ->filter(fn($item) => $item->producto)
                        ->sortBy(fn($item) => $item->producto->nombre)
                        ->groupBy(fn($item) => $item->producto->familia->nombre ?? 'Sin familia')
                        ->map(function ($grupoFamilia) {
                            return $grupoFamilia->groupBy(fn($item) => $item->producto->tipo->nombre ?? 'Sin tipo');
                        });
                @endphp


                @foreach ($agrupados as $nombreFamilia => $tipos)
                    <div class="card mt-4">
                        <div class="card-header bg-orange text-white">
                            <h2 class="mb-0">{{ $nombreFamilia }}</h2>
                        </div>

                        @foreach ($tipos as $nombreTipo => $subCotizaciones)
                            <div class="card-header bg-white border-bottom">
                                <strong>{{ $nombreTipo }}</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Código</th>
                                            <th>Producto</th>
                                            <th>Moneda</th>
                                            <th>Precio</th>
                                            <th>Precio Bonif.</th>
                                            <th>Descuento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subCotizaciones as $subCotizacion)
                                            <tr>
                                                <td>{{ $subCotizacion->producto->codigo ?? 'N/A' }}</td>
                                                <td>{{ $subCotizacion->producto->nombre ?? 'N/A' }}</td>
                                                <td>{{ $subCotizacion->moneda->moneda ?? 'N/A' }}</td>
                                                <td>${{ number_format($subCotizacion->precio, 2, ',', '.') }}</td>
                                                <td>${{ number_format($subCotizacion->precio_bonificado, 2, ',', '.') }}
                                                </td>
                                                <td>{{ number_format($subCotizacion->descuento, 2, ',', '.') }}%</td>
                                            </tr>
                                            @if (!empty($subCotizacion->producto->detalle))
                                                <tr>
                                                    <td colspan="6" class="bg-light">
                                                        <strong>Detalle:</strong> {{ $subCotizacion->producto->detalle }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            <div class="row m-2">

                <div class="col-md-6">
                    <p><strong>Descripción:</strong> {{ $cotizacion->descripcion }}</p>
                    <p><strong>Observaciones:</strong> {{ $cotizacion->observacion ?? 'N/A' }}</p>

                </div>

                <div class="col-md-6">
                    <p><strong>Creada por:</strong> {{ $cotizacion->user->name ?? 'N/A' }}</p>
                    <p><strong>Fecha creación:</strong> {{ $cotizacion->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>

                </div>


            </div>
            </div>
        @else
            <div class="alert alert-info mt-3">No hay productos asociados a esta cotización</div>
        @endif

        <div class="mt-4 d-flex gap-2 flex-wrap">
            <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="#" onclick="printCotizacion()" class="btn btn-info">
                <i class="fas fa-print"></i> Imprimir Cotización
            </a>
        </div>
    </div>

    <script>
        function printCotizacion() {
            const header = document.querySelector('header');
            const nav = document.querySelector('nav');
            const footer = document.querySelector('footer');
            const buttons = document.querySelectorAll('.btn');

            if (header) header.style.display = 'none';
            if (nav) nav.style.display = 'none';
            if (footer) footer.style.display = 'none';
            buttons.forEach(btn => btn.style.display = 'none');

            window.print();

            setTimeout(() => {
                if (header) header.style.display = '';
                if (nav) nav.style.display = '';
                if (footer) footer.style.display = '';
                buttons.forEach(btn => btn.style.display = '');
            }, 1000);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
