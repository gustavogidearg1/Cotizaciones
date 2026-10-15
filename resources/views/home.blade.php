@extends('layouts.app')

@section('content')
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-orange {
            background-color: #FF9900 !important;
        }

        .action-tile{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .6rem;
    min-height: 96px;          /* hace que los 3 casilleros “midan lo mismo” */
    border-radius: .75rem;
    text-align: center;
    white-space: normal;       /* permite salto de línea en el texto */
  }
  .action-tile .tile-label{
    font-weight: 600;
    line-height: 1.2;
  }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-dashboard">
                    <div class="card-header bg-orange text-white">
                        <h5 class="mb-0">{{ __('Panel de Control') }}</h5>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Bienvenida -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="text-success">{{ __('¡Bienvenido!') }}</h4>
                                <p class="mb-0">{{ __('Has iniciado sesión correctamente.') }}</p>
                            </div>
                        </div>

                        <!-- Chat con IA -->
                        <div class="py-4">
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                                <h5 class="mb-3">Chat con el Agente IA</h5>

                                <div id="chat-container" class="h-96 overflow-y-auto border rounded p-3 bg-light">
                                    <div id="messages" class="space-y-2">
                                        <!-- Mensajes dinámicos -->
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <textarea id="user-message" class="form-control" rows="3" placeholder="Escribe tu pregunta..." required></textarea>
                                </div>

                                <div class="mt-2 text-end">
                                    <button id="send-message" class="btn btn-primary">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Sección Cotizaciones -->
   <!-- Sección Cotizaciones -->
<div class="card-header bg-orange text-white mt-4">
  <h5 class="mb-0">{{ __('Cotizaciones') }}</h5>
</div>

<div class="mt-3">
  <h4 class="text-success">Cotizaciones / Pedidos</h4>

  <div class="row row-cols-1 row-cols-md-3 g-3">
    <div class="col">
      <a href="{{ route('pedidos.index') }}"
         class="btn btn-primary w-100 action-tile">
        <i class="bi bi-file-earmark-text fs-4"></i>
        <span class="tile-label">Ver Cotizaciones / Pedidos</span>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('pedidos.create') }}"
         class="btn btn-success w-100 action-tile">
        <i class="bi bi-plus-circle fs-4"></i>
        <span class="tile-label">Nuevas Cotizaciones</span>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('cotizaciones.buscar_producto') }}"
         class="btn btn-info w-100 action-tile">
        <i class="bi bi-search fs-4"></i>
        <span class="tile-label">Buscar Producto</span>
      </a>
    </div>
  </div>
</div>


                        <!-- Gráficos -->
                        <hr class="my-4">
                        <h5 class="text-center">Resumen de Cotizaciones</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Top 10 productos</h6>
                                <canvas id="graficoImplementos"></canvas>
                            </div>
                            <div class="col-md-6">
                                <h6>Cotizaciones por Usuario</h6>
                                <canvas id="graficoUsuarios"></canvas>
                            </div>
                        </div>

                       <!-- Sección Costos -->
@if (auth()->user()->role_id == 1)
  <div class="mt-4">
    <div class="card-header bg-orange text-white">
      <h5 class="mb-0">Costos</h5>
    </div>

    <div class="mt-3">
      <h4 class="text-success">Listado de Costos</h4>

      <div class="row row-cols-1 row-cols-md-2 g-3">
        <div class="col">
          <a href="{{ route('cotizaciones.index') }}"
             class="btn btn-primary w-100 action-tile">
            <i class="bi bi-file-earmark-text fs-4"></i>
            <span class="tile-label">Ver Costos</span>
          </a>
        </div>

        <div class="col">
          <a href="{{ route('cotizaciones.create') }}"
             class="btn btn-outline-primary w-100 action-tile">
            <i class="bi bi-plus-circle fs-4"></i>
            <span class="tile-label">Nueva Lista Costos</span>
          </a>
        </div>
      </div>
    </div>
  </div>
@endif

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Variables desde backend
        const porImplemento = @json($porImplemento);
        const porUsuario = @json($porUsuario);

        // Configuración Chart.js
        Chart.register(window.ChartDataLabels);

        const opcionesBarraConEtiquetas = {
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#000',
                    font: {
                        weight: 'bold'
                    },
                    formatter: value => value
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    afterDataLimits: scale => {
                        if (scale.max) scale.max *= 1.1;
                    }
                }
            }
        };

        new Chart(document.getElementById('graficoImplementos'), {
            type: 'bar',
            data: {
                labels: porImplemento.map(i => i.producto),
                datasets: [{
                    label: 'Cantidad',
                    data: porImplemento.map(i => i.cantidad),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: opcionesBarraConEtiquetas,
            plugins: [window.ChartDataLabels]
        });

        new Chart(document.getElementById('graficoUsuarios'), {
            type: 'bar',
            data: {
                labels: porUsuario.map(i => i.usuario),
                datasets: [{
                    label: 'Cantidad',
                    data: porUsuario.map(i => i.cantidad),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)'
                }]
            },
            options: opcionesBarraConEtiquetas,
            plugins: [window.ChartDataLabels]
        });

        // Chat con IA
        document.getElementById("send-message").addEventListener("click", function () {
            const messageInput = document.getElementById("user-message");
            const chatContainer = document.getElementById("messages");

            let userMessage = messageInput.value.trim();
            if (userMessage === "") return;

            // Mensaje usuario
            let userBubble = `<div class="text-left">
                <div class="d-inline-block bg-primary text-white p-2 rounded mb-1">
                    ${userMessage}
                </div>
            </div>`;
            chatContainer.innerHTML += userBubble;
            messageInput.value = "";

            // Petición a backend
            fetch("{{ route('chat.ask') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: userMessage })
            })
            .then(response => response.json())
            .then(data => {
                let botBubble = `<div class="text-end">
                    <div class="d-inline-block bg-light text-dark p-2 rounded mb-1">
                        ${data.response}
                    </div>
                </div>`;
                chatContainer.innerHTML += botBubble;
                chatContainer.scrollTop = chatContainer.scrollHeight;
            })
            .catch(error => console.error("Error:", error));
        });
    </script>
@endsection
