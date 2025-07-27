@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <h1>Consulta de Producto</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->nombre }}</h5>
            <p><strong>Código:</strong> {{ $producto->codigo }}</p>
            <p><strong>Unidad:</strong> {{ $producto->unidad->nombre }}</p>
            <p><strong>Familia:</strong> {{ $producto->familia->nombre }}</p>
            <p><strong>Tipo:</strong> {{ $producto->tipo->nombre }}</p>
            <p><strong>Creado por:</strong> {{ $producto->user?->name ?? 'Sin asignar' }}</p>
            <p><strong>Detalle:</strong> {{ $producto->detalle }}</p>
        </div>
    </div>

    @if ($ultimoPrecio)
        <div class="card">
            <div class="card-header bg-light">Última Cotización</div>
            <div class="card-body">
                <p><strong>ID Cotización:</strong> {{ $ultimoPrecio->cotizacion->id }}</p>
                <p><strong>Precio Bonificado:</strong> ${{ number_format($ultimoPrecio->precio_bonificado, 2) }}</p>
                <p><strong>Moneda:</strong> {{ $ultimoPrecio->moneda->descripcion ?? 'Sin moneda' }}</p>
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ultimoPrecio->cotizacion->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-info">Este producto aún no tiene precios registrados en cotizaciones.</div>
    @endif

    <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>
@endsection
