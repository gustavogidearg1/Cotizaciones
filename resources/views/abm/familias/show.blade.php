@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Familia</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $familia->nombre }}</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Imagen Principal</h6>
                    @if($familia->imagen_principal)
                        <img src="{{ $familia->imagen_principal }}" alt="Imagen principal" class="img-fluid">
                    @else
                        <p>No hay imagen principal</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6>Imagen Secundaria</h6>
                    @if($familia->imagen_secundaria)
                        <img src="{{ $familia->imagen_secundaria }}" alt="Imagen secundaria" class="img-fluid">
                    @else
                        <p>No hay imagen secundaria</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('familias.edit', $familia->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('familias.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
