@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h1><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Color</h1>

    <form action="{{ route('colores.store') }}" method="POST">
        @csrf

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                   maxlength="50" placeholder="Ej: Rojo, Azul, Verde...">
                            <small class="text-muted">Máximo 50 caracteres</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                   maxlength="50" placeholder="Opcional (ej: RGB, código, etc.)">
                            <small class="text-muted">Máximo 50 caracteres</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('colores.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
