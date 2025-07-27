<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="cotizacion">Código de Cotización*</label>
            <input type="text" class="form-control @error('cotizacion') is-invalid @enderror"
                   id="cotizacion" name="cotizacion"
                   value="{{ old('cotizacion', $cotizacion->cotizacion ?? '') }}" required>
            @error('cotizacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripcion">Descripción*</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                   id="descripcion" name="descripcion"
                   value="{{ old('descripcion', $cotizacion->descripcion ?? '') }}" required>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="vencimiento">Fecha de Vencimiento*</label>
        <input type="date" class="form-control @error('vencimiento') is-invalid @enderror"
               id="vencimiento" name="vencimiento"
               value="{{ old('vencimiento', isset($cotizacion) ?
                   (is_object($cotizacion->vencimiento) ? $cotizacion->vencimiento->format('Y-m-d') :
                   \Carbon\Carbon::parse($cotizacion->vencimiento)->format('Y-m-d')) : '') }}"
               required>
        @error('vencimiento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group mt-3">
    <label for="observacion">Observaciones</label>
    <textarea class="form-control @error('observacion') is-invalid @enderror"
              id="observacion" name="observacion" rows="3">{{ old('observacion', $cotizacion->observacion ?? '') }}</textarea>
    @error('observacion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
