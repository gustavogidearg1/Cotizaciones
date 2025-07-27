@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


<div class="container">
    <h2>Editar País</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Revisa los errores.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pais.update', $pais->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pais" class="form-label">Nombre del País</label>
            <input type="text" name="pais" value="{{ old('pais', $pais->pais) }}" class="form-control" required>
        </div>

        <a class="btn btn-secondary" href="{{ route('pais.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
