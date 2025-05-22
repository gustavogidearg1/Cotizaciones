<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido Público #{{ $pedido->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
                <h2 class="mb-0">Pedido Público #{{ $pedido->id }} / {{ $pedido->user->id }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Cliente:</strong> {{ $pedido->cliente }}</div>
                    <div class="col-md-6"><strong>Dirección:</strong> {{ $pedido->direccion }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</div>
                    <div class="col-md-4"><strong>Provincia:</strong> {{ $pedido->provincia->provincia }}</div>
                    <div class="col-md-4"><strong>País:</strong> {{ $pedido->pais->pais }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Teléfono:</strong> {{ $pedido->telefono }}</div>
                    <div class="col-md-4"><strong>Email:</strong> {{ $pedido->email }}</div>
                    <div class="col-md-4"><strong>Flete:</strong> {{ $pedido->flete->nombre ?? 'Sin flete' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Fecha de Necesidad:</strong> {{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</div>
                    <div class="col-md-6"><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</div>
                    <div class="col-md-4"><strong>Diferencia (%):</strong> {{ $pedido->diferencia ?? 0 }}%</div>
                </div>

                @if ($pedido->observacion)
                    <div class="mt-2"><strong>Observaciones:</strong> {{ $pedido->observacion }}</div>
                @endif

                @if ($pedido->imagen || $pedido->imagen_2)
                    <div class="row mt-4">
                        @if ($pedido->imagen)
                            <div class="col-md-6">
                                <img src="{{ $pedido->imagen }}" class="imagen_Pedido" alt="Imagen Principal">
                            </div>
                        @endif
                        @if ($pedido->imagen_2)
                            <div class="col-md-6">
                                <img src="{{ $pedido->imagen_2 }}" class="imagen_Pedido" alt="Imagen Secundaria">
                            </div>
                        @endif
                    </div>
                @endif

                @php
                    $primerProductoInfo = $pedido->subPedidos
                        ->map(fn($sp) => $sp->producto)
                        ->firstWhere(fn($p) => $p && in_array($p->familia_id, range(1,7)));
                @endphp

                @if($primerProductoInfo)
                    <div class="mt-4">
                        @if($primerProductoInfo->links)
                            <p><strong>Links del Producto:</strong> <a href="{{ $primerProductoInfo->links }}" target="_blank">{{ $primerProductoInfo->links }}</a></p>
                        @endif
                        @if($primerProductoInfo->detalle)
                            <p><strong>Detalle del Producto:</strong> {{ $primerProductoInfo->detalle }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="card bg-orange text-white">
            <div class="card-body"><h4 class="mb-0">Productos del Pedido</h4></div>
        </div>

        @php
            $familiasImplemento = [1, 2, 3, 4, 5, 6];
            $familiasComponente = [7];
            $familiasAccesorio = [8];

            $grupoImplemento = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasImplemento));
            $grupoComponente = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasComponente));
            $grupoAccesorio = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasAccesorio));

            $totalCantidad = $subtotal = $ivaTotal = $totalGeneral = 0;

            function renderPublicTable($subPedidos, $esAccesorio, &$totalCantidad, &$subtotal, &$ivaTotal, &$totalGeneral) {
                echo '<div class="table-responsive mt-3"><table class="table table-bordered">';
                echo '<thead class="table-light"><tr>
                        <th>Producto</th><th>Cantidad</th><th>Precio</th><th>Desc (%)</th>
                        <th>Dif Pago (%)</th><th>Subtotal</th><th>IVA (%)</th><th>Importe IVA</th><th>Total</th>
                      </tr></thead><tbody>';
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
                        <td>{$sp->cantidad}</td>
                        <td>$" . number_format($sp->precio, 2, ',', '.') . "</td>
                        <td>" . ($esAccesorio ? '0%' : $sp->subbonificacion . '%') . "</td>
                        <td>" . ($esAccesorio ? '0%' : ($sp->diferencia ?? 0) . '%') . "</td>
                        <td>$" . number_format($sub, 2, ',', '.') . "</td>
                        <td>{$sp->iva}%</td>
                        <td>$" . number_format($ivaMonto, 2, ',', '.') . "</td>
                        <td>$" . number_format($total, 2, ',', '.') . "</td>
                    </tr>";
                }
                echo '</tbody></table></div>';
            }
        @endphp

        @if($grupoImplemento->count())
            <h5 class="mt-3">Implementos</h5>
            @php renderPublicTable($grupoImplemento, false, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        @if($grupoComponente->count())
            <h5 class="mt-3">Componentes</h5>
            @php renderPublicTable($grupoComponente, false, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        @if($grupoAccesorio->count())
            <h5 class="mt-3">Accesorios</h5>
            @php renderPublicTable($grupoAccesorio, true, $totalCantidad, $subtotal, $ivaTotal, $totalGeneral); @endphp
        @endif

        <div class="card mt-4">
            <div class="card-body text-end">
                <h5 class="mb-0">Totales Generales</h5>
                <p><strong>Cantidad Total:</strong> {{ $totalCantidad }}</p>
                <p><strong>Subtotal:</strong> ${{ number_format($subtotal, 2, ',', '.') }}</p>
                <p><strong>Importe IVA:</strong> ${{ number_format($ivaTotal, 2, ',', '.') }}</p>
                <p><strong>Total:</strong> ${{ number_format($totalGeneral, 2, ',', '.') }}</p>
            </div>
        </div>

        <p class="text-end mt-4"><small>Visualización pública – generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</small></p>
    </div>
</body>
</html>
