@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar productos y visualizar costos</h1>

    <form method="GET" action="{{ route('cotizaciones.buscar_producto') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o código"
                   value="{{ $search }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    @if ($productos->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Familia</th>
                        <th>Tipo</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->codigo }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->unidad->nombre }}</td>
                            <td>{{ $producto->familia->nombre }}</td>
                            <td>{{ $producto->tipo->nombre }}</td>
                            <td>
                               <a href="{{ url('cotizaciones/producto/' . $producto->id) }}" class="btn btn-sm btn-info">  Ver Costo
</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $productos->appends(['search' => $search])->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">No se encontraron productos con ese criterio.</div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver al inicio</a>
</div>
@endsection
