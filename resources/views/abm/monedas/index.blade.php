@extends('layouts.app')

@section('content')
<div class="container">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <h2>Listado de Monedas</h2>
    <a href="{{ route('monedas.create') }}" class="btn btn-success mb-3">Nueva Moneda</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Moneda</th>
                <th>Descripción</th>
                <th>Tipo de Cambio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monedas as $moneda)
                <tr>
                    <td>{{ $moneda->moneda }}</td>
                    <td>{{ $moneda->desc_ampliada }}</td>
                    <td>{{ $moneda->tipo_cambio }}</td>
                    <td>
                        <a href="{{ route('monedas.edit', $moneda) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('monedas.destroy', $moneda) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
