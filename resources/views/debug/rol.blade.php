@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Debug de Rol del Usuario</h1>
    <hr>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID Usuario:</strong> {{ $user->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Nom Corto:</strong> {{ $user->nom_corto }}</li>
        <li class="list-group-item"><strong>Role ID:</strong> {{ $user->role_id }}</li>
        <li class="list-group-item"><strong>Rol (nombre):</strong> {{ $user->role->name ?? 'Sin rol asignado' }}</li>
        <li class="list-group-item">
            <strong>¿Pasa Gate::allows('admin')?:</strong>
            @if ($is_admin)
                ✅ Sí, tiene permisos de administrador.
            @else
                ❌ No, no tiene permisos de administrador.
            @endif
        </li>
    </ul>
</div>
@endsection
