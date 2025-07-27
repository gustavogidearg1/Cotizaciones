@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h2>Detalle de Provincia</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $provincia->id }}</p>
            <p><strong>Provincia:</strong> {{ $provincia->provincia }}</p>
            <p><strong>País:</strong> {{ $provincia->pais->pais ?? 'Sin país' }}</p>
            <p><strong>Creado:</strong> {{ $provincia->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $provincia->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('provincia.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
