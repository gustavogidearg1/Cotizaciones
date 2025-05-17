@extends('layouts.app')

@section('content')

<style>
    .badge.ms-1 {
    margin-left: 0.25rem;
    font-size: 0.75em;
}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><i class="bi bi-cart me-2"></i>Listado de Cotizaciones / Pedidos</h1>
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Cotizacion
        </a>
    </div>

    @if(session('success'))
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
                        <form action="{{ route('pedidos.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Buscar pedidos..."
                                       value="{{ request('search') }}">
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
                            <th class="text-nowrap">ID</th>
                            <th class="text-nowrap">Fecha</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th class="text-nowrap text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td class="text-nowrap">{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $pedido->cliente }}</td>
                                  <td>
                                @if($pedido->subPedidos->isNotEmpty())
                                    {{ $pedido->subPedidos->first()->producto->nombre }}
                                    @if($pedido->subPedidos->count() > 1)
                                        <span class="badge bg-secondary ms-1">+{{ $pedido->subPedidos->count() - 1 }} más</span>
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $pedido->user->name }}</td>
                            <td>
                                <!-- ... tus botones de acciones ... -->
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}"
                                       class="btn btn-sm btn-outline-info"
                                       title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar"
                                                onclick="return confirm('¿Estás seguro de eliminar este pedido?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $pedidos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
