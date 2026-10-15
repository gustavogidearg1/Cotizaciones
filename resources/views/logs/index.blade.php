@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h3>Últimos Logs</h3>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <a href="{{ route('logs.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Crear Log
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Info</th>
                <th>Mensaje</th>
                <th>Contexto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->info }}</td>
                    <td>{{ $log->message }}</td>
                   <td>
    @if($log->context)
        <pre class="mb-0" style="white-space: pre-wrap;">
{{ json_encode($log->context, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}
        </pre>
    @else
        <em>—</em>
    @endif
</td>

                    <td>{{ $log->created_at }}</td>
                    <td>
                        <a href="{{ route('logs.show', $log) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('logs.edit', $log) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('logs.destroy', $log) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar log?')" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
