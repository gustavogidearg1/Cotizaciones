@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->nombre }}</h5>
            <p class="card-text"><strong>Código:</strong> {{ $producto->codigo }}</p>
            <p class="card-text"><strong>Unidad:</strong> {{ $producto->unidad->nombre }}</p>
            <p class="card-text"><strong>Detalle:</strong> {{ $producto->detalle }}</p>
            <p class="card-text"><strong>Familia:</strong> {{ $producto->familia->nombre }}</p>
            <p class="card-text"><strong>Tipo:</strong> {{ $producto->tipo->nombre }}</p>
            <p class="card-text"><strong>Activo:</strong> {{ $producto->activo ? 'Sí' : 'No' }}</p>
            <p class="card-text"><strong>Creado por:</strong> {{ $producto->user->name }}</p>

            <!-- Sección de imágenes mejorada -->
            @if($producto->img || $producto->img_1 || $producto->img_2 || $producto->img_3)
            <div class="row mt-3">
                @if($producto->img)
                <div class="col-md-3 mb-3">
                    <h5>Imagen Principal</h5>
                    <img src="{{ asset($producto->img) }}" alt="Imagen principal" class="img-thumbnail w-100">
                    <small class="text-muted">{{ basename($producto->img) }}</small>
                </div>
                @endif

                @if($producto->img_1)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 2</h5>
                    <img src="{{ asset($producto->img_1) }}" alt="Imagen 2" class="img-thumbnail w-100">
                    <small class="text-muted">{{ basename($producto->img_1) }}</small>
                </div>
                @endif

                @if($producto->img_2)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 3</h5>
                    <img src="{{ asset($producto->img_2) }}" alt="Imagen 3" class="img-thumbnail w-100">
                    <small class="text-muted">{{ basename($producto->img_2) }}</small>
                </div>
                @endif

                @if($producto->img_3)
                <div class="col-md-3 mb-3">
                    <h5>Imagen 4</h5>
                    <img src="{{ asset($producto->img_3) }}" alt="Imagen 4" class="img-thumbnail w-100">
                    <small class="text-muted">{{ basename($producto->img_3) }}</small>
                </div>
                @endif
            </div>
            @else
            <div class="alert alert-info mt-3">Este producto no tiene imágenes asociadas.</div>
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
