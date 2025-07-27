@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Importar Cotizacion desde CSV</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cotizaciones.importar') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre de Cotizacion*</label>
            <input type="text" name="cotizacion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripcion*</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de vencimiento*</label>
            <input type="date" name="vencimiento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Archivo CSV*</label>
            <input type="file" name="archivo_csv" class="form-control" accept=".csv" required>
        </div>

        <button type="submit" class="btn btn-primary">Importar Cotizacion</button>
        <a href="{{ route('cotizaciones.exportar.plantilla') }}" class="btn btn-outline-success mb-3">
    📥 Descargar plantilla CSV con productos
</a>
    </form>
</div>
@endsection
