@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h2>Editar Provincia</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('provincia.update', $provincia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="provincia" class="form-label">Nombre de la Provincia</label>
            <input type="text" name="provincia" class="form-control" value="{{ old('provincia', $provincia->provincia) }}" required>
        </div>

        <div class="mb-3">
            <label for="pais_id" class="form-label">País</label>
            <select name="pais_id" class="form-select" required>
                <option value="">Seleccione un país</option>
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}" {{ old('pais_id', $provincia->pais_id) == $pais->id ? 'selected' : '' }}>
                        {{ $pais->pais }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('provincia.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
