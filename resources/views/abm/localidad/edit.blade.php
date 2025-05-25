@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Localidad</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('localidad.update', $localidad->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Localidad</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $localidad->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="cp" class="form-label">Código Postal</label>
            <input type="text" name="cp" class="form-control" value="{{ old('cp', $localidad->cp) }}" required>
        </div>

        <div class="mb-3">
            <label for="provincia_id" class="form-label">Provincia</label>
            <select name="provincia_id" class="form-select" required>
                <option value="">Seleccione una provincia</option>
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}" {{ old('provincia_id', $localidad->provincia_id) == $provincia->id ? 'selected' : '' }}>
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
                    <option value="{{ $pais->id }}" {{ old('pais_id', $localidad->pais_id) == $pais->id ? 'selected' : '' }}>
                        {{ $pais->pais }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('localidad.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
