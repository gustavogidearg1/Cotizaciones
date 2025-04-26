@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Cliente</h1>
    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>
        <div class="form-group">
            <label for="localidad_id">Localidad</label>
            <select class="form-control" id="localidad_id" name="localidad_id">
                @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->localidad }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="provincia_id">Provincia</label>
            <select class="form-control" id="provincia_id" name="provincia_id">
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="contacto">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto">
        </div>
        <div class="form-group">
            <label for="concesionario">Concesionario</label>
            <select class="form-control" id="concesionario" name="concesionario">
                <option value="no">No</option>
                <option value="si">Sí</option>
            </select>
        </div>
        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="descuento">Descuento (%)</label>
            <input type="number" step="0.01" class="form-control" id="descuento" name="descuento" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
