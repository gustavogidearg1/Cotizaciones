@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h1>Detalle de Cotización</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $cotizacion->cotizacion }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $cotizacion->descripcion }}</p>
            <p><strong>Vencimiento:</strong>
                @if($cotizacion->vencimiento)
                    {{ \Carbon\Carbon::parse($cotizacion->vencimiento)->format('d/m/Y') }}
                @else
                    N/A
                @endif
            </p>
            <p><strong>Observaciones:</strong> {{ $cotizacion->observacion ?? 'N/A' }}</p>
            <p><strong>Creada por:</strong> {{ $cotizacion->user->name ?? 'N/A' }}</p>
            <p><strong>Fecha creación:</strong>
                @if($cotizacion->created_at)
                    {{ $cotizacion->created_at->format('d/m/Y H:i') }}
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>

    <h3>Productos</h3>
    @if($cotizacion->subCotizaciones && $cotizacion->subCotizaciones->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
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
                    @foreach($cotizacion->subCotizaciones as $subCotizacion)
                    <tr>
                        <td>{{ $subCotizacion->producto->codigo ?? 'N/A' }}</td>
                        <td>{{ $subCotizacion->producto->nombre ?? 'N/A' }}</td>
                        <td>{{ $subCotizacion->moneda->moneda ?? 'N/A' }}</td>
                        <td>{{ number_format($subCotizacion->precio, 2, ',', '.') }}</td>
                        <td>{{ number_format($subCotizacion->precio_bonificado, 2, ',', '.') }}</td>
                        <td>{{ number_format($subCotizacion->descuento, 2, ',', '.') }}%</td>
                        <td>{{ $subCotizacion->detalle ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hay productos asociados a esta cotización</div>
    @endif

    <div class="mt-3">
        <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">Volver</a>
        <a href="#" onclick="printPedido()" class="btn btn-info">
            <i class="bi bi-printer"></i> Imprimir Listado
        </a>
    </div>
</div>
@push('scripts')
<script>



function printPedido() {
        // Ocultar elementos que no se quieren imprimir
        const header = document.querySelector('header'); // el layout de Laravel generalmente usa <header>
        const nav = document.querySelector('nav');
        const footer = document.querySelector('footer');
        const buttons = document.querySelectorAll('.btn');

        if (header) header.style.display = 'none';
        if (nav) nav.style.display = 'none';
        if (footer) footer.style.display = 'none';
        buttons.forEach(btn => btn.style.display = 'none');

        // Imprimir
        window.print();

        // Restaurar los elementos
        setTimeout(() => {
            if (header) header.style.display = '';
            if (nav) nav.style.display = '';
            if (footer) footer.style.display = '';
            buttons.forEach(btn => btn.style.display = '');
        }, 1000); // espera a que termine la impresión
    }
</script>


    @endpush

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
