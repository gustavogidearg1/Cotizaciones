@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-person-vcard me-2"></i>Detalles del Usuario</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nombre:</div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Rol:</div>
                        <div class="col-md-8">{{ $user->role->name ?? 'Sin rol asignado' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Fecha de creación:</div>
                        <div class="col-md-8">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Última actualización:</div>
                        <div class="col-md-8">{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
