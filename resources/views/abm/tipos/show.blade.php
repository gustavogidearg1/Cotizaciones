@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
<div class="container">
    <h1>Detalle del Tipo</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $tipo->id }}</p>
            <p><strong>Nombre:</strong> {{ $tipo->nombre }}</p>
            <p><strong>Creado:</strong> {{ $tipo->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $tipo->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('tipos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
@endsection
