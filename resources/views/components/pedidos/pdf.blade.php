<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .logo { height: 60px; }
        .info-pedido { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
        .page-break { page-break-after: always; }
        .imagenes-pedido {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .imagen-pdf {
            max-width: 250px;
            max-height: 250px;
            margin: 10px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: right;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <!-- Encabezado con logo -->
    <div class="header">
        <div>
            @if($logo_url)
                <img src="{{ $logo_url }}" class="logo" alt="Logo">
                <!-- Mensaje de debug -->
                <p style="font-size: 8px; color: gray;">Logo cargado desde: {{ $logo_url }}</p>
            @else
                <p style="color: red;">No se pudo cargar el logo</p>
            @endif
        </div>
        <div>
            <h1>{{ $pedido->TipoPedido->nombre }} #{{ $pedido->id }}</h1>
            <p>Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="info-pedido">
        <h3>Información del Pedido</h3>
        <table class="table">
            <tr>
                <th>Cliente</th>
                <td>{{ $pedido->cliente->nombre }}</td>
            </tr>
            <tr>
                <th>Fecha de Necesidad</th>
                <td>{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Forma de Pago</th>
                <td>{{ $pedido->formaPago->nombre }}</td>
            </tr>

            <tr>
                <th>Bonificación</th>
                <td>{{ $pedido->bonificacion }}%</td>
            </tr>
            @if($pedido->observacion)
            <tr>
                <th>Observaciones</th>
                <td>{{ $pedido->observacion }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- Sección de imágenes del pedido -->
    @if($imagen1_url || $imagen2_url)
    <div class="imagenes-pedido">
        @if($imagen1_url)
        <div>
            <img src="{{ $imagen1_url }}" class="imagen-pdf">
        </div>
        @endif
        @if($imagen2_url)
        <div>
            <img src="{{ $imagen2_url }}" class="imagen-pdf">
        </div>
        @endif
    </div>
    @endif

    <h3>Productos</h3>
    @if($pedido->subPedidos->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Bonificación</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->subPedidos as $subPedido)
                <tr>
                    <td>{{ $subPedido->producto->nombre }} ({{ $subPedido->producto->codigo }})</td>
                    <td>{{ number_format($subPedido->precio, 2, ',', '.') }}</td>
                    <td>{{ $subPedido->subbonificacion }}%</td>
                    <td>{{ $subPedido->cantidad }}</td>
                    <td>{{ number_format($subPedido->subtotal, 2, ',', '.') }}</td>
                    <td>{{ $subPedido->iva }}%</td>
                    <td>{{ number_format($subPedido->total, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="total">Total General:</td>
                    <td>{{ number_format($pedido->total, 2, ',', '.') }} {{ $pedido->subPedidos->first()->moneda->moneda ?? '' }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>No hay productos asociados a este pedido</p>
    @endif

    <!-- Pie de página -->
    <div class="footer">
        <p><strong>Creado por:</strong> {{ $pedido->user->name }}</p>
        <p>Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
