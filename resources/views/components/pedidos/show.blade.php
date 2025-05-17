@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Estilo base para las miniaturas */

        .image-container {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        /* Wrapper para cada imagen */
        .image-wrapper {
            margin: 10px;
            text-align: center;
            display: inline-block;
        }


        .product-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px;
            cursor: zoom-in;
            transition: all 0.3s ease;
        }

        .imagen_Pedido {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            cursor: zoom-in;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        /* Espaciado entre imágenes */
        .flex-wrap.gap-4 {
            gap: 1.5rem !important;
        }

        /* Efecto hover */
        .product-thumbnail:hover {
            transform: scale(1.1);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            z-index: 100;
            position: relative;
        }

        /* Efecto hover */
        .imagen_Pedido:hover {
            transform: scale(1.1);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            z-index: 100;
            position: relative;
        }

        /* Asegura que el contenedor no limite el tamaño */
        .col-3 {
            min-width: 120px;
            /* Ajusta según necesidad */
        }

        /* Estilo para la imagen en el modal */
        #modalImage {
            max-height: 80vh;
            width: auto;
            max-width: 100%;
        }

        /* para imprimir sin margenes */

        @media print {
            @page {
                margin: 0;
                /* elimina márgenes de impresión */
            }

            body {
                margin: 0;
                /* elimina márgenes del body también */
            }
        }
    </style>

    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="mb-0">{{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }}/ {{ $pedido->user_id }}</h2>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Cliente:</strong>{{ $pedido->cliente }}</p>
                        <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
                        <p><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</p>
                        <p><strong>Provincia:</strong> {{ $pedido->provincia->nombre }}</p>
                        <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                        <p><strong>Email:</strong> {{ $pedido->email }}</p>

                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
                        <p><strong>Fecha Necesidad:</strong>
                            {{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</p>

                        <p><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</p>
                        <p><strong>Descuento (%):</strong> {{ $pedido->bonificacion }}%</p>
                        <p><strong>Creado por:</strong> {{ $pedido->user->name }}</p>
                    </div>

                    <div class="col-md-12 mt-4">
                        <!-- Mostrar imágenes si existen -->
                        @if ($pedido->imagen)
                            <div class="image-container">
                                <strong>Imágenes del Pedido:</strong>
                                <div class="d-flex justify-content-start align-items-center flex-wrap gap-4 mt-2">
                                    <div class="image-wrapper">
                                        <a href="#" class="image-preview" data-bs-toggle="modal"
                                            data-bs-target="#imageModal"
                                            onclick="document.getElementById('modalImage').src='{{ $pedido->imagen }}'">
                                            <img src="{{ $pedido->imagen }}" class="imagen_Pedido" alt="Imagen del pedido">
                                        </a>
                                    </div>
                                    @if ($pedido->imagen_2)
                                        <div class="image-wrapper">
                                            <a href="#" class="image-preview" data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                onclick="document.getElementById('modalImage').src='{{ $pedido->imagen_2 }}'">
                                                <img src="{{ $pedido->imagen_2 }}" class="imagen_Pedido"
                                                    alt="Imagen secundaria del pedido">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>



                </div>



            </div>

            @if ($pedido->observacion)
                <div class="mt-3">
                    <p><strong>Observaciones:</strong></p>
                    <p>{{ $pedido->observacion }}</p>
                </div>
            @endif
        </div>
    </div>

    <h3><strong>Productos</strong> </h3>
    @if ($pedido->subPedidos->count() > 0)
        @foreach ($pedido->subPedidos as $subPedido)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ $subPedido->producto->nombre }}</h4>

                            <p><strong>Código:</strong> {{ $subPedido->producto->codigo }}</p>
                        </div>



                        <div class="col-md-4">
                            <div class="row">
                                <h4>{{ $subPedido->color->nombre }}</h4>
                                @if ($subPedido->producto->img)
                                    <div class="col-3 mb-2">
                                        <a href="#" class="image-preview" data-bs-toggle="modal"
                                            data-bs-target="#imageModal"
                                            onclick="document.getElementById('modalImage').src = '{{ $subPedido->producto->img }}'">
                                            <img src="{{ $subPedido->producto->img }}" class="product-thumbnail"
                                                alt="Imagen 1">
                                        </a>
                                    </div>
                                @endif

                                @if ($subPedido->producto->img_1)
                                    <div class="col-3">
                                        <a href="{{ $subPedido->producto->img_1 }}" target="_blank">
                                            <img src="{{ $subPedido->producto->img_1 }}" class="img-thumbnail"
                                                alt="Imagen 2">
                                        </a>
                                    </div>
                                @endif
                                @if ($subPedido->producto->img_2)
                                    <div class="col-3">
                                        <a href="{{ $subPedido->producto->img_2 }}" target="_blank">
                                            <img src="{{ $subPedido->producto->img_2 }}" class="img-thumbnail"
                                                alt="Imagen 3">
                                        </a>
                                    </div>
                                @endif
                                @if ($subPedido->producto->img_3)
                                    <div class="col-3">
                                        <a href="{{ $subPedido->producto->img_3 }}" target="_blank">
                                            <img src="{{ $subPedido->producto->img_3 }}" class="img-thumbnail"
                                                alt="Imagen 4">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Precio Unitario</th>
                                    <th>Descuento (%)</th>
                                    <th>Precio Bonificado</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Moneda</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($subPedido->precio, 2, ',', '.') }}</td>
                                    <td>{{ $subPedido->subbonificacion }}%</td>
                                    <td>{{ number_format($subPedido->precio * (1 - $subPedido->subbonificacion / 100), 2, ',', '.') }}
                                    </td>
                                    <td>{{ $subPedido->cantidad }}</td>
                                    <td>{{ number_format($subPedido->subtotal, 2, ',', '.') }}</td>
                                    <td>{{ $subPedido->moneda->moneda }}</td>
                                    <td>{{ $subPedido->iva }}%</td>
                                    <td>{{ number_format($subPedido->total, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Resumen</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5>Total General: {{ number_format($pedido->total, 2, ',', '.') }}
                            {{ $pedido->subPedidos->first()->moneda->moneda ?? '' }}</h5>

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">No hay productos asociados a este pedido</div>
    @endif

    <div class="mt-4">
        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>

        <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-danger">
            <i class="bi bi-file-pdf"></i> Exportar PDF
        </a>

        <a href="#" onclick="printPedido()" class="btn btn-info">
            <i class="bi bi-printer"></i> Imprimir Pedido
        </a>

        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
    </div>

    <!-- Modal para imágenes -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagen del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Imagen ampliada">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                const modalImage = document.getElementById('modalImage');

                document.querySelectorAll('.thumbnail-img').forEach(img => {
                    img.addEventListener('click', function(e) {
                        e.preventDefault();
                        modalImage.src = this.src;
                        imageModal.show();
                    });
                });
            });
        </script>

        <script>
            function printPedido() {
                // Ocultar elementos que no se quieren imprimir
                const header = document.querySelector('header'); // el layout de Laravel generalmente usa <header>
                const nav = document.querySelector('nav');
                const footer = document.querySelector('footer');
                const buttons = document.querySelectorAll('.btn');

                if (header) header.style.display = 'none';
                if (nav) nav.style.display = 'none';
                if (footer) footer.style.display = 'none';
                buttons.forEach(btn => btn.style.display = 'none');

                // Imprimir
                window.print();

                // Restaurar los elementos
                setTimeout(() => {
                    if (header) header.style.display = '';
                    if (nav) nav.style.display = '';
                    if (footer) footer.style.display = '';
                    buttons.forEach(btn => btn.style.display = '');
                }, 1000); // espera a que termine la impresión
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush

@endsection
