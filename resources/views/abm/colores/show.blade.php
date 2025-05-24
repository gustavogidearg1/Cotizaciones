@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h1><i class="fas fa-eye me-2"></i>Detalle del Color</h1>

    <div class="card mt-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nombre:</dt>
                <dd class="col-sm-9">{{ $color->nombre }}</dd>

                <dt class="col-sm-3">Descripción:</dt>
                <dd class="col-sm-9">{{ $color->descripcion ?? 'Sin descripción' }}</dd>

<dt class="col-sm-3">Creado el:</dt>
<dd class="col-sm-9">
    {{ $color->created_at ? $color->created_at->format('d/m/Y H:i') : 'No disponible' }}
</dd>

<dt class="col-sm-3">Última modificación:</dt>
<dd class="col-sm-9">
    {{ $color->updated_at ? $color->updated_at->format('d/m/Y H:i') : 'No disponible' }}
</dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('colores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('colores.edit', $color->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
