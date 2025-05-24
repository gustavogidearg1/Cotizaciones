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
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="imagen-logo">
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="mb-0">Cotización #{{ $cotizacion->id }}</h2>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <p><strong>Descripción:</strong> {{ $cotizacion->descripcion }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Vencimiento:</strong>
                            {{ $cotizacion->vencimiento ? \Carbon\Carbon::parse($cotizacion->vencimiento)->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <p><strong>Observaciones:</strong> {{ $cotizacion->observacion ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Creada por:</strong> {{ $cotizacion->user->name ?? 'N/A' }}</p>
                        <p><strong>Fecha creación:</strong> {{ $cotizacion->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-orange text-white">
            <div class="card-body">
                <h4 class="mb-0">Productos de la Cotización</h4>
            </div>
        </div>

        @if ($cotizacion->subCotizaciones && $cotizacion->subCotizaciones->count() > 0)
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Moneda</th>
                            <th>Precio</th>
                            <th>Precio Bonif.</th>
                            <th>Descuento</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizacion->subCotizaciones as $subCotizacion)
                            <tr>
                                <td>{{ $subCotizacion->producto->codigo ?? 'N/A' }}</td>
                                <td>{{ $subCotizacion->producto->nombre ?? 'N/A' }}</td>
                                <td>{{ $subCotizacion->moneda->moneda ?? 'N/A' }}</td>
                                <td>${{ number_format($subCotizacion->precio, 2, ',', '.') }}</td>
                                <td>${{ number_format($subCotizacion->precio_bonificado, 2, ',', '.') }}</td>
                                <td>{{ number_format($subCotizacion->descuento, 2, ',', '.') }}%</td>
                                <td>{{ $subCotizacion->detalle ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
