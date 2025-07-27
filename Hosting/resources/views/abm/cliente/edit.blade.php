@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Editar Cliente</h1>

    <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id">Id</label>
            <input type="number" class="form-control" id="id" name="id" value="{{ $cliente->id }}" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}" required>
        </div>

        <div class="form-group">
            <label for="localidad">Localidad</label>
            <input type="text" class="form-control" id="localidad" name="localidad" value="{{ $cliente->localidad->localidad }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
