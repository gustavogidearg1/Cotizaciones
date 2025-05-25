@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h2>Detalle del País</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $pais->id }}</h5>
            <p class="card-text"><strong>Nombre:</strong> {{ $pais->pais }}</p>
            <p class="card-text"><strong>Creado:</strong> {{ $pais->created_at }}</p>
            <p class="card-text"><strong>Actualizado:</strong> {{ $pais->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('pais.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
