<div class="producto-form row g-3 mb-3 producto-item position-relative">

    <input type="hidden" name="productos[{{ $index }}][eliminar]" class="eliminar-input" value="0">

    <div class="row">
        <div class="col-md-4">
            <label>Producto*</label>
            <select class="form-select producto-select" name="productos[{{ $index }}][producto_id]" required>
                <option value="">Seleccione</option>
                @foreach ($productos->sortBy('nombre') as $producto)
                    <option value="{{ $producto->id }}"
                        data-precio="{{ $producto->precio ?? 0 }}"
                        data-moneda="{{ $producto->moneda_id }}"
                        data-familia="{{ $producto->familia_id }}"
                        {{ $subPedido->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} ({{ $producto->codigo }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label>Color</label>
            <select class="form-select" name="productos[{{ $index }}][color_id]">
                <option value="">-</option>
                @foreach ($colores as $color)
                    <option value="{{ $color->id }}" {{ $subPedido->color_id == $color->id ? 'selected' : '' }}>{{ $color->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label>Moneda</label>
            <select class="form-select moneda-select" name="productos[{{ $index }}][moneda_id]">
                <option value="">-</option>
                @foreach ($monedas as $moneda)
                    <option value="{{ $moneda->id }}" {{ $subPedido->moneda_id == $moneda->id ? 'selected' : '' }}>{{ $moneda->moneda }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label>Cantidad</label>
            <input type="number" min="1" name="productos[{{ $index }}][cantidad]" class="form-control cantidad-input" value="{{ $subPedido->cantidad }}" required>
        </div>

        <div class="col-md-2">
            <label>Precio</label>
            <input type="number" step="0.01" name="productos[{{ $index }}][precio]" class="form-control precio-input" value="{{ $subPedido->precio }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <label>Diferencia (%)</label>
            <input type="number" step="0.01" class="form-control diferencia-pago-input" name="productos[{{ $index }}][diferencia]" value="{{ $subPedido->diferencia }}">
        </div>

        <div class="col-md-2">
            <label>Desc (%)</label>
            <input type="number" step="0.01" name="productos[{{ $index }}][subbonificacion]" value="{{ $subPedido->subbonificacion }}" class="form-control descuento-porcentaje">
        </div>

        <div class="col-md-2">
            <label>Desc. 2 (%)</label>
            <input type="number" step="0.01" class="form-control descuento-2-input" name="productos[{{ $index }}][descuento_2]" value="{{ $subPedido->descuento_2 }}">
        </div>

        <div class="col-md-2">
            <label>Desc. 3 (%)</label>
            <input type="number" step="0.01" class="form-control descuento-3-input" name="productos[{{ $index }}][descuento_3]" value="{{ $subPedido->descuento_3 }}">
        </div>

        <div class="col-md-2">
            <label>Desc. 4 (%)</label>
            <input type="number" step="0.01" class="form-control descuento-4-input" name="productos[{{ $index }}][descuento_4]" value="{{ $subPedido->descuento_4 }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <label>Subtotal</label>
            <input type="text" class="form-control subtotal-input" value="{{ $subPedido->subtotal ?? 0 }}" readonly>
        </div>

        <div class="col-md-2">
            <label>IVA (%)</label>
            <input type="number" step="0.01" class="form-control iva-input" name="productos[{{ $index }}][iva]" value="{{ $subPedido->iva }}">
        </div>

        <div class="col-md-2">
            <label>Importe IVA</label>
            <input type="text" class="form-control iva-monto-input" value="{{ $subPedido->importe_iva ?? 0 }}" readonly>
        </div>

        <div class="col-md-2">
            <label>Total</label>
            <input type="text" class="form-control total-input" value="{{ $subPedido->total ?? 0 }}" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label>Forma de Pago</label>
            <select class="form-select" name="productos[{{ $index }}][forma_pago_id]">
                <option value="">-</option>
                @foreach ($formasPago as $fp)
                    <option value="{{ $fp->id }}" {{ $subPedido->forma_pago_id == $fp->id ? 'selected' : '' }}>{{ $fp->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Detalle</label>
            <input type="text" class="form-control" name="productos[{{ $index }}][detalle]" maxlength="255" value="{{ $subPedido->detalle }}">
        </div>
    </div>

    <input type="hidden" name="productos[{{ $index }}][sub_fecha_entrega]" value="__FECHA_ENTREGA__">

</div>
