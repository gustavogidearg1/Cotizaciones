<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido #{{ $pedido->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background-color: #FF9900;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            font-weight: bold;
        }

        .card-body {
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table width="100%">
                <tr>
                    <td><strong>COMOFRA SRL</strong></td>
                    <td style="text-align: right;">
                        <h2>{{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }} / {{ $pedido->user->nom_corto ?? '' }}</h2>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <div class="card-header">Datos del Pedido</div>
            <div class="card-body">
                <a href="{{ route('pedidos.publico', $pedido->token) }}" class="btn btn-success" target="_blank">
                    Para ver su pedido, haga clic aquí
                </a>
                <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
                <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
                <p><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</p>
                <p><strong>Provincia:</strong> {{ $pedido->provincia->provincia }}</p>
                <p><strong>País:</strong> {{ $pedido->pais->pais }}</p>
                <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                <p><strong>Email:</strong> {{ $pedido->email }}</p>
                <p><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</p>
                <p><strong>Flete:</strong> {{ $pedido->flete->nombre ?? 'Sin flete' }}</p>
                <p><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</p>
                <p><strong>Diferencia (%):</strong> {{ $pedido->diferencia }}</p>
                <p><strong>Bonificación:</strong> {{ $pedido->bonificacion }}%</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Productos</div>
            <div class="card-body">

                @php
                    $familiasImplemento = [1,2,3,4,5,6];
                    $familiasComponente = [7];
                    $familiasAccesorio = [8];

                    $grupoImplemento = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasImplemento));
                    $grupoComponente = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasComponente));
                    $grupoAccesorio = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasAccesorio));

                    $totalCantidad = $subtotal = $ivaTotal = $totalGeneral = 0;
                @endphp

                @foreach ([
                    'Implementos' => $grupoImplemento,
                    'Componentes / Opcionales' => $grupoComponente,
                    'Accesorios' => $grupoAccesorio
                ] as $titulo => $grupo)
                    @if ($grupo->count())
                        <h4>{{ $titulo }}</h4>
                        <table>
                            <thead>
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
                            </thead>
                            <tbody>
                                @foreach ($grupo as $sp)
                                    @php
                                        $esAccesorio = $sp->producto->familia_id == 8;
                                        $precioConDiferencia = $sp->precio * (1 + ($sp->diferencia ?? 0) / 100);
                                        $precioBonificado = $precioConDiferencia * (1 - $sp->subbonificacion / 100);
                                        $sub = $precioBonificado * $sp->cantidad;
                                        $ivaMonto = ($sub * $sp->iva) / 100;
                                        $total = $sub + $ivaMonto;

                                        $totalCantidad += $sp->cantidad;
                                        $subtotal += $sub;
                                        $ivaTotal += $ivaMonto;
                                        $totalGeneral += $total;
                                    @endphp
                                    <tr>
                                        <td>{{ $sp->producto->nombre }}</td>
                                        <td>{{ $sp->color->nombre }}</td>
                                        <td>{{ $sp->moneda->moneda }}</td>
                                        <td>{{ $sp->cantidad }}</td>
                                        <td>${{ number_format($sp->precio, 2, ',', '.') }}</td>
                                        <td>{{ $esAccesorio ? '0%' : $sp->subbonificacion . '%' }}</td>
                                        <td>{{ $esAccesorio ? '0%' : ($sp->diferencia ?? 0) . '%' }}</td>
                                        <td>${{ number_format($sub, 2, ',', '.') }}</td>
                                        <td>{{ $sp->iva }}%</td>
                                        <td>${{ number_format($ivaMonto, 2, ',', '.') }}</td>
                                        <td>${{ number_format($total, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach

                <p class="total">Cantidad Total: {{ $totalCantidad }}</p>
                <p><strong>Moneda:</strong>
                    {{ $pedido->moneda->moneda ?? 'No definida' }}
                    @if ($pedido->moneda && $pedido->moneda->desc_ampliada)
                        - {{ $pedido->moneda->desc_ampliada }}
                    @endif
                </p>
                <p class="total">Subtotal: ${{ number_format($subtotal, 2, ',', '.') }}</p>
                <p class="total">Importe IVA: ${{ number_format($ivaTotal, 2, ',', '.') }}</p>
                <p class="total">Total General: ${{ number_format($totalGeneral, 2, ',', '.') }}</p>

                <p class="total text-danger">
                    <strong>Descuento especial por exposición de Agro Activa (5%):</strong>
                    - ${{ number_format($totalGeneral * 0.05, 2, ',', '.') }}
                </p>
                <p class="total text-danger">
                    <strong>Total con descuento:</strong>
                    ${{ number_format($totalGeneral * 0.95, 2, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
            <p>Fecha de envío: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>

</html>
