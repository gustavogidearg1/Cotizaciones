@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        
         <!-- Sección de imágenes -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen Principal</h5>
                        @if($producto->img)
                            <img src="{{ $producto->img }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img" name="remove_img">
                                <label class="form-check-label" for="remove_img">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img" name="img" accept="image/*">
                        <small class="form-text text-muted">Formatos: jpeg, png, jpg, gif. Max: 2MB</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 2</h5>
                        @if($producto->img_1)
                            <img src="{{ $producto->img_1 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_1" name="remove_img_1">
                                <label class="form-check-label" for="remove_img_1">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_1" name="img_1" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 3</h5>
                        @if($producto->img_2)
                            <img src="{{ $producto->img_2 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_2" name="remove_img_2">
                                <label class="form-check-label" for="remove_img_2">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_2" name="img_2" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 4</h5>
                        @if($producto->img_3)
                            <img src="{{ $producto->img_3 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_3" name="remove_img_3">
                                <label class="form-check-label" for="remove_img_3">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_3" name="img_3" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    @if ($ultimoPrecio)
        <div class="card">
            <div class="card-header bg-light">Última Cotización</div>
            <div class="card-body">
                <p><strong>Cotización:</strong> {{ $ultimoPrecio->cotizacion->cotizacion }}</p>
                <p><strong>Precio:</strong> ${{ number_format($ultimoPrecio->precio_bonificado, 2) }}</p>
                <p><strong>Moneda:</strong> {{ $ultimoPrecio->moneda->moneda ?? 'Sin moneda' }}</p>
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ultimoPrecio->cotizacion->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-info">Este producto aún no tiene precios registrados en cotizaciones.</div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver al inicio</a>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
@endsection
