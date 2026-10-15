<!-- Modal de Busqueda de Producto -->
<div class="modal fade" id="modalBuscarProducto" tabindex="-1" aria-labelledby="modalBuscarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarProductoLabel">Buscar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Inputs de búsqueda -->
                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" id="inputBuscarProducto" class="form-control" placeholder="Buscar por nombre, código o familia...">
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="inputBuscarTipo" class="form-control" placeholder="Filtrar por tipo...">
                    </div>
                </div>

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-hover" id="tablaBusquedaProducto">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Familia</th>
                                <th>Tipo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr class="producto-row"
                                    data-id="{{ $producto->id }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-codigo="{{ $producto->codigo }}"
                                    data-familia-nombre="{{ $producto->familia->nombre }}"
                                    data-tipo-nombre="{{ $producto->tipo->nombre ?? '' }}">
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->familia->nombre }}</td>
                                    <td>{{ $producto->tipo->nombre ?? '-' }}</td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm btn-success seleccionar-producto-btn"
                                            data-id="{{ $producto->id }}"
                                            data-nombre="{{ $producto->nombre }}"
                                            data-precio="{{ $producto->precio ?? 0 }}"
                                            data-moneda="{{ $producto->moneda_id }}"
                                            data-index="">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
