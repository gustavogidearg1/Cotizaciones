@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">
        <i class="bi bi-chat-dots me-2"></i> Chats
    </h1>

    {{-- Botón opcional: abrir chat nuevo o refrescar --}}
    <div class="btn-group">
        <a href="{{ route('chats.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i> Actualizar
        </a>
        {{-- Si tenés ruta para crear chat, habilítalo
        <a href="{{ route('chats.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Chat
        </a>
        --}}
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    {{-- Lista de chats (izquierda) --}}
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <strong><i class="bi bi-people me-2"></i> Conversaciones</strong>
            </div>
            <div class="card-body p-0">
                @if($chats->isEmpty())
                    <div class="p-3 text-muted">No hay chats todavía.</div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($chats as $chatItem)
                            <a href="{{ route('chats.show', $chatItem->id) }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                               @if(isset($chat) && $chat->id == $chatItem->id) active @endif">
                                <div>
                                    <div class="fw-semibold">{{ $chatItem->name }}</div>
                                    <small class="@if(isset($chat) && $chat->id == $chatItem->id) text-white-50 @else text-muted @endif">
                                        {{ $chatItem->whatsapp_number }}
                                    </small>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Mensajes del chat seleccionado (derecha) --}}
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex align-items-center">
                @if(isset($chat))
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        <div>
                            <div class="fw-semibold">Chat con {{ $chat->name }}</div>
                            <small class="text-muted">{{ $chat->whatsapp_number }}</small>
                        </div>
                    </div>
                @else
                    <strong>Seleccioná un chat</strong>
                @endif
            </div>

            <div class="card-body" style="height: 60vh; overflow-y: auto;">
                @if(isset($chat))
                    @forelse($messages as $message)
                        <div class="d-flex {{ $message->sender === 'user' ? 'justify-content-start' : 'justify-content-end' }} mb-3">
                            <div class="p-2 rounded-3 shadow-sm"
                                 style="max-width: 75%;
                                     {{ $message->sender === 'user'
                                         ? 'background:#e9ecef;color:#212529;'
                                         : 'background:#0d6efd;color:white;' }}">
                                <div class="small mb-1">
                                    <i class="bi {{ $message->sender === 'user' ? 'bi-person' : 'bi-robot' }} me-1"></i>
                                    {{ $message->sender === 'user' ? 'Usuario' : 'Asistente' }}
                                </div>
                                <div>{{ $message->message }}</div>
                                <div class="text-end mt-1">
                                    <small class="text-black-50">
                                        {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted text-center">No hay mensajes en este chat.</div>
                    @endforelse
                @else
                    <div class="text-muted text-center py-5">
                        <i class="bi bi-chat-dots fs-1 d-block mb-3"></i>
                        Seleccioná una conversación de la lista para ver los mensajes.
                    </div>
                @endif
            </div>

            {{-- Caja de envío (opcional) --}}
            @if(isset($chat))
                <div class="card-footer bg-white">
                    <form id="sendMessageForm" class="d-flex gap-2" action="{{ route('chat.ask') }}" method="POST">
                        @csrf
                        <input type="hidden" name="chat_id" value="{{ $chat->id }}">
                        <input type="text" name="message" class="form-control" placeholder="Escribe un mensaje..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Envío AJAX opcional para la caja de envío --}}
@if(isset($chat))
<script>
document.getElementById('sendMessageForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    const form = this;
    const fd = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: fd
    })
    .then(r => r.json())
    .then(data => {
        // Mostrar la respuesta del asistente como nuevo mensaje a la derecha
        // y el mensaje del usuario a la izquierda (rápida simulación)
        location.reload(); // simple por ahora; si querés, inyectamos el DOM sin recargar
    })
    .catch(err => console.error(err));
});
</script>
@endif

@endsection
