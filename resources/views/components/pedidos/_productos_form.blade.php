<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Producto*</label>
            <select class="form-control select-producto" name="productos[{{ $index }}][producto_id]" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"
                        data-precio="{{ $producto->precio ?? 0 }}"
                        @isset($subPedido)
                            {{ $subPedido->producto_id == $producto->id ? 'selected' : '' }}
                        @endisset>
                        {{ $producto->codigo }} - {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>color*</label>
            <select class="form-control" name="productos[{{ $index }}][color_id]" required>
                <option value="">Seleccione color</option>
                @foreach($colores as $color)
                    <option value="{{ $color->id }}"
                        @isset($subPedido)
                            {{ $subPedido->color_id == $color->id ? 'selected' : '' }}
                        @endisset>
                        {{ $color->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>Moneda*</label>
            <select class="form-control" name="productos[{{ $index }}][moneda_id]" required>
                <option value="">Seleccione moneda</option>
                @foreach($monedas as $moneda)
                    <option value="{{ $moneda->id }}"
                        @isset($subPedido)
                            {{ $subPedido->moneda_id == $moneda->id ? 'selected' : '' }}
                        @endisset>
                        {{ $moneda->moneda }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Precio*</label>
            <input type="number" step="0.01" min="0" class="form-control precio-input"
                   name="productos[{{ $index }}][precio]"
                   value="{{ $subPedido->precio ?? 0 }}" required>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label>Cantidad*</label>
            <input type="number" min="1" class="form-control cantidad-input"
                   name="productos[{{ $index }}][cantidad]"
                   value="{{ $subPedido->cantidad ?? 1 }}" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>IVA (%)*</label>
            <input type="number" step="0.01" min="0" max="100" class="form-control iva-input"
                   name="productos[{{ $index }}][iva]"
                   value="{{ $subPedido->iva ?? 21 }}" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Subtotal</label>
            <input type="text" class="form-control subtotal-input"
                   value="{{ isset($subPedido) ? number_format($subPedido->subtotal, 2) : '0.00' }}" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Total</label>
            <input type="text" class="form-control total-input"
                   value="{{ isset($subPedido) ? number_format($subPedido->total, 2) : '0.00' }}" readonly>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label>Detalle</label>
            <input type="text" class="form-control"
                   name="productos[{{ $index }}][detalle]"
                   value="{{ $subPedido->detalle ?? '' }}" maxlength="255">
        </div>
    </div>
</div>
