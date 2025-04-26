@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Familia</h1>

    <form action="{{ route('familias.update', $familia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                   value="{{ old('nombre', $familia->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Imagen Principal</label>
            @if($familia->imagen_principal)
                <div class="mb-2">
                    <img src="{{ $familia->imagen_principal }}"
                         alt="Imagen principal"
                         style="max-width: 200px; height: auto;">
                    <div class="mt-1">
                        <label class="text-danger">
                            <input type="checkbox" name="remove_imagen_principal">
                            Eliminar imagen actual
                        </label>
                    </div>
                </div>
            @endif
            <input type="file" class="form-control-file"
                   id="imagen_principal" name="imagen_principal">
            @error('imagen_principal')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">
                Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
            </small>
        </div>

        <div class="form-group">
            <label>Imagen Secundaria</label>
            @if($familia->imagen_secundaria)
                <div class="mb-2">
                    <img src="{{ $familia->imagen_secundaria }}"
                         alt="Imagen secundaria"
                         style="max-width: 200px; height: auto;">
                    <div class="mt-1">
                        <label class="text-danger">
                            <input type="checkbox" name="remove_imagen_secundaria">
                            Eliminar imagen actual
                        </label>
                    </div>
                </div>
            @endif
            <input type="file" class="form-control-file"
                   id="imagen_secundaria" name="imagen_secundaria">
            @error('imagen_secundaria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">
                Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('familias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
