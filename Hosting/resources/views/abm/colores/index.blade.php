@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-palette me-2"></i>Listado de Colores</h1>
        <a href="{{ route('colores.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Color
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colores as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td>{{ $color->nombre }}</td>
                            <td>{{ $color->descripcion ?? '-' }}</td>
                            <td>
           <div class="d-flex gap-1">

                                            <a href="{{ route('colores.show', $color->id) }}" class="btn btn-sm btn-primary"
                                                title="Ver detalles">
                                                Ver
                                            </a>


                                            <a href="{{ route('colores.edit', $color) }}" class="btn btn-sm btn-warning"
                                                title="Editar">
                                                Editar
                                            </a>

                                            <form action="{{ route('colores.destroy', $color) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar el registro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>

                </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $colores->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
