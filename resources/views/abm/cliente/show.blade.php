@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Detalles del cliente</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $cliente->nombre }}</h5>
            <p class="card-text"><strong>id:</strong> {{ $cliente->id }}</p>
            <p class="card-text"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p class="card-text"><strong>Localidad:</strong> {{ $cliente->localidad->localidad }}</p>
            <p class="card-text"><strong>Provincia:</strong> {{ $cliente->provincia->provincia }}</p>
            <p class="card-text"><strong>Telefono:</strong> {{ $cliente->telefono }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $cliente->email }}</p>
            <p class="card-text"><strong>Contacto:</strong> {{ $cliente->contacto }}</p>
            <p class="card-text"><strong>Concesionario:</strong> {{ $cliente->concesionario ? 'Sí' : 'No' }}</p>
            <p class="card-text"><strong>Categoria:</strong> {{ $cliente->categoria->categoria }}</p>
            <p class="card-text"><strong>Descuento:</strong> {{ $cliente->descuento }}</p>
            <p class="card-text"><strong>Creado por:</strong> {{ $cliente->user->name }}</p>

            @if($cliente->img)
                <img src="{{ $cliente->img }}" alt="Imagen principal" class="img-thumbnail" style="max-width: 200px;">
            @endif

            <div class="mt-3">
                <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
