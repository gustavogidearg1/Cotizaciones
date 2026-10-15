@csrf
<div class="mb-3">
    <label>Moneda</label>
    <input type="text" name="moneda" value="{{ old('moneda', $moneda->moneda ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Descripcion Ampliada</label>
    <input type="text" name="desc_ampliada" value="{{ old('desc_ampliada', $moneda->desc_ampliada ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Tipo de Cambio</label>
    <input type="number" step="0.01" min="0.01" name="tipo_cambio" value="{{ old('tipo_cambio', $moneda->tipo_cambio ?? '') }}" class="form-control" required>
</div>
<button type="submit" class="btn btn-primary">Guardar</button>
