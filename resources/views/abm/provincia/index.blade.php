@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h2>Listado de Provincias</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('provincia.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Nueva Provincia
    </a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Provincia</th>
                <th>País</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($provincias as $provincia)
                <tr>
                    <td>{{ $provincia->id }}</td>
                    <td>{{ $provincia->provincia }}</td>
                    <td>{{ $provincia->pais->pais ?? 'Sin país' }}</td>
                    <td>
                        <a href="{{ route('provincia.show', $provincia->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('provincia.edit', $provincia->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('provincia.destroy', $provincia->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar provincia?')">Eliminar</button>
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
