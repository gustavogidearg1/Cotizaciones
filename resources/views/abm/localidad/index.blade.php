@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h2>Listado de Localidades</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('localidad.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus-circle"></i> Nueva Localidad
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código Postal</th>
                <th>Provincia</th>
                <th>País</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($localidades as $localidad)
                <tr>
                    <td>{{ $localidad->id }}</td>
                    <td>{{ $localidad->nombre }}</td>
                    <td>{{ $localidad->cp }}</td>
                    <td>{{ $localidad->provincia->provincia ?? 'Sin provincia' }}</td>
                    <td>{{ $localidad->pais->pais ?? 'Sin país' }}</td>
                    <td>
                        <a href="{{ route('localidad.show', $localidad->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('localidad.edit', $localidad->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('localidad.destroy', $localidad->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar localidad?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
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
