<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Pedido Creado</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { background-color: #f8f9fa; padding: 10px; text-align: center; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nuevo Pedido Creado</h2>
    </div>

    <div class="content">
        <p>Se ha creado un nuevo pedido en el sistema con los siguientes detalles:</p>

        <h3>Información del Pedido</h3>
        <p><strong>Número de Pedido:</strong> {{ $pedido->id }}</p>
        <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
        <p><strong>Fecha:</strong> {{ $pedido->fecha->format('d/m/Y H:i') }}</p>
        <p><strong>Fecha de Necesidad:</strong> {{ $pedido->fecha_necesidad->format('d/m/Y') }}</p>
        <p><strong>Solicitante:</strong> {{ $pedido->solicitante }}</p>
        <p><strong>Observaciones:</strong> {{ $pedido->observacion ?? 'Ninguna' }}</p>

        <h3>Productos</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>IVA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->subPedidos as $subPedido)
                <tr>
                    <td>{{ $subPedido->producto->nombre }}</td>
                    <td>{{ $subPedido->cantidad }}</td>
                    <td>${{ number_format($subPedido->precio, 2) }}</td>
                    <td>{{ $subPedido->iva }}%</td>
                    <td>${{ number_format($subPedido->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Puedes ver más detalles del pedido accediendo al sistema.</p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
    </div>
</body>
</html>
