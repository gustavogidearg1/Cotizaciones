@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Agregar producto a Cotización #{{ $cotizacion->id }} ({{ $cotizacion->cotizacion }})</h3>
    <a href="{{ route('cotizaciones.show', $cotizacion) }}" class="btn btn-outline-secondary">Volver</a>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('cotizaciones.sub_cotizaciones.store', $cotizacion) }}">
        @csrf

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Producto</label>
            <select name="producto_id" class="form-select @error('producto_id') is-invalid @enderror" required>
              <option value="">-- Elegir --</option>
              @foreach($productos as $p)
                <option value="{{ $p->id }}" @selected(old('producto_id') == $p->id)>
                  {{ $p->codigo ?? '' }} - {{ $p->nombre }}
                </option>
              @endforeach
            </select>
            @error('producto_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Moneda</label>
            <select name="moneda_id" class="form-select @error('moneda_id') is-invalid @enderror" required>
              <option value="">-- Elegir --</option>
              @foreach($monedas as $m)
                <option value="{{ $m->id }}" @selected(old('moneda_id') == $m->id)>
                  {{ $m->moneda }}
                </option>
              @endforeach
            </select>
            @error('moneda_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" min="0" name="precio"
              class="form-control @error('precio') is-invalid @enderror"
              value="{{ old('precio', 0) }}" required>
            @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Precio Bonificado</label>
            <input type="number" step="0.01" min="0" name="precio_bonificado"
              class="form-control @error('precio_bonificado') is-invalid @enderror"
              value="{{ old('precio_bonificado', 0) }}" required>
            @error('precio_bonificado')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Descuento (%)</label>
            <input type="number" step="0.01" min="0" max="100" name="descuento"
              class="form-control @error('descuento') is-invalid @enderror"
              value="{{ old('descuento', 0) }}" required>
            @error('descuento')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Detalle</label>
            <input type="text" name="detalle"
              class="form-control @error('detalle') is-invalid @enderror"
              value="{{ old('detalle') }}" maxlength="100">
            @error('detalle')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="mt-3 d-flex gap-2">
          <button class="btn btn-success">
            <i class="fas fa-save"></i> Guardar
          </button>
          <a class="btn btn-outline-secondary" href="{{ route('cotizaciones.show', $cotizacion) }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
