@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Listado de Formas de pagos</h1>
        <a href="{{ route('forma-pagos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Forma de Pago
        </a>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Diferencia (%)</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th width="150px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($formaPagos as $formaPago)
                        <tr>
                            <td>{{ $formaPago->id }}</td>
                            <td>{{ $formaPago->nombre }}</td>
                            <td class="text-right">{{ number_format($formaPago->diferencia, 2) }}%</td>
                            <td>
                                <span class="text-right-{{ $formaPago->activo ? 'success' : 'danger' }}">
                                    {{ $formaPago->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>{{ $formaPago->descripcion ? Str::limit($formaPago->descripcion, 50) : 'N/A' }}
                            </td>
                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ route('forma-pagos.show', $formaPago->id) }}" class="btn btn-sm btn-primary"
                                        title="Ver detalles">
                                        Ver
                                    </a>

                                    <a href="{{ route('forma-pagos.edit', $formaPago) }}" class="btn btn-sm btn-warning"
                                        title="Editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('forma-pagos.destroy', $formaPago) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta forma de pago?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>

        </div>
        </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">No hay formas de pago registradas</td>
        </tr>
        @endforelse
        </tbody>
        </table>

    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
