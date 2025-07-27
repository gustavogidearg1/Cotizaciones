<div class="mt-5">
    <h4><i class="fas fa-tags me-2"></i> Precios de la última cotización (edición rápida)</h4>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Moneda</th>
                    <th style="width: 120px;">Precio</th>
                    <th style="width: 150px;">Precio Bonificado</th>
                    <th>Detalle</th>
                    <th style="width: 140px;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCotizaciones as $sub)
                    <tr>
                        <form method="POST" action="{{ route('sub_cotizaciones.actualizar', $sub->id) }}">

                            @csrf
                            <td>{{ $sub->producto->nombre ?? '-' }}</td>
                            <td>{{ $sub->moneda->nombre ?? '-' }}</td>
                            <td>
                                <input type="number" name="precio" class="form-control form-control-sm" value="{{ $sub->precio }}" step="0.01" required>
                            </td>
                            <td>
                                <input type="number" name="precio_bonificado" class="form-control form-control-sm" value="{{ $sub->precio_bonificado }}" step="0.01">
                            </td>
                            <td>
                                <input type="text" name="detalle" class="form-control form-control-sm" value="{{ $sub->detalle }}">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
