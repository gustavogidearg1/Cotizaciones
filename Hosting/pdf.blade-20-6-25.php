<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 10px; }
        .logo { height: 50px; }
        .titulo { text-align: right; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td {
            border: 1px solid #ddd; padding: 6px; text-align: left;
        }
        .table th { background-color: #f2f2f2; }
        .imagenes { display: flex; gap: 10px; margin: 20px 0; }
        .imagenes img {
            width: 200px; height: 200px; object-fit: cover;
            border: 1px solid #ccc; padding: 4px;
        }
        .totales td {
            font-weight: bold;
            text-align: right;
            page-break-inside: avoid;
        }
        .footer {
            border-top: 1px solid #999;
            padding-top: 10px;
            font-size: 11px;
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <div class="header">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo"></td>
                <td class="titulo">
                    <h2>{{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }}</h2>
                    <small>Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</small>
                </td>
            </tr>
        </table>
    </div>

    <!-- DATOS -->
    <table class="table">
        <tr><th>Cliente</th><td>{{ $pedido->cliente }}</td></tr>
        <tr><th>Dirección</th><td>{{ $pedido->direccion }}</td></tr>
        <tr><th>Localidad</th><td>{{ $pedido->localidad->nombre ?? '-' }}</td></tr>
        <tr><th>Provincia</th><td>{{ $pedido->provincia->provincia ?? '-' }}</td></tr>
        <tr><th>País</th><td>{{ $pedido->pais->pais ?? '-' }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $pedido->telefono }}</td></tr>
        <tr><th>Email</th><td>{{ $pedido->email }}</td></tr>
        <tr><th>Forma de Entrega</th><td>{{ $pedido->forma_entrega }}</td></tr>
        <tr><th>Fecha Necesidad</th><td>{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</td></tr>
        <tr><th>Forma de Pago</th><td>{{ $pedido->formaPago->nombre ?? '-' }}</td></tr>
        <tr><th>Flete</th><td>{{ $pedido->flete->nombre ?? 'Sin flete' }}</td></tr>
        <tr><th>Bonificación</th><td>{{ $pedido->bonificacion }}%</td></tr>
        <tr><th>Diferencia de Pago</th><td>{{ $pedido->diferencia ?? 0 }}%</td></tr>
        @if($pedido->observacion)
        <tr><th>Observaciones</th><td>{{ $pedido->observacion }}</td></tr>
        @endif
    </table>

    <!-- IMÁGENES -->
    @if($imagen1_url || $imagen2_url)
        <div class="imagenes">
            @if($imagen1_url)
                <img src="{{ $imagen1_url }}" alt="Imagen 1">
            @endif
            @if($imagen2_url)
                <img src="{{ $imagen2_url }}" alt="Imagen 2">
            @endif
        </div>
    @endif

    <!-- PRODUCTOS -->
    <h3>Productos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
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
            @php
                $totalCantidad = $subtotal = $ivaTotal = $totalGeneral = 0;
            @endphp
            @foreach($pedido->subPedidos as $sub)
                @php
                    $precioFinal = $sub->precio * (1 + ($sub->diferencia ?? 0) / 100);
                    $subTotalItem = $precioFinal * $sub->cantidad * (1 - $sub->subbonificacion / 100);
                    $ivaMonto = $subTotalItem * $sub->iva / 100;
                    $total = $subTotalItem + $ivaMonto;
                    $totalCantidad += $sub->cantidad;
                    $subtotal += $subTotalItem;
                    $ivaTotal += $ivaMonto;
                    $totalGeneral += $total;
                @endphp
                <tr>
                    <td>{{ $sub->producto->nombre }}</td>
                    <td>{{ $sub->cantidad }}</td>
                    <td>${{ number_format($sub->precio, 2, ',', '.') }}</td>
                    <td>{{ $sub->subbonificacion }}%</td>
                    <td>{{ $sub->diferencia ?? 0 }}%</td>
                    <td>${{ number_format($subTotalItem, 2, ',', '.') }}</td>
                    <td>{{ $sub->iva }}%</td>
                    <td>${{ number_format($ivaMonto, 2, ',', '.') }}</td>
                    <td>${{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="totales">
            <tr><td colspan="9">Cantidad Total: {{ $totalCantidad }}</td></tr>
            <tr><td colspan="9">Subtotal: ${{ number_format($subtotal, 2, ',', '.') }}</td></tr>
            <tr><td colspan="9">Importe IVA: ${{ number_format($ivaTotal, 2, ',', '.') }}</td></tr>
            <tr><td colspan="9">Total General: ${{ number_format($totalGeneral, 2, ',', '.') }}</td></tr>
            <tr><td colspan="9">Descuento especial AgroActiva (5%): - ${{ number_format($totalGeneral * 0.05, 2, ',', '.') }}</td></tr>
            <tr><td colspan="9">Total con descuento: ${{ number_format($totalGeneral * 0.95, 2, ',', '.') }}</td></tr>
        </tfoot>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <p>Creado por: {{ $pedido->user->name ?? '' }} - Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

</body>
</html>
