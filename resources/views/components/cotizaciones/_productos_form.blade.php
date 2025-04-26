<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label for="productos_{{ $index }}_producto_id">Producto*</label>
            <select class="form-control select-producto"
                    id="productos_{{ $index }}_producto_id"
                    name="productos[{{ $index }}][producto_id]" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"
                        @if(isset($subCotizacion) && $subCotizacion->producto_id == $producto->id) selected @endif>
                        {{ $producto->codigo }} - {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="productos_{{ $index }}_moneda_id">Moneda*</label>
            <select class="form-control"
                    id="productos_{{ $index }}_moneda_id"
                    name="productos[{{ $index }}][moneda_id]" required>
                <option value="">Seleccione moneda</option>
                @foreach($monedas as $moneda)
                    <option value="{{ $moneda->id }}"
                        @if(isset($subCotizacion) && $subCotizacion->moneda_id == $moneda->id) selected @endif>
                        {{ $moneda->moneda }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="productos_{{ $index }}_precio">Precio*</label>
            <input type="number" step="0.01" min="0" class="form-control precio-input"
                   id="productos_{{ $index }}_precio"
                   name="productos[{{ $index }}][precio]"
                   value="{{ $subCotizacion->precio ?? '0.00' }}" required>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="productos_{{ $index }}_precio_bonificado">Precio Bonif.*</label>
            <input type="number" step="0.01" min="0" class="form-control precio-bonificado-input"
                   id="productos_{{ $index }}_precio_bonificado"
                   name="productos[{{ $index }}][precio_bonificado]"
                   value="{{ $subCotizacion->precio_bonificado ?? '0.00' }}" required>
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group">
            <label for="productos_{{ $index }}_descuento">Desc.%*</label>
            <input type="number" step="0.01" min="0" max="100" class="form-control descuento-input"
                   id="productos_{{ $index }}_descuento"
                   name="productos[{{ $index }}][descuento]"
                   value="{{ $subCotizacion->descuento ?? '0.00' }}" required>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="productos_{{ $index }}_detalle">Detalle</label>
            <input type="text" class="form-control"
                   id="productos_{{ $index }}_detalle"
                   name="productos[{{ $index }}][detalle]"
                   value="{{ $subCotizacion->detalle ?? '' }}" maxlength="100">
        </div>
    </div>
</div>
