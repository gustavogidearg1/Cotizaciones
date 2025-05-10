@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles de Forma de Pago</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">ID</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $formaPago->id }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Nombre</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $formaPago->nombre }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Diferencia</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ number_format($formaPago->diferencia, 2) }}%</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Estado</label>
                        <div class="col-md-6">
                            <span class="badge badge-{{ $formaPago->activo ? 'success' : 'danger' }}">
                                {{ $formaPago->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Descripción</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $formaPago->descripcion ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Creado</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $formaPago->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Actualizado</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $formaPago->updated_at ? $formaPago->updated_at->format('d/m/Y H:i') : 'Nunca actualizado' }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="d-flex gap-1">

                                    <a href="{{ route('forma-pagos.edit', $formaPago) }}"
            class="btn btn-sm btn-warning" title="Editar">
            Editar
        </a>

                            <a href="{{ route('forma-pagos.index') }}" class="btn btn-sm btn-secondary">
                                Volver
                            </a>

        <form action="{{ route('forma-pagos.destroy', $formaPago) }}"
            method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta forma de pago?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                Eliminar
            </button>
        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
