<div class="card mb-4">
    <div class="card-header">Datos del Pedido</div>
    <div class="card-body row">
<div class="col-md-4">
    <label for="cliente">Cliente*</label>
    <input type="text" name="cliente" id="cliente" class="form-control"
           value="{{ old('cliente', $pedido->cliente ?? '') }}" required>
</div>


        <div class="col-md-2">
            <label for="cuit">CUIT*</label>
            <input type="text" name="cuit" id="cuit" class="form-control" maxlength="11"
                   value="{{ old('cuit', $pedido->cuit ?? '') }}" required>
        </div>

        <div class="col-md-3">
            <label for="forma_pago">Forma de Pago*</label>
            <select name="forma_pago" id="forma_pago" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach ($formasPago as $forma)
<option value="{{ $forma->id }}" {{ old('forma_pago_id', $pedido->forma_pago_id ?? '') == $forma->id ? 'selected' : '' }}>
    {{ $forma->nombre ?? $forma->descripcion ?? $forma->forma_pago ?? 'Forma #' . $forma->id }}
</option>

                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="moneda_id">Moneda*</label>
            <select name="moneda_id" id="moneda_id" class="form-control" required>
                <option value="">Seleccione moneda</option>
                @foreach ($monedas as $moneda)
                    <option value="{{ $moneda->id }}" {{ old('moneda_id', $pedido->moneda_id ?? '') == $moneda->id ? 'selected' : '' }}>
                        {{ $moneda->moneda }} - {{ $moneda->desc_ampliada }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 mt-3">
            <label for="bonificacion">Bonificación Global (%)</label>
            <input type="number" name="bonificacion" id="bonificacion" class="form-control" step="0.01" min="0" max="100"
                   value="{{ old('bonificacion', $pedido->bonificacion ?? 0) }}">
        </div>

        <div class="col-md-3 mt-3">
            <label for="diferencia">Diferencia de Pago Global (%)</label>
            <input type="number" name="diferencia" id="diferencia" class="form-control" step="0.01" min="0" max="100"
                   value="{{ old('diferencia', $pedido->diferencia ?? 0) }}">
        </div>

        <div class="col-md-3 mt-3">
            <label for="flete">Flete ($)</label>
            <input type="number" name="flete" id="flete" class="form-control" step="0.01" min="0"
                   value="{{ old('flete', $pedido->flete ?? 0) }}">
        </div>

        <div class="col-md-3 mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $pedido->email ?? '') }}">
        </div>

        <div class="col-md-12 mt-3">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ old('observaciones', $pedido->observaciones ?? '') }}</textarea>
        </div>
    </div>
</div>
