@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Forma de Pago</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('forma-pagos.update', $formaPago) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $formaPago->nombre) }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="diferencia" class="col-md-4 col-form-label text-md-right">Diferencia (%)</label>

                            <div class="col-md-6">
                                <input id="diferencia" type="number" step="0.01" min="0" max="100" class="form-control @error('diferencia') is-invalid @enderror" name="diferencia" value="{{ old('diferencia', $formaPago->diferencia) }}" required>

                                @error('diferencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="activo" class="col-md-4 col-form-label text-md-right">Estado</label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="activo" id="activo_si" value="1" {{ old('activo', $formaPago->activo) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activo_si">Activo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="activo" id="activo_no" value="0" {{ !old('activo', $formaPago->activo) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activo_no">Inactivo</label>
                                </div>

                                @error('activo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-6">
                                <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion">{{ old('descripcion', $formaPago->descripcion) }}</textarea>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                                <a href="{{ route('forma-pagos.index') }}" class="btn btn-secondary">
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
