@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Crear Nueva Familia</h1>

    <form action="{{ route('familias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="imagen_principal">Imagen Principal</label>
            <input type="file" class="form-control-file" id="imagen_principal" name="imagen_principal">
        </div>

        <div class="form-group">
            <label for="imagen_secundaria">Imagen Secundaria</label>
            <input type="file" class="form-control-file" id="imagen_secundaria" name="imagen_secundaria">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('familias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
