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

        @media print {
        body {
            margin: 0;
            padding: 0;
            zoom: 90%; /* Ajusta la escala general. Probá también con 80%-100% */
        }

        @page {
            size: A4;
            margin: 0; /* Elimina márgenes del navegador/impressora */
        }

        .container, .card, table {
            width: 100% !important;
            max-width: 100% !important;
        }

        .table {
            font-size: 12px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        .table th,
        .table td {
            padding: 4px !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        .row,
        .col-md-4,
        .col-md-6,
        .col-md-12 {
            page-break-inside: avoid; /* Intenta evitar corte de bloques */
        }

        .btn,
        .navbar,
        footer,
        header {
            display: none !important; /* Oculta elementos no necesarios en impresión */
        }
    }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                <img src="{{ asset('images/Isologotipo con anclaje. Negro CMYK.png') }}" alt="Logo" height="50">
                <h2 class="mb-0">{{ $pedido->tipoPedido->nombre }} # {{ $pedido->id }} / {{ $pedido->user->nom_corto ?? '' }}</h2>

            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-3"><strong>Cliente:</strong> {{ $pedido->cliente }}</div>
                    <div class="col-md-3"><strong>Dirección:</strong> {{ $pedido->direccion }}</div>
                    <div class="col-md-3"><strong>Email:</strong> {{ $pedido->email }}</div>
                    <div class="col-md-3"><strong>Teléfono:</strong> {{ $pedido->telefono }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3"><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</div>
                    <div class="col-md-3"><strong>Provincia:</strong> {{ $pedido->provincia->provincia }}</div>
                    <div class="col-md-3"><strong>País:</strong> {{ $pedido->pais->pais }}</div>
                    <div class="col-md-3"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</div>
                </div>

                <div class="row mb-2">

                     <div class="col-md-3"><strong>Flete:</strong> {{ $pedido->flete->nombre ?? 'Sin flete' }}</div>
                    <div class="col-md-3"><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</div>
                    <div class="col-md-3"><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</div>
                    <div class="col-md-3"></div>
                </div>

<!--
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Fecha de Necesidad:</strong>
                        {{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</div>
                    <div class="col-md-4"><strong>Diferencia (%):</strong> {{ $pedido->diferencia ?? 0 }}%</div>
                    <div class="col-md-4"><strong>Descuento (%):</strong> {{ $pedido->bonificacion ?? 0 }}%</div>
                </div>
-->
                @if ($pedido->observacion)
                    <div class="mt-2"><strong>Observaciones:</strong> {{ $pedido->observacion }}</div>
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
                        ->firstWhere(fn($p) => $p && in_array($p->familia_id, range(1, 7)));
                @endphp

                @if ($primerProductoInfo)
                    <div class="mt-4">
                        @if ($primerProductoInfo->links)
                            <p><strong>Links del Producto:</strong> <a href="{{ $primerProductoInfo->links }}"
                                    target="_blank">{{ $primerProductoInfo->links }}</a></p>
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

    $grupoImplemento = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasImplemento));
    $grupoComponente = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasComponente));
    $grupoAccesorio = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasAccesorio));

    $totalCantidad = $subtotal = $ivaTotal = $totalGeneral = 0;

    function renderGrupoProductosDiv($grupo, $titulo, &$totalCantidad, &$subtotal, &$ivaTotal, &$totalGeneral)
{
    if ($grupo->isEmpty()) return;

    echo "<h5 class='mt-4'>{$titulo}</h5>";

    foreach ($grupo as $sp) {
        $producto = $sp->producto;
        $precioConDiferencia = $sp->precio * (1 + ($sp->diferencia ?? 0) / 100);
        $precioBonificado = $precioConDiferencia;

        foreach ([$sp->subbonificacion, $sp->descuento_2, $sp->descuento_3, $sp->descuento_4] as $desc) {
            $desc = floatval($desc);
            if ($desc > 0) {
                $precioBonificado *= (1 - $desc / 100);
            }
        }

        $sub = $precioBonificado * $sp->cantidad;
        $ivaMonto = ($sub * $sp->iva) / 100;
        $total = $sub + $ivaMonto;

        $totalCantidad += $sp->cantidad;
        $subtotal += $sub;
        $ivaTotal += $ivaMonto;
        $totalGeneral += $total;

        echo '<div class="border rounded p-3 mb-3 bg-light">';

        // Fila 1
        echo '<div class="row mb-2">';
        echo '<div class="col-md-4"><strong>Producto:</strong> ' . $producto->nombre . " - (".$producto->codigo .")" . '</div>';
        echo '<div class="col-md-2"><strong>Color:</strong> ' . ($sp->color->nombre ?? '-') . '</div>';
        echo '<div class="col-md-2"><strong>Moneda:</strong> ' . ($sp->moneda->moneda ?? '-') . '</div>';
        echo '<div class="col-md-2"><strong>Cantidad:</strong> ' . $sp->cantidad . '</div>';
        echo '<div class="col-md-2"><strong>Precio:</strong> $' . number_format($sp->precio, 2, ',', '.') . '</div>';
        echo '</div>';

        // Fila 2 - Descuentos (ocupar espacio aunque estén vacíos)
        echo '<div class="row mb-2">';
        echo '<div class="col-md-2">' . (($sp->diferencia ?? 0) != 0 ? '<strong>Diferencia (%):</strong> ' . number_format($sp->diferencia, 2, ',', '.') . '%' : '&nbsp;') . '</div>';
        echo '<div class="col-md-2">' . ($sp->subbonificacion > 0 ? '<strong>Desc. 1:</strong> ' . $sp->subbonificacion . '%' : '&nbsp;') . '</div>';
        echo '<div class="col-md-2">' . ($sp->descuento_2 > 0 ? '<strong>Desc. 2:</strong> ' . $sp->descuento_2 . '%' : '&nbsp;') . '</div>';
        echo '<div class="col-md-2">' . ($sp->descuento_3 > 0 ? '<strong>Desc. 3:</strong> ' . $sp->descuento_3 . '%' : '&nbsp;') . '</div>';
        echo '<div class="col-md-2">' . ($sp->descuento_4 > 0 ? '<strong>Desc. 4:</strong> ' . $sp->descuento_4 . '%' : '&nbsp;') . '</div>';
        echo '</div>';

        // Fila 3 - Totales
        echo '<div class="row mb-2">';
        echo '<div class="col-md-3"><strong>Subtotal:</strong> $' . number_format($sub, 2, ',', '.') . '</div>';
        echo '<div class="col-md-2"><strong>IVA:</strong> ' . $sp->iva . '%</div>';
        echo '<div class="col-md-2"><strong>Importe IVA:</strong> $' . number_format($ivaMonto, 2, ',', '.') . '</div>';
        echo '<div class="col-md-3"><strong>Total:</strong> $' . number_format($total, 2, ',', '.') . '</div>';

        echo '</div>';

        // Fila 4 - Forma de pago y detalle
        echo '<div class="row mb-2">';
        echo '<div class="col-md-4"><strong>Forma de Pago:</strong> ' . ($sp->formaPago->nombre ?? '-') . '</div>';
        echo '<div class="col-md-8">' . (!empty($sp->detalle) ? '<strong>Detalle:</strong> ' . $sp->detalle : '&nbsp;') . '</div>';
        echo '</div>';

        echo '</div>';
    }
}


@endphp


@if ($grupoImplemento->count() > 0)
    @php
        // Obtener productos únicos por ID
        $productosUnicos = $grupoImplemento->pluck('producto')->unique('id');
    @endphp





    <div class="row mt-3">
        @foreach ($productosUnicos as $producto)
            @if ($producto->img || $producto->img_1 || $producto->img_2 || $producto->img_3)
                @if ($loop->first)

                @endif
                @if ($producto->img)
                    <div class="col-md-3 mb-3">

                        <img src="{{ asset($producto->img) }}" alt="Imagen principal"
                            class="img-thumbnail w-100 zoom-hover"
                            onclick="showImageModal('{{ asset($producto->img) }}')">
                    </div>
                @endif

                @if ($producto->img_1)
                    <div class="col-md-3 mb-3">

                        <img src="{{ asset($producto->img_1) }}" alt="Imagen 2"
                            class="img-thumbnail w-100 zoom-hover"
                            onclick="showImageModal('{{ asset($producto->img_1) }}')">
                    </div>
                @endif

                @if ($producto->img_2)
                    <div class="col-md-3 mb-3">

                        <img src="{{ asset($producto->img_2) }}" alt="Imagen 3"
                            class="img-thumbnail w-100 zoom-hover"
                            onclick="showImageModal('{{ asset($producto->img_2) }}')">
                    </div>
                @endif

                @if ($producto->img_3)
                    <div class="col-md-3 mb-3">

                        <img src="{{ asset($producto->img_3) }}" alt="Imagen 4"
                            class="img-thumbnail w-100 zoom-hover"
                            onclick="showImageModal('{{ asset($producto->img_3) }}')">
                    </div>
                @endif
            @endif
        @endforeach
    </div>

    @php
        // Renderizamos los productos agrupados
        renderGrupoProductosDiv($grupoImplemento, 'Implementos', $totalCantidad, $subtotal, $ivaTotal, $totalGeneral);
    @endphp
@endif






        @if ($grupoComponente->count())

            @php renderGrupoProductosDiv($grupoComponente, 'Componentes', $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp

        @endif

        @if ($grupoAccesorio->count())

            @php renderGrupoProductosDiv($grupoAccesorio, 'Accesorios', $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp

        @endif

@php
    $totalCantidadImplementos = $grupoImplemento->sum('cantidad');
@endphp

<div class="card mt-4">
    <div class="card-body text-end">
        <h5 class="mb-0">Totales Generales</h5>
        <p><strong>Moneda:</strong>
            {{ $pedido->moneda->moneda ?? 'No definida' }}
            @if ($pedido->moneda && $pedido->moneda->desc_ampliada)
                - {{ $pedido->moneda->desc_ampliada }}
            @endif
        </p>
        @if ($pedido->cotizacion)
            <p><strong>Cotización:</strong> ${{ number_format($pedido->cotizacion, 2, ',', '.') }}</p>
        @endif
        <p><strong>Cantidad Total (Implementos):</strong> {{ $totalCantidadImplementos }}</p>
        <p><strong>Subtotal:</strong> USD {{ number_format($subtotal, 2, ',', '.') }}</p>
        <p><strong>Importe IVA:</strong> USD {{ number_format($ivaTotal, 2, ',', '.') }}</p>
        <p><strong>Total:</strong> USD {{ number_format($totalGeneral, 2, ',', '.') }}</p>
@if ($pedido->cotizacion && $pedido->cotizacion != 1)
    <p>
        <strong>Total en Pesos:</strong>
        ${{ number_format($totalGeneral * $pedido->cotizacion, 2, ',', '.') }}
    </p>
@endif
    </div>


</div>

        <div class="card card-body text-end bg-orange text-white d-flex ">

                <p class="mb-0">{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
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
