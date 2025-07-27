<!-- Modal de Búsqueda de Localidad -->
<div class="modal fade" id="modalBuscarLocalidad" tabindex="-1" aria-labelledby="modalBuscarLocalidadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarLocalidadLabel">Buscar Localidad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="inputBuscarLocalidad" class="form-control mb-3" placeholder="Escriba nombre, provincia o país...">
                
                <div class="d-flex justify-content-between mb-2">
    <div></div>
    <button type="button" class="btn btn-outline-success btn-sm" id="btnMostrarFormularioLocalidad">
        <i class="fas fa-plus"></i> Agregar Nueva Localidad
    </button>
</div>

<div id="formNuevaLocalidad" style="display: none;" class="mb-3 border rounded p-3 bg-light">
    <h6 class="mb-2">Nueva Localidad</h6>
    <form id="nuevaLocalidadAjaxForm">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" id="nueva_localidad_nombre" placeholder="Nombre" required>
            </div>
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control" id="nueva_localidad_cp" placeholder="CP" required>
            </div>
            <div class="col-md-3 mb-2">
                <select class="form-select" id="nueva_localidad_provincia" required>
                    <option value="">Provincia</option>
                    @foreach($provincias as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->provincia }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <select class="form-select" id="nueva_localidad_pais" required>
                    <option value="">País</option>
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm mt-2">Guardar</button>
        <button type="button" class="btn btn-link btn-sm mt-2" id="btnCancelarNuevaLocalidad">Cancelar</button>
        <div id="msgNuevaLocalidad" class="mt-2"></div>
    </form>
</div>

                
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-bordered table-hover" id="tablaBusquedaLocalidad">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>CP</th>
                                <th>Provincia</th>
                                <th>País</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($localidades as $localidad)
<tr
    data-id="{{ $localidad->id }}"
    data-nombre="{{ $localidad->nombre }}"
    data-provincia-id="{{ $localidad->provincia->id }}"
    data-provincia-nombre="{{ $localidad->provincia->provincia }}"
    data-pais-id="{{ $localidad->pais->id }}"
    data-pais-nombre="{{ $localidad->pais->pais }}"
>
    <td>{{ $localidad->nombre }}</td>
    <td>{{ $localidad->cp }}</td>
    <td>{{ $localidad->provincia->provincia }}</td>
    <td>{{ $localidad->pais->pais }}</td>
    <td>
        <button type="button" class="btn btn-success btn-sm seleccionar-localidad-btn"
            data-id="{{ $localidad->id }}"
            data-nombre="{{ $localidad->nombre }}"
            data-provincia-id="{{ $localidad->provincia->id }}"
            data-provincia-nombre="{{ $localidad->provincia->provincia }}"
            data-pais-id="{{ $localidad->pais->id }}"
            data-pais-nombre="{{ $localidad->pais->pais }}"
            data-cp="{{ $localidad->cp }}">
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
