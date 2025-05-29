@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Listado de Productos</h1>
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nuevo Producto
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('productos.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar productos..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap">Imagen</th>
                                <th class="text-nowrap">Código</th>
                                <th class="text-nowrap">Nombre</th>
                                <th class="text-nowrap">Unidad</th>
                                <th class="text-nowrap">Familia</th>
                                <th class="text-nowrap">Tipo</th>
                                <th>Activo</th>
                                <th class="text-nowrap text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>
                                        @if ($producto->img)
                                            <img src="{{ asset($producto->img) }}" alt="Miniatura" class="img-thumbnail"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td class="fw-semibold">{{ $producto->nombre }}</td>
                                    <td>{{ $producto->unidad->nombre }}</td>
                                    <td>{{ $producto->familia->nombre }}</td>
                                    <td>{{ $producto->tipo->nombre }}</td>
                                    <td>{{ $producto->activo ? 'Sí' : 'No' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('productos.show', $producto->id) }}"
                                                class="btn btn-sm btn-primary" title="Ver detalles">
                                                Ver
                                            </a>

                                            <a href="{{ route('productos.edit', $producto) }}"
                                                class="btn btn-sm btn-warning" title="Editar">
                                                Editar
                                            </a>

                                            <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar el registro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    Eliminar
                                                </button>
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
    {{ $productos->withQueryString()->links('pagination::bootstrap-5') }}
</div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
