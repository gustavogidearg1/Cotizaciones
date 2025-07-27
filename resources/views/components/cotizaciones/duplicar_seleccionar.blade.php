@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
<div class="container mt-4">

    <h1 class="mb-4">
        <i class="fas fa-copy me-2"></i> Aumentar Última Cotización
    </h1>

    @auth
    <form method="GET" action="{{ route('cotizaciones.duplicar') }}" class="card shadow-sm border-0 p-4">
        <div class="row gy-3 gx-4 align-items-end">
            <div class="col-12 col-md-4">
                <label for="aumento" class="form-label">
                    <strong>Porcentaje de aumento a aplicar (%)</strong>
                </label>
                <input type="number" class="form-control form-control-lg" id="aumento" name="aumento" step="0.01" min="0" value="5" required>
            </div>

            <div class="col-12 col-md-4 d-grid">
                <a href="{{ route('cotizaciones.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>

            <div class="col-12 col-md-4 d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-forward"></i> Continuar
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-warning mt-4">
        <i class="fas fa-exclamation-triangle me-1"></i> Debes iniciar sesión para usar esta función.
    </div>
    @endauth

</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
@endsection
