<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
         body {
        font-family: Arial, sans-serif;
        font-size: 13px;
        background: #faf9f6;
        margin: 0;
        padding: 0;
    }
    @page {
        margin: 10;
    }
    .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        background: #fff;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
    }

        .card-header {
            background: #FF9900;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 18px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header img {
            height: 45px;
        }

        .card-header h2 {
            font-size: 23px;
            margin: 0;
            font-weight: 700;
        }

.datos, .datos2 {
    display: flex;
    flex-wrap: nowrap;
    gap: 26px;
}
.datos > div, .datos2 > div {
    flex: 1 1 0;
    min-width: 0;
}

        .datos div,
        .datos2 div {
            min-width: 190px;
        }

        .observacion {
            background: #fdf3e6;
            border-left: 5px solid #FF9900;
            margin-bottom: 14px;
            padding: 7px 15px;
            font-size: 13px;
        }

        .imagenes {
            display: flex;
            gap: 18px;
            margin-bottom: 15px;
            margin-top: 8px;
        }

        .imagenes img {
            width: 190px;
            height: 190px;
            object-fit: cover;
            border: 1.5px solid #FF9900;
            border-radius: 8px;
            padding: 3px;
            background: #fff;
        }

        .bg-orange {
            background: #FF9900;
            color: #fff;
            padding: 7px 12px;
            border-radius: 8px;
            margin: 18px 0 8px 0;
            font-size: 19px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .producto-bloque {
            background: #f8f7f3;
            border: 1.2px solid #ece5dd;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 9px 16px 6px 16px;
        }

        .producto-bloque strong {
            color: #cc7000;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            min-width: 150px;
            margin-bottom: 3px;
        }

        .totales {
            margin-top: 15px;
            background: #fff5e1;
            border-radius: 8px;
            padding: 13px 20px 7px 0;
            font-size: 15px;
            box-shadow: 0 1px 3px #efefef;
        }

        .totales p {
            margin: 3px 0;
        }

        .footer {
            border-top: 1.5px solid #FF9900;
            margin-top: 36px;
            padding-top: 8px;
            text-align: right;
            font-size: 12px;
            color: #cc7000;
        }

        .small {
            font-size: 11px;
            color: #888;
        }

        /* Sin Bootstrap, pero "imitando" cards, filas y espaciado */
    </style>
</head>

<body>
    <div class="container">

        <!-- ENCABEZADO -->
<div class="card-header" style="padding: 16px 0;">
    <table width="100%" style="border: none;">
        <tr>
            <td style="width: 120px;">
                <img src="{{ public_path('images/Isologotipo con anclaje. Negro CMYK.png') }}" alt="Logo-1" height="50">
            </td>
            <td style="text-align: right; font-size: 23px; font-weight: 700;">
                {{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }} / {{ $pedido->user->nom_corto ?? '' }}
            </td>
        </tr>
    </table>
</div>



        <!-- DATOS -->
<table width="100%" style="margin-top: 16px; border-collapse: collapse;">
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">Cliente:</td>
        <td style="padding: 6px 12px;">{{ $pedido->cliente }}</td>
        <td style="padding: 6px 12px; font-weight: bold;">Dirección:</td>
        <td style="padding: 6px 12px;">{{ $pedido->direccion }}</td>
    </tr>
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">Email:</td>
        <td style="padding: 6px 12px;">{{ $pedido->email }}</td>
        <td style="padding: 6px 12px; font-weight: bold;">Teléfono:</td>
        <td style="padding: 6px 12px;">{{ $pedido->telefono }}</td>
    </tr>
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">Localidad:</td>
        <td style="padding: 6px 12px;">{{ $pedido->localidad->nombre ?? '-' }}</td>
        <td style="padding: 6px 12px; font-weight: bold;">Provincia:</td>
        <td style="padding: 6px 12px;">{{ $pedido->provincia->provincia ?? '-' }}</td>
    </tr>
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">País:</td>
        <td style="padding: 6px 12px;">{{ $pedido->pais->pais ?? '-' }}</td>
        <td style="padding: 6px 12px; font-weight: bold;">Flete:</td>
        <td style="padding: 6px 12px;">{{ $pedido->flete->nombre ?? 'Sin flete' }}</td>
    </tr>
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">Forma de Pago:</td>
        <td style="padding: 6px 12px;">{{ $pedido->formaPago->nombre ?? '-' }}</td>
        <td style="padding: 6px 12px; font-weight: bold;">Forma de Entrega:</td>
        <td style="padding: 6px 12px;">{{ $pedido->forma_entrega }}</td>
    </tr>
    <tr>
        <td style="padding: 6px 12px; font-weight: bold;">Fecha de Necesidad:</td>
        <td style="padding: 6px 12px;">{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('d/m/Y') }}</td>
        <td></td>
        <td></td>
    </tr>
</table>


@if ($pedido->observacion)
    <div class="observacion" style="margin-top:8px;">
        <strong>Observaciones:</strong> {{ $pedido->observacion }}
    </div>
@endif

@php
    $primerProductoInfo = $pedido->subPedidos
        ->map(fn($sp) => $sp->producto)
        ->firstWhere(fn($p) => $p && in_array($p->familia_id, range(1, 7)));
@endphp

@if ($primerProductoInfo)
    <div style="margin-top: 14px;">
        @if ($primerProductoInfo->links)
            <p><strong>Links del Producto:</strong> <a href="{{ $primerProductoInfo->links }}">{{ $primerProductoInfo->links }}</a></p>
        @endif
        @if ($primerProductoInfo->detalle)
            <p><strong>Detalle del Producto:</strong> {{ $primerProductoInfo->detalle }}</p>
        @endif
    </div>
@endif
        
        
        <!-- IMÁGENES -->
@php
    $img1 = $pedido->imagen;
    $img2 = $pedido->imagen_2;
@endphp

@if ($img1 && file_exists(public_path($img1)))
    <img src="{{ public_path($img1) }}" alt="Imagen 1">
@endif
@if ($img2 && file_exists(public_path($img2)))
    <img src="{{ public_path($img2) }}" alt="Imagen 2">
@endif

@php
    // Si tuviste el bloque de productos únicos...
    $productosUnicos = $pedido->subPedidos->pluck('producto')->unique('id');
@endphp


@if ($productosUnicos->count())
    <table width="100%" style="margin: 25px 0; border-collapse: collapse;">
        <tr>
            @php $i = 0; @endphp
            @foreach ($productosUnicos as $producto)
                @foreach (['img', 'img_1', 'img_2', 'img_3'] as $imgField)
                    @php
                        $imgPath = $producto->$imgField;
                        $showImg = false;
                        if ($imgPath) {
                            if (Str::startsWith($imgPath, 'http')) {
                                $finalImg = $imgPath;
                                $showImg = true;
                            } else {
                                $localPath = ltrim($imgPath, '/');
                                $absolutePath = public_path($localPath);
                                if (file_exists($absolutePath)) {
                                    $finalImg = $absolutePath;
                                    $showImg = true;
                                }
                            }
                        }
                    @endphp
                    @if ($showImg)
                        <td style="padding: 5px; text-align: center;">
                            <img src="{{ $finalImg }}" alt="Imagen producto"
                                style="width: 120px; height: 120px; object-fit: cover; border: 1.5px solid #FF9900; border-radius: 8px; padding: 4px; background: #fff;">

                        </td>
                        @php $i++; @endphp
                        @if ($i % 4 == 0)
                            </tr><tr>
                        @endif
                    @endif
                @endforeach
            @endforeach
            @if ($i % 4 != 0)
                @for ($j = 0; $j < (4 - $i % 4); $j++)
                    <td></td>
                @endfor
            @endif
        </tr>
    </table>
@endif





        <!-- PRODUCTOS -->
        <div class="bg-orange">Productos del Pedido</div>
       

        @php
        $familiasImplemento = [1, 2, 3, 4, 5, 6];
        $familiasComponente = [7];
        $familiasAccesorio = [8];

        $grupoImplemento = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasImplemento));
        $grupoComponente = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasComponente));
        $grupoAccesorio = $pedido->subPedidos->filter(fn($sp) => in_array($sp->producto->familia_id, $familiasAccesorio));
        $subtotal = $ivaTotal = $totalGeneral = 0;
        $totalCantidadImplementos = $grupoImplemento->sum('cantidad');
        @endphp

        @foreach ([
        ['grupo'=>$grupoImplemento, 'titulo'=>'Implementos'],
        ['grupo'=>$grupoComponente, 'titulo'=>'Componentes'],
        ['grupo'=>$grupoAccesorio, 'titulo'=>'Accesorios'],
        ] as $block)
        @if($block['grupo']->count())
        <div style="margin:10px 0 4px 0;font-weight:600;font-size:16px;">
            {{ $block['titulo'] }}
        </div>
        
         
        @foreach($block['grupo'] as $sp)
        @php
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
        $subtotal += $sub;
        $ivaTotal += $ivaMonto;
        $totalGeneral += $total;
        @endphp
        <div class="producto-bloque">
            <!-- Fila 1 -->
            <div class="row">
                <div class="col"><strong>Producto:</strong> {{ $producto->nombre }}</div>
                <div class="col"><strong>Color:</strong> {{ $sp->color->nombre ?? '-' }}</div>
                <div class="col"><strong>Moneda:</strong> {{ $sp->moneda->moneda ?? '-' }}</div>
                <div class="col"><strong>Cantidad:</strong> {{ $sp->cantidad }}</div>
                <div class="col"><strong>Precio:</strong> ${{ number_format($sp->precio, 2, ',', '.') }}</div>
            </div>
            <!-- Fila 2 -->
            <div class="row small">
                <div class="col">
                    @if(($sp->diferencia ?? 0) != 0)
                    <strong>Diferencia (%):</strong> {{ number_format($sp->diferencia, 2, ',', '.') }}%
                    @endif
                </div>
                <div class="col">@if($sp->subbonificacion > 0)<strong>Desc. 1:</strong> {{ $sp->subbonificacion }}%@endif</div>
                <div class="col">@if($sp->descuento_2 > 0)<strong>Desc. 2:</strong> {{ $sp->descuento_2 }}%@endif</div>
                <div class="col">@if($sp->descuento_3 > 0)<strong>Desc. 3:</strong> {{ $sp->descuento_3 }}%@endif</div>
                <div class="col">@if($sp->descuento_4 > 0)<strong>Desc. 4:</strong> {{ $sp->descuento_4 }}%@endif</div>
            </div>
            <!-- Fila 3 -->
            <div class="row">
                <div class="col"><strong>Subtotal:</strong> ${{ number_format($sub, 2, ',', '.') }}</div>
                <div class="col"><strong>IVA:</strong> {{ $sp->iva }}%</div>
                <div class="col"><strong>Importe IVA:</strong> ${{ number_format($ivaMonto, 2, ',', '.') }}</div>
                <div class="col"><strong>Total:</strong> ${{ number_format($total, 2, ',', '.') }}</div>
            </div>
            <!-- Fila 4 -->
            <div class="row small">
                <div class="col" style="min-width: 180px;">
                    <strong>Forma de Pago:</strong> {{ $sp->formaPago->nombre ?? '-' }}
                </div>
                <div class="col" style="flex: 3;">
                    @if(!empty($sp->detalle))
                    <strong>Detalle:</strong> {{ $sp->detalle }}
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @endif
        @endforeach

        <!-- TOTALES -->
<div class="totales" style="text-align: right;  margin-left: auto; margin-right: 0;">
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


        <div class="footer">
            Creado por: {{ $pedido->user->name ?? '' }} &nbsp; — &nbsp;
            Generado el: {{ now()->format('d/m/Y H:i') }}
        </div>

    </div>
</body>

</html>