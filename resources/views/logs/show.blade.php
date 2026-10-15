@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detalle del Log #{{ $log->id }}</h3>

    <p><strong>Info:</strong> {{ $log->info }}</p>
    <p><strong>Mensaje:</strong> {{ $log->message }}</p>
    <p><strong>Contexto:</strong></p>
    <pre>{{ json_encode($log->context, JSON_PRETTY_PRINT) }}</pre>
    <p><strong>Fecha:</strong> {{ $log->created_at }}</p>

    <a href="{{ route('logs.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
