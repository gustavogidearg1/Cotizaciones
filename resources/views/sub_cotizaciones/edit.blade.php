@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Editar producto en Cotización #{{ $cotizacion->id }}</h3>
    <a href="{{ route('cotizaciones.show', $cotizacion) }}" class="btn btn-outline-secondary">Volver</a>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('cotizaciones.sub_cotizaciones.update', [$cotizacion, $subCotizacion]) }}">
        @csrf
        @method('PUT')

        <!-- mismos campos que create, pero con $subCotizacion -->
        <!-- ... -->
      </form>
    </div>
  </div>
</div>
@endsection
