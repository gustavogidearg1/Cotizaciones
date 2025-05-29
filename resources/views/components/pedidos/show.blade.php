<!-- Vista show.blade.php actualizada -->
@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-orange {
            background-color: #FF9900 !important;
        }

        .imagen_Pedido {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            background-color: white;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .imagen_Pedido:hover {
            transform: scale(1.05);
        }

        .modal-img {
            max-width: 100%;
            height: auto;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-orange text-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/Isologotipo con anclaje. Negro CMYK.png') }}" alt="Logo" height="50">
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="mb-0">{{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }}/
                            {{ $pedido->user->nom_corto ?? '' }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Provincia:</strong> {{ $pedido->provincia->provincia }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>País:</strong> {{ $pedido->pais->pais }}</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Email:</strong> {{ $pedido->email }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>CUIT:</strong> {{ $pedido->cuit }}</p>
                    </div>


                </div>

                <div class="row">

                    <div class="col-md-4">
                        <p><strong>Flete:</strong> {{ $pedido->flete->nombre ?? 'Sin flete' }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Fecha Necesidad a partir de la confirmacion del pedido:</strong>
                            {{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</p>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Flete:</strong> {{ $pedido->flete->nombre ?? 'Sin flete' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Diferencia (%):</strong> {{ $pedido->diferencia ?? 0 }}%</p>
                    </div>
                </div>

                @if ($pedido->observacion)
                    <div class="mt-3">
                        <p><strong>Observaciones:</strong> {{ $pedido->observacion }}</p>
                    </div>
                @endif

                @if ($pedido->imagen || $pedido->imagen_2)
                    <div class="row mt-4">
                        @if ($pedido->imagen)
                            <div class="col-md-6">
                                <img src="{{ $pedido->imagen }}" class="imagen_Pedido" alt="Imagen Principal"
                                    onclick="showImageModal('{{ $pedido->imagen }}')">
                            </div>
                        @endif
                        @if ($pedido->imagen_2)
                            <div class="col-md-6">
                                <img src="{{ $pedido->imagen_2 }}" class="imagen_Pedido" alt="Imagen Secundaria"
                                    onclick="showImageModal('{{ $pedido->imagen_2 }}')">
                            </div>
                        @endif
                    </div>
                @endif

                @php
                    $primerProductoInfo = $pedido->subPedidos
                        ->map(fn($sp) => $sp->producto)
                        ->firstWhere(fn($p) => $p && in_array($p->familia_id, [1, 2, 3, 4, 5, 6, 7]));
                @endphp

                @if ($primerProductoInfo)
                    <div class="mt-4">
                        @if ($primerProductoInfo->links)
                            <p><strong>Links del Producto:</strong>
                                <a href="{{ $primerProductoInfo->links }}" target="_blank">
                                    {{ $primerProductoInfo->links }}
                                </a>
                            </p>
                        @endif

                        @if ($primerProductoInfo->detalle)
                            <p><strong>Detalle del Producto:</strong> {{ $primerProductoInfo->detalle }}</p>
                        @endif
                    </div>
                @endif



            </div>
        </div>

        <div class="card bg-orange text-white">
            <div class="card-body">
                <h4 class="mb-0">Productos del Pedido</h4>
            </div>
        </div>

        @php
            $familiasImplemento = [1, 2, 3, 4, 5, 6];
            $familiasComponente = [7];
            $familiasAccesorio = [8];

            $grupoImplemento = $pedido->subPedidos->filter(
                fn($sp) => in_array($sp->producto->familia_id, $familiasImplemento),
            );
            $grupoComponente = $pedido->subPedidos->filter(
                fn($sp) => in_array($sp->producto->familia_id, $familiasComponente),
            );
            $grupoAccesorio = $pedido->subPedidos->filter(
                fn($sp) => in_array($sp->producto->familia_id, $familiasAccesorio),
            );

            $totalCantidad = $subtotal = $ivaTotal = $totalGeneral = 0;

            function renderTable(
                $subPedidos,
                $esAccesorio = false,
                &$totalCantidad,
                &$subtotal,
                &$ivaTotal,
                &$totalGeneral,
            ) {
                echo '<div class="table-responsive mt-3">';
                echo '<table class="table table-bordered table-striped">';
                echo '<thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Color</th>
                        <th>Moneda</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Desc (%)</th>
                        <th>Dif Pago (%)</th>
                        <th>Subtotal</th>
                        <th>IVA (%)</th>
                        <th>Importe IVA</th>
                        <th>Total</th>
                    </tr>
                  </thead><tbody>';
                foreach ($subPedidos as $sp) {
                    $precioBonificado = $sp->precio * (1 - $sp->subbonificacion / 100);
                    $sub = $precioBonificado * $sp->cantidad;
                    $ivaMonto = ($sub * $sp->iva) / 100;
                    $total = $sub + $ivaMonto;

                    $totalCantidad += $sp->cantidad;
                    $subtotal += $sub;
                    $ivaTotal += $ivaMonto;
                    $totalGeneral += $total;

                    echo "<tr>
                        <td>{$sp->producto->nombre}</td>
                        <td>{$sp->color->nombre}</td>
                        <td>{$sp->moneda->moneda}</td>
                        <td>{$sp->cantidad}</td>
                        <td>$" .
                        number_format($sp->precio, 2, ',', '.') .
                        "</td>
                        <td>" .
                        ($esAccesorio ? '0%' : $sp->subbonificacion . '%') .
                        "</td>
                        <td>" .
                        ($esAccesorio ? '0%' : ($sp->diferencia ?? 0) . '%') .
                        "</td>
                        <td>$" .
                        number_format($sub, 2, ',', '.') .
                        "</td>
                        <td>{$sp->iva}%</td>
                        <td>$" .
                        number_format($ivaMonto, 2, ',', '.') .
                        "</td>
                        <td>$" .
                        number_format($total, 2, ',', '.') .
                        "</td>
                    </tr>";
                }
                echo '</tbody></table></div>';
            }
        @endphp

        @if ($grupoImplemento->count() > 0)
            <h5 class="mt-4">Implementos</h5>
            @php renderTable($grupoImplemento, false, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        @if ($grupoComponente->count() > 0)
            <h5 class="mt-4">Componentes</h5>
            @php renderTable($grupoComponente, false, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        @if ($grupoAccesorio->count() > 0)
            <h5 class="mt-4">Accesorios</h5>
            @php renderTable($grupoAccesorio, true, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        <div class="card mt-4">
            <div class="card-body text-end">
                <h5 class="mb-0">Totales Generales</h5>
                <p><strong>Moneda:</strong>
                    {{ $pedido->moneda->moneda ?? 'No definida' }}
                    @if ($pedido->moneda && $pedido->moneda->desc_ampliada)
                        - {{ $pedido->moneda->desc_ampliada }}
                    @endif
                </p>
                <p><strong>Cantidad de productos:</strong> {{ $totalCantidad }}</p>
                <p><strong>Subtotal:</strong> ${{ number_format($subtotal, 2, ',', '.') }}</p>
                <p><strong>Importe IVA:</strong> ${{ number_format($ivaTotal, 2, ',', '.') }}</p>
                <p><strong>Total:</strong> ${{ number_format($totalGeneral, 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>

            <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Exportar PDF
            </a>

            <a href="#" onclick="printPedido()" class="btn btn-info">
                <i class="fas fa-print"></i> Imprimir Pedido
            </a>

            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            @if ($pedido->token)
                <a href="https://wa.me/?text={{ urlencode('Podés ver el pedido en: ' . route('pedidos.publico', $pedido->token)) }}"
                    class="btn btn-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Compartir con Cliente
                </a>
            @endif
            <!--
                                <a href="{{ route('pedidos.publico', $pedido->token) }}">
                                    {{ route('pedidos.publico', $pedido->token) }}
                                </a>

                                -->

        </div>
    </div>

    <script>
        function printPedido() {
            const header = document.querySelector('header');
            const nav = document.querySelector('nav');
            const footer = document.querySelector('footer');
            const buttons = document.querySelectorAll('.btn');

            if (header) header.style.display = 'none';
            if (nav) nav.style.display = 'none';
            if (footer) footer.style.display = 'none';
            buttons.forEach(btn => btn.style.display = 'none');

            window.print();

            setTimeout(() => {
                if (header) header.style.display = '';
                if (nav) nav.style.display = '';
                if (footer) footer.style.display = '';
                buttons.forEach(btn => btn.style.display = '');
            }, 1000);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showImageModal(src) {
            document.getElementById('modalImage').src = src;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }
    </script>

    <!-- Modal de imagen ampliada -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="modal-img" alt="Vista ampliada">
                </div>
            </div>
        </div>
    </div>


@endsection
