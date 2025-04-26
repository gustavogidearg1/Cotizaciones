@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Listado de Clientes</h1>
        <a href="{{ route('cliente.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Cliente
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
                <table class="table table-hover mb-0">
                    <thead class="table-light">
            <tr>
                <th>id</th>
                <th class="text-nowrap">Nombre</th>
                <th class="text-nowrap">Direccion</th>
                <th class="text-nowrap">Localidad</th>
                <th class="text-nowrap">Provincia</th>
                <th class="text-nowrap">Telefono</th>
                <th class="text-nowrap">Email</th>
                <th class="text-nowrap">Contacto</th>
                <th class="text-nowrap">Conces</th>
                <th class="text-nowrap">Categoria</th>
                <th>Desc</th>
                <th class="text-nowrap text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id  }}</td>
                <td>{{ $cliente->nombre  }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td class="fw-semibold">{{ $cliente->localidad->localidad }}</td>
                <td class="fw-semibold">{{ $cliente->provincia->provincia }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->contacto }}</td>
                <td>{{ $cliente->concesionario ? 'Sí' : 'No' }}</td>
                <td>{{ $cliente->categoria->categoria }}</td>
                <td>{{ $cliente->descuento }}</td>

            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('cliente.show', $cliente->id) }}"
                       class="btn btn-sm btn-outline-info"
                       title="Ver detalles">
                        <i class="bi bi-eye"></i>
                    </a>

                    <a href="{{ route('cliente.edit', $cliente->id) }}"
                        class="btn btn-sm btn-outline-warning"
                        title="Editar">
                         <i class="bi bi-pencil"></i>
                     </a>

                    <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        class="btn btn-sm btn-outline-danger"
                        title="Eliminar"
                        onclick="return confirm('¿Estás seguro de eliminar esta cotización?')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection

