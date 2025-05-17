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
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }
        .logo {
            max-height: 50px;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
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
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .product-img {
            max-width: 80px;
            max-height: 80px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
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
                    <td width="50%">
                        <strong>COMOFRA SRL</strong>
                    </td>
                    <td width="50%" style="text-align: right;">
                        <h2 style="margin: 0; color: white;">{{ $pedido->TipoPedido->nombre }} #{{ $pedido->id }}</h2>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                Datos del Pedido
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
                        <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
                        <p><strong>Localidad:</strong> {{ $pedido->localidad->nombre }}</p>
                        <p><strong>Provincia:</strong> {{ $pedido->provincia->nombre }}</p>
                        <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                        <p><strong>Email:</strong> {{ $pedido->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
                        <p><strong>Fecha Necesidad:</strong> {{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</p>
                        <p><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre }}</p>
                        <p><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</p>
                        <p><strong>Bonificación:</strong> {{ $pedido->bonificacion }}%</p>
                        <p><strong>Creado por:</strong> {{ $pedido->user->name }}</p>
                    </div>
                </div>

                @if($pedido->observacion)
                    <div class="mt-3">
                        <p><strong>Observaciones:</strong></p>
                        <p>{{ $pedido->observacion }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Productos
            </div>
            <div class="card-body">
                @foreach($pedido->subPedidos as $subPedido)
                    <div style="margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                        <h4>{{ $subPedido->producto->nombre }}</h4>
                        <p><strong>Código:</strong> {{ $subPedido->producto->codigo }}</p>
                        <p><strong>Color:</strong> {{ $subPedido->color->nombre }}</p>

                        <table>
                            <thead>
                                <tr>
                                    <th>Precio Unitario</th>
                                    <th>Bonificación</th>
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
                                    <td>{{ number_format($subPedido->precio * (1 - $subPedido->subbonificacion / 100), 2, ',', '.') }}</td>
                                    <td>{{ $subPedido->cantidad }}</td>
                                    <td>{{ number_format($subPedido->subtotal, 2, ',', '.') }}</td>
                                    <td>{{ $subPedido->moneda->moneda }}</td>
                                    <td>{{ $subPedido->iva }}%</td>
                                    <td>{{ number_format($subPedido->total, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if($subPedido->detalle)
                            <p><strong>Detalle:</strong> {{ $subPedido->detalle }}</p>
                        @endif
                    </div>
                @endforeach

                <div class="total">
                    <h3>Total General: {{ number_format($pedido->total, 2, ',', '.') }} {{ $pedido->subPedidos->first()->moneda->moneda ?? '' }}</h3>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
            <p>Fecha de envío: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
