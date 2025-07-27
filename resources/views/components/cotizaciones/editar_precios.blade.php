@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Productos de la Última Cotización</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('cotizaciones.editar_precios') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto por nombre o código"
                   value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
    </form>

    @if($subCotizaciones->count())
    <form method="POST" action="{{ route('cotizaciones.guardar_precios') }}">
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Moneda</th>
                    <th>Precio</th>
                    <th>Precio Bonificado</th>
                    <th>Detalle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCotizaciones as $sub)
                <tr>
                    <td>{{ $sub->producto->nombre ?? '-' }}</td>
                    <td>{{ $sub->moneda->nombre ?? '-' }}</td>
                    <td>
                        <input type="number" step="0.01" name="productos[{{ $sub->id }}][precio]" value="{{ old('productos.'.$sub->id.'.precio', $sub->precio) }}" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="productos[{{ $sub->id }}][precio_bonificado]" value="{{ old('productos.'.$sub->id.'.precio_bonificado', $sub->precio_bonificado) }}" class="form-control" required>
                    </td>
                    <td>
                        <input type="text" name="productos[{{ $sub->id }}][detalle]" value="{{ old('productos.'.$sub->id.'.detalle', $sub->detalle) }}" class="form-control">
                    </td>
                    <td>
                        <a href="{{ route('cotizaciones.consulta_producto', $sub->producto_id) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="Ver producto">
                            <i class="bi bi-search"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
                {{ $subCotizaciones->appends(['buscar' => request('buscar')])->links('pagination::bootstrap-5') }}
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Guardar Cambios
            </button>
        </div>
    </form>
    @else
        <div class="alert alert-info mt-4">
            No hay productos para editar en la última cotización.
        </div>
    @endif
</div>
@endsection
