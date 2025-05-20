<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido Público #{{ $pedido->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Resumen del Pedido #{{ $pedido->id }}</h2>
        <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
        <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
        <p><strong>Forma de Pago:</strong> {{ $pedido->formaPago->nombre ?? '-' }}</p>
        <p><strong>Forma de Entrega:</strong> {{ $pedido->forma_entrega }}</p>
        <p><strong>Observaciones:</strong> {{ $pedido->observacion ?? 'Sin observaciones' }}</p>

        <h4 class="mt-4">Productos</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->subPedidos as $sub)
                    <tr>
                        <td>{{ $sub->producto->nombre }}</td>
                        <td>${{ number_format($sub->precio, 2, ',', '.') }}</td>
                        <td>{{ $sub->cantidad }}</td>
                        <td>${{ number_format($sub->subtotal, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-end"><strong>Total:</strong> ${{ number_format($pedido->total, 2, ',', '.') }}</p>

        <p class="text-end mt-4"><small>Visualización pública - generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</small></p>
    </div>
</body>
</html>
