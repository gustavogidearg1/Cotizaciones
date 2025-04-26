@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <h1>Crear Nuevo Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255" required>
        </div>

        <div class="form-group">
            <label for="um_id">Unidad de Medida</label>
            <select class="form-control" id="um_id" name="um_id" required>
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="detalle">Detalle</label>
            <textarea class="form-control" id="detalle" name="detalle" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="img">Imagen Principal</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*">
            <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
        </div>

        <div class="form-group">
            <label for="img_1">Imagen 2</label>
            <input type="file" class="form-control" id="img_1" name="img_1" accept="image/*">
        </div>

        <div class="form-group">
            <label for="img_2">Imagen 3</label>
            <input type="file" class="form-control" id="img_2" name="img_2" accept="image/*">
        </div>

        <div class="form-group">
            <label for="img_3">Imagen 4</label>
            <input type="file" class="form-control" id="img_3" name="img_3" accept="image/*">
        </div>

        <div class="form-group">
            <label for="familia_id">Familia</label>
            <select class="form-control" id="familia_id" name="familia_id" required>
                @foreach($familias as $familia)
                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="activo">Activo</label>
            <select class="form-control" id="activo" name="activo" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_id">Tipo</label>
            <select class="form-control" id="tipo_id" name="tipo_id" required>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
