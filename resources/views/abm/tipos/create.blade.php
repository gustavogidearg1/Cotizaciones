@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>{{ isset($tipo) ? 'Editar Tipo' : 'Nuevo Tipo' }}</h1>

    <form method="POST" action="{{ isset($tipo) ? route('tipos.update', $tipo) : route('tipos.store') }}">
        @csrf
        @if(isset($tipo))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $tipo->nombre ?? '') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ isset($tipo) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('tipos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
@endsection
