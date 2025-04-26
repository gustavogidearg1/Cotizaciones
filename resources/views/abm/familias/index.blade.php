@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Listado de Familias</h1>


    <a href="{{ route('familias.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva Familia
    </a>

</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif

    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen Principal</th>
                <th>Imagen Secundaria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($familias as $familia)
            <tr>
                <td>{{ $familia->id }}</td>
                <td>{{ $familia->nombre }}</td>
                <td>
                    @if($familia->imagen_principal)
                        <img src="{{ $familia->imagen_principal }}" alt="Imagen principal" width="50">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td>
                    @if($familia->imagen_secundaria)
                        <img src="{{ $familia->imagen_secundaria }}" alt="Imagen secundaria" width="50">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td>

                    <a href="{{ route('familias.show', $familia->id) }}"
                        class="btn btn-sm btn-outline-info"
                        title="Ver detalles">
                         <i class="bi bi-eye"></i>
                     </a>

                     <a href="{{ route('familias.edit', $familia->id) }}"
                        class="btn btn-sm btn-outline-warning"
                        title="Editar">
                         <i class="bi bi-pencil"></i>
                     </a>


                    <form action="{{ route('familias.destroy', $familia->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        class="btn btn-sm btn-outline-danger"
                        title="Eliminar"
                        onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                    <i class="bi bi-trash"></i>
                </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
