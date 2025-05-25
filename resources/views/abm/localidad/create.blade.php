@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h2>Crear Localidad</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('localidad.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Localidad</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="cp" class="form-label">Código Postal</label>
            <input type="text" name="cp" class="form-control" value="{{ old('cp') }}" required>
        </div>

        <div class="mb-3">
            <label for="provincia_id" class="form-label">Provincia</label>
            <select name="provincia_id" class="form-select" required>
                <option value="">Seleccione una provincia</option>
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}" {{ old('provincia_id', 1) == $provincia->id ? 'selected' : '' }}>
                        {{ $provincia->provincia }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pais_id" class="form-label">País</label>
            <select name="pais_id" class="form-select" required>
                <option value="">Seleccione un país</option>
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}" {{ old('pais_id', 1) == $pais->id ? 'selected' : '' }}>
                        {{ $pais->pais }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('localidad.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
