@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ isset($log) ? 'Editar Log' : 'Crear Log' }}</h3>

    <form action="{{ isset($log) ? route('logs.update', $log) : route('logs.store') }}" method="POST">
        @csrf
        @if(isset($log))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Info</label>
            <input type="text" name="info" class="form-control" value="{{ old('info', $log->info ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Mensaje</label>
            <textarea name="message" class="form-control" required>{{ old('message', $log->message ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Contexto (JSON)</label>
            <textarea name="context" class="form-control">{{ old('context', isset($log->context) ? json_encode($log->context, JSON_PRETTY_PRINT) : '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('logs.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
