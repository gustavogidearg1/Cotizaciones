@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->nombre }}</h5>
            @if($producto->links)
    <p class="card-text"><strong>Links:</strong> <a href="{{ $producto->links }}" target="_blank">{{ $producto->links }}</a></p>
@endif
            <p class="card-text"><strong>Código:</strong> {{ $producto->codigo }} - <strong>Unidad:</strong> {{ $producto->unidad->nombre }}</p>
            <p class="card-text"><strong>Detalle:</strong> {{ $producto->detalle }}</p>
            <p class="card-text"><strong>Familia:</strong> {{ $producto->familia->nombre }} - <strong>Tipo:</strong> {{ $producto->tipo->nombre }} - <strong>Activo:</strong> {{ $producto->activo ? 'Sí' : 'No' }}</p>
            <p class="card-text">
    <strong>Creado por:</strong>
    {{ $producto->user?->name ?? 'Sin asignar' }}
</p>


            <!-- Sección de imágenes mejorada -->
            @if($producto->img || $producto->img_1 || $producto->img_2 || $producto->img_3)
            <div class="row mt-3">
                @if($producto->img)
                <div class="col-md-3 mb-3">
                    <h5>Imagen Principal</h5>
                    <img src="{{ asset($producto->img) }}" alt="Imagen principal" class="img-thumbnail w-100">

                </div>
                @endif

                @if($producto->img_1)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 2</h5>
                    <img src="{{ asset($producto->img_1) }}" alt="Imagen 2" class="img-thumbnail w-100">

                </div>
                @endif

                @if($producto->img_2)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 3</h5>
                    <img src="{{ asset($producto->img_2) }}" alt="Imagen 3" class="img-thumbnail w-100">

                </div>
                @endif

                @if($producto->img_3)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 4</h5>
                    <img src="{{ asset($producto->img_3) }}" alt="Imagen 4" class="img-thumbnail w-100">

                </div>
                @endif
            </div>
            @else
            <div class="alert alert-info mt-3">Este producto no tiene imágenes asociadas.</div>
            @endif






@if($producto->volumen_carga_m3)
    <p class="card-text"><strong>Volumen de Carga (m³):</strong> {{ $producto->volumen_carga_m3 }}</p>
@endif

@if($producto->potencia_requerida_hp)
    <p class="card-text"><strong>Potencia Requerida (HP):</strong> {{ $producto->potencia_requerida_hp }}</p>
@endif

@if($producto->toma_potencia_tom)
    <p class="card-text"><strong>Toma de Potencia (R.P.M):</strong> {{ $producto->toma_potencia_tom }}</p>
@endif

@if($producto->tiempo_descarga_aprx_min)
    <p class="card-text"><strong>Tiempo de Descarga Aprox. (min):</strong> {{ $producto->tiempo_descarga_aprx_min }}</p>
@endif

@if($producto->balanza)
    <p class="card-text"><strong>Balanza:</strong> {{ $producto->balanza }}</p>
@endif

@if($producto->camaras)
    <p class="card-text"><strong>Cámaras:</strong> {{ $producto->camaras }}</p>
@endif

@if($producto->altura_maxima_mm)
    <p class="card-text"><strong>Altura Máxima (mm):</strong> {{ $producto->altura_maxima_mm }}</p>
@endif

@if($producto->altura_carga_mm)
    <p class="card-text"><strong>Altura de Carga (mm):</strong> {{ $producto->altura_carga_mm }}</p>
@endif

@if($producto->longitud_total_mm)
    <p class="card-text"><strong>Longitud Total (mm):</strong> {{ $producto->longitud_total_mm }}</p>
@endif

@if($producto->peso_vacio_kg)
    <p class="card-text"><strong>Peso en Vacío (kg):</strong> {{ $producto->peso_vacio_kg }}</p>
@endif

@if($producto->de_serie)
    <p class="card-text"><strong>De Serie:</strong> {{ $producto->de_serie }}</p>
@endif

@if($producto->opcional)
    <p class="card-text"><strong>Opcional:</strong> {{ $producto->opcional }}</p>
@endif

@if($producto->colores)
    <p class="card-text"><strong>Colores:</strong> {{ $producto->colores }}</p>
@endif

            <div class="mt-3">
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
