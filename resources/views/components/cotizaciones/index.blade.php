@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Listado de Cotizaciones</h1>
            <a href="{{ route('cotizaciones.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nueva Cotización
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-dashboard">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap">Código</th>
                                <th>Descripción</th>
                                <th class="text-nowrap">Vencimiento</th>
                                <th>Usuario</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cotizaciones as $cotizacion)
                                <tr>
                                    <td>{{ $cotizacion->id }}</td>
                                    <td class="fw-semibold">{{ $cotizacion->cotizacion }}</td>
                                    <td>{{ $cotizacion->descripcion }}</td>
                                    <td class="text-nowrap">
                                        <span
                                            class="{{ \Carbon\Carbon::parse($cotizacion->vencimiento)->isPast() ? 'text-danger' : 'text-success' }}">
                                            {{ \Carbon\Carbon::parse($cotizacion->vencimiento)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td>{{ $cotizacion->user->name ?? 'Sin asignar' }}</td>


                                    <td>
                                        <div class="d-flex gap-1">

                                            <div class="d-flex gap-1">

                                                <a href="{{ route('cotizaciones.show', $cotizacion->id) }}"
                                                    class="btn btn-sm btn-primary" title="Ver detalles">
                                                    Ver
                                                </a>

                                                <a href="{{ route('cotizaciones.edit', $cotizacion) }}"
                                                    class="btn btn-sm btn-warning" title="Editar">
                                                    Editar
                                                </a>

                                                <form action="{{ route('cotizaciones.destroy', $cotizacion) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar el registro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                        Eliminar
                                                        </buttn>


                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
