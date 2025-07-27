@extends('layouts.app')

<style>
    .familia-item {
        transition: all 0.3s ease;
    }

    .familia-item:hover {
        transform: scale(1.05);
    }

    .border-primary {
        border: 2px solid #0d6efd !important;
    }

    /* Estilos para el modal de confirmación */
    #debugModal .modal-xl {
        max-width: 90%;
    }

    #debugModal .card {
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    #debugModal .card-header {
        padding: 0.75rem 1.25rem;
        font-weight: 600;
    }

    #debugModal .table {
        margin-bottom: 0;
        font-size: 0.875rem;
    }

    #debugModal .table th {
        background-color: #f8f9fa;
        white-space: nowrap;
    }

    #debugModal pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
        max-height: 300px;
        overflow-y: auto;
    }

    /* Mejora para las tablas de datos */
    #debugFormTable td {
        padding: 0.5rem;
        vertical-align: top;
    }

    #debugFormTable tr td:first-child {
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
    }

    #debugProductsTable tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
        #debugModal .modal-xl {
            max-width: 95%;
        }

        #debugModal .row {
            flex-direction: column;
        }

        #debugModal .col-md-6 {
            width: 100%;
        }
    }

    .spinner-border {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@include('abm.localidad._modal_buscar_localidad')


<div class="container">
    <h1>Crear nuevo Cotizacion o Pedido</h1>

    <form action="{{ route('pedidos.store') }}" method="POST" id="pedido-form" enctype="multipart/form-data">
        @csrf

        <!-- Formulario principal -->
        <div class="card mb-4">
            <div class="card-header">Datos del Pedido</div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="cliente">Nombre del Cliente<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="tipo_pedido_id">Tipo de Pedido<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="tipo_pedido_id" name="tipo_pedido_id" required>
                                    <option value="">Seleccione un tipo</option>
                                    @foreach ($tipoPedidos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $tipo->id == 1 ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="email">Email<strong style="color: red;">*</strong></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="cuit">CUIT o DNI<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="cuit" name="cuit" maxlength="11"
                                    required>
                            </div>
                        </div>


                    </div>

 <div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="localidad_nombre">Localidad<strong style="color: red;">*</strong></label>
            <div class="input-group">
                <input type="text" class="form-control" id="localidad_nombre" name="localidad_nombre" placeholder="Seleccione localidad" readonly required>
                <button type="button" class="btn btn-outline-primary" id="btnBuscarLocalidad"><i class="fas fa-search"></i></button>
            </div>
            <input type="hidden" id="localidad_id" name="localidad_id" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="provincia_nombre">Provincia</label>
            <input type="text" class="form-control" id="provincia_nombre" name="provincia_nombre" readonly>
            <input type="hidden" id="provincia_id" name="provincia_id" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="pais_nombre">País</label>
            <input type="text" class="form-control" id="pais_nombre" name="pais_nombre" readonly>
            <input type="hidden" id="pais_id" name="pais_id" required>
        </div>
    </div>
</div>


<!--

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="provincia_id">Provincia<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="provincia_id" name="provincia_id" required>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" {{ $provincia->id == 1 ? 'selected' : '' }}>
                                        {{ $provincia->provincia }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="pais_id">País<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="pais_id" name="pais_id">
                                    @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}" {{ $pais->id == 1 ? 'selected' : '' }}>
                                        {{ $pais->pais }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

-->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3>
                            <label for=" forma_pago_id">Forma de Pago<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="forma_pago_id" name="forma_pago_id" required>
                                    <option value="">Seleccione forma de pago</option>
                                    @foreach ($formasPago as $formaPago)
                                    <option value="{{ $formaPago->id }}">{{ $formaPago->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="moneda_id" class="form-label">Moneda del Pedido</label>
                                <select name="moneda_id" id="moneda_id" class="form-select" required>
                                    <option value="">Seleccione una moneda</option>
                                    @foreach ($monedas as $moneda)
                                    <option value="{{ $moneda->id }}"
                                        {{ old('moneda_id', 1) == $moneda->id ? 'selected' : '' }}>
                                        {{ $moneda->moneda }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="cotizacion">Cotización</label>
                                <input type="number" step="0.01" min="1" name="cotizacion" id="cotizacion"
                                    class="form-control"
                                    value="{{ old('cotizacion', $monedas->find(old('moneda_id', 1))->tipo_cambio ?? 0) }}"
                                    required>
                                <small class="text-muted">Según tipo de cambio de la moneda.</small>
                            </div>
                        </div>

                    </div>




                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="forma_entrega">Forma de Entrega<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="forma_entrega" name="forma_entrega"
                                    value="Ex-works (EXW) - Retiro desde planta" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="flete_id">Flete</label>
                                <select class="form-control" id="flete_id" name="flete_id">
                                    <option value="">Seleccione flete</option>
                                    @foreach ($fletes as $flete)
                                    <option value="{{ $flete->id }}" {{ $flete->id == 1 ? 'selected' : '' }}>
                                        {{ $flete->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 d-none">
                            <div class="form-group mb-3">
                                <label for="fecha_necesidad">Fecha necesidad a partir de la <strong style="color: red;">orden de compra *</strong></label>
                                <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                                    value="{{ \Carbon\Carbon::now()->addWeeks(3)->format('Y-m-d') }}" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label for="observacion">Observaciones</label>
                        <textarea class="form-control" id="observacion" name="observacion" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="imagen">Imagen Principal</label>
                                <input type="file" class="form-control" id="imagen" name="imagen"
                                    accept="image/*">
                                <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo:
                                    2MB</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="imagen_2">Imagen Secundaria</label>
                                <input type="file" class="form-control" id="imagen_2" name="imagen_2"
                                    accept="image/*">
                                <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo:
                                    2MB</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <h2><strong>Implemento</strong></h2>
            <!-- Sección de Productos Implementos -->
            <div class="card mb-4">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <div class="row mb-4 familias-container" data-seccion="implementos">
                        @foreach ($familias->whereBetween('id', [1, 6]) as $familia)
                        @if ($familia->imagen_principal)
                        <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}"
                            style="cursor: pointer;">
                            <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                                alt="{{ $familia->nombre }}" class="img-fluid img-thumbnail">
                            <p class="text-center mt-2">{{ $familia->nombre }}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <div id="productos-implementos-container" class="productos-container" style="display: none;">
                        <div class="productos-familia-container"></div>
                        <button type="button" class="btn btn-secondary mt-3 agregar-producto"
                            data-seccion="implementos">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </button>
                    </div>
                </div>
            </div>

            <!-- Fin Sección de Productos Implementos -->
            <h2><strong>Opcionales</strong></h2>
            <!-- Sección de Neumáticos y Ruedas -->
            <div class="card mb-4">
                <div class="card-header">Camisas, Diferencias de ruedas, extenciones, etc...</div>
                <div class="card-body">
                    <div class="row mb-4 familias-container" data-seccion="neumaticos">
                        @foreach ($familias->whereBetween('id', [7]) as $familia)
                        @if ($familia->imagen_principal)
                        <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}"
                            style="cursor: pointer;">
                            <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                                alt="{{ $familia->nombre }}" class="img-fluid img-thumbnail">
                            <p class="text-center mt-2">{{ $familia->nombre }}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <div id="productos-neumaticos-container" class="productos-container" style="display: none;">
                        <div class="productos-familia-container"></div>
                        <button type="button" class="btn btn-secondary mt-3 agregar-producto" data-seccion="neumaticos">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </button>
                    </div>
                </div>
            </div>
            <!--Fin Sección de Neumáticos Ruedas -->


            <!-- Sección de Balanza, cámaras y otros -->
            <div class="card mb-4">
                <h2><strong>Accesorios</strong></h2>
                <div class="card-header">Neumaticos, Ruedas y Accesorios</div>
                <div class="card-body">
                    <div class="row mb-4 familias-container" data-seccion="balanza">
                        @foreach ($familias->whereBetween('id', [8]) as $familia)
                        @if ($familia->imagen_principal)
                        <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}"
                            style="cursor: pointer;">
                            <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                                alt="{{ $familia->nombre }}" class="img-fluid img-thumbnail">
                            <p class="text-center mt-2">{{ $familia->nombre }}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <div id="productos-balanza-container" class="productos-container" style="display: none;">
                        <div class="productos-familia-container"></div>
                        <button type="button" class="btn btn-secondary mt-3 agregar-producto" data-seccion="balanza">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </button>
                    </div>
                </div>
            </div>

            <div id="resumen-totales" class="mt-4 card p-3 border">
                <h5 class="mb-2">Totales Generales</h5>
                <p><strong>Cantidad total de productos:</strong> <span id="total-cantidad">0</span></p>
                <p><strong>Subtotal:</strong> USD <span id="total-subtotal">0.00</span></p>
                <p><strong>Importe IVA:</strong> USD <span id="total-iva">0.00</span></p>
                <p><strong>Total:</strong> USD <span id="total-general">0.00</span></p>
                <!-- Total en Pesos -->
                <p><strong>Total en Pesos:</strong> $ <span id="total-general-pesos">0.00</span></p>
            </div>


            <!-- Fin Sección de Balanza, cámaras y otros -->

            <!-- Botones de acción -->
            <div class="form-group mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cotización
                </button>



                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
    </form>

    <!-- Spinner grande centrado en toda la pantalla -->
    <div id="spinner"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
background-color: rgba(255, 255, 255, 0.8); z-index: 9999; flex-direction: column;
justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" role="status" style="width: 5rem; height: 5rem;">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mt-3 fs-4">Enviando Cotizacion o pedido, por favor espere...</p>
    </div>

</div>

<!-- Template único para productos (oculto) -->
<template id="producto-template">
    <div class="producto-item mb-3 p-3 border rounded position-relative">
        <button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto position-absolute top-0 end-0 m-2">
            <i class="fas fa-trash"></i>
        </button>

        <div class="row g-3">
            <div class="col-md-4">
                <label>Producto*</label>
                <select class="form-select producto-select" name="productos[TEMPLATE_INDEX][producto_id]" required>


                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}"
                        data-precio="{{ $producto->precio ?? 0 }}"
                        data-moneda="{{ $producto->moneda_id }}"
                        data-familia="{{ $producto->familia_id }}">
                        {{ $producto->nombre }} ({{ $producto->codigo }})
                    </option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-outline-secondary btn-sm mt-1 buscar-producto-btn" data-index="TEMPLATE_INDEX">
                    <i class="fas fa-search"></i> Buscar producto
                </button>
            </div>

            <div class="col-md-2">
                <label>Color</label>
                <select class="form-select color-select" name="productos[TEMPLATE_INDEX][color_id]">
                    <option value="">Seleccione</option>
                    @foreach ($colores as $color)
                    <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Moneda*</label>
                <select class="form-select moneda-select" name="productos[TEMPLATE_INDEX][moneda_id]" required>
                    <option value="">Seleccione</option>
                    @foreach ($monedas as $moneda)
                    <option value="{{ $moneda->id }}">{{ $moneda->moneda }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Cantidad*</label>
                <input type="number" min="1" class="form-control cantidad-input"
                    name="productos[TEMPLATE_INDEX][cantidad]" value="1" required>
            </div>

            <div class="col-md-2">
                <label>Precio*</label>
                <input type="number" step="0.01" min="0" class="form-control precio-input"
                    name="productos[TEMPLATE_INDEX][precio]" value="0.00" required>
            </div>

        </div>

        <div class="row g-3">

            <div class="col-md-4">
                <label>Diferencia (%)+/-</label>
                <input type="number" step="0.01" class="form-control diferencia-pago-input"
                    name="productos[TEMPLATE_INDEX][diferencia]" value="0.00">
            </div>

            <div class="col-md-2">
                <label>Desc. 1 (%)</label>
                <input type="number" step="0.01" class="form-control descuento-porcentaje"
                    name="productos[TEMPLATE_INDEX][descuento]" value="0.00">
            </div>

            <div class="col-md-2">
                <label>Desc. 2 (%)</label>
                <input type="number" step="0.01" class="form-control descuento-2-input"
                    name="productos[TEMPLATE_INDEX][descuento_2]" value="0.00">
            </div>

            <div class="col-md-2">
                <label>Desc. 3 (%)</label>
                <input type="number" step="0.01" class="form-control descuento-3-input"
                    name="productos[TEMPLATE_INDEX][descuento_3]" value="0.00">
            </div>

            <div class="col-md-2">
                <label>Desc. 4 (%)</label>
                <input type="number" step="0.01" class="form-control descuento-4-input"
                    name="productos[TEMPLATE_INDEX][descuento_4]" value="0.00">
            </div>

        </div>

        <div class="row g-3">

            <div class="col-md-3">
                <label>Subtotal</label>
                <input type="text" class="form-control subtotal-input" readonly>
            </div>


            <div class="col-md-3">
                <label>IVA (%) *</label>
                <input type="number" step="0.01" min="0" max="100" class="form-control iva-input"
                    name="productos[TEMPLATE_INDEX][iva]" value="10.50" required>
            </div>


            <div class="col-md-3">
                <label>Importe IVA</label>
                <input type="text" class="form-control iva-monto-input" readonly>
            </div>

            <div class="col-md-3">
                <label>Total</label>
                <input type="text" class="form-control total-input" readonly>
            </div>

        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <label>Forma de Pago</label>
                <select class="form-select" name="productos[TEMPLATE_INDEX][forma_pago_id]">
                    <option value="">Seleccione</option>
                    @foreach ($formasPago as $formaPago)
                    <option value="{{ $formaPago->id }}">{{ $formaPago->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label>Detalle</label>
                <input type="text" class="form-control" name="productos[TEMPLATE_INDEX][detalle]" maxlength="255">
            </div>



        </div>
    </div>
</template>




@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {

    // --- CÁLCULOS DE PRODUCTOS Y TOTALES ---

    calcularTotalesGenerales();

    let productoCounters = { implementos: 0, neumaticos: 0, balanza: 0 };
    const familiasSinColor = [7, 8];
    const familiasAccesorios = [8];

    const familiaPorProducto = @json($productos->pluck('familia_id', 'id'));

    let familiasSeleccionadas = { implementos: null, neumaticos: null, balanza: null };
    let productosPorFamilia = { implementos: [], neumaticos: [], balanza: [] };

    function calcularSubtotal(productoItem) {
        const selectProducto = $(productoItem).find('.producto-select');
        const productoId = parseInt(selectProducto.val());
        if (!productoId) return;

        const precio = parseFloat($(productoItem).find('.precio-input').val()) || 0;
        const cantidad = parseInt($(productoItem).find('.cantidad-input').val()) || 0;
        const iva = parseFloat($(productoItem).find('.iva-input').val()) || 0;

        const d1 = parseFloat($(productoItem).find('.descuento-porcentaje').val()) || 0;
        const d2 = parseFloat($(productoItem).find('.descuento-2-input').val()) || 0;
        const d3 = parseFloat($(productoItem).find('.descuento-3-input').val()) || 0;
        const d4 = parseFloat($(productoItem).find('.descuento-4-input').val()) || 0;
        const diferencia = parseFloat($(productoItem).find('.diferencia-pago-input').val()) || 0;

        let neto = precio * (1 + diferencia / 100);
        [d1, d2, d3, d4].forEach(desc => neto *= (1 - desc / 100));

        const subtotal = cantidad * neto;
        const ivaMonto = subtotal * (iva / 100);
        const total = subtotal + ivaMonto;

        $(productoItem).find('.subtotal-input').val(subtotal.toFixed(2));
        $(productoItem).find('.iva-monto-input').val(ivaMonto.toFixed(2));
        $(productoItem).find('.total-input').val(total.toFixed(2));

        calcularTotalesGenerales();
    }

    function agregarProducto(seccion) {
        const contenedor = $(`#productos-${seccion}-container .productos-familia-container`);
        const familiaId = familiasSeleccionadas[seccion];

        if (!familiaId) {
            alert('Primero seleccione una familia haciendo clic en una imagen de familia');
            return;
        }
        const productos = productosPorFamilia[seccion];
        if (!productos || productos.length === 0) {
            alert('No hay productos disponibles para esta familia');
            return;
        }

        const template = $('#producto-template').html();
        const html = template.replace(/TEMPLATE_INDEX/g, `${seccion}_${productoCounters[seccion]}`);
        const $newProduct = $(html);

        // Opcional: setear default de forma de pago
        // const formaPagoPedido = $('#forma_pago_id').val();
        // $newProduct.find('select[name*="[forma_pago_id]"]').val(formaPagoPedido);

        const $select = $newProduct.find('.producto-select');
        $select.empty().append('<option value="">Seleccione un producto</option>');
        productos.forEach(producto => {
            $select.append(`<option value="${producto.id}">${producto.nombre} (${producto.codigo})</option>`);
        });

        contenedor.append($newProduct);
        productoCounters[seccion]++;
        calcularSubtotal($newProduct);
    }

    $(document).on('click', '.familia-item', function() {
        const familiaId = $(this).data('familia-id');
        const seccion = $(this).closest('.familias-container').data('seccion');

        $(this).closest('.familias-container').find('.familia-item').removeClass('border-primary');
        $(this).addClass('border border-primary');

        if (familiasSeleccionadas[seccion] === familiaId) return;

        familiasSeleccionadas[seccion] = familiaId;
        $(`#productos-${seccion}-container`).show().find('.productos-familia-container').empty();
        productoCounters[seccion] = 0;

        $.get('/productos-por-familia/' + familiaId)
            .done(function(productos) {
                productosPorFamilia[seccion] = productos;
                agregarProducto(seccion);
            })
            .fail(function(error) {
                console.error('Error al cargar productos:', error);
                alert('Error al cargar productos. Por favor intente nuevamente.');
            });
    });

    $(document).on('click', '.agregar-producto', function() {
        const seccion = $(this).data('seccion');
        agregarProducto(seccion);
    });

    $(document).on('change', '.producto-select', function() {
        const productoId = $(this).val();
        const productoItem = $(this).closest('.producto-item');

        productoItem.find('.precio-input').val(0);
        productoItem.find('.moneda-select').val('');

        if (productoId) {
            $.get(`/pedidos/last-price/${productoId}`)
                .done(function(data) {
                    if (data.precio) productoItem.find('.precio-input').val(data.precio);
                    if (data.moneda_id) productoItem.find('.moneda-select').val(data.moneda_id);
                    calcularSubtotal(productoItem);
                })
                .fail(function() {
                    console.log('No se encontró precio histórico para este producto');
                    calcularSubtotal(productoItem);
                });
        } else {
            calcularSubtotal(productoItem);
        }
    });

    $(document).on('input change',
        '.producto-select, .precio-input, .cantidad-input, .iva-input, .moneda-select, ' +
        '.descuento-porcentaje, .descuento-2-input, .descuento-3-input, .descuento-4-input, .diferencia-pago-input',
        function() {
            calcularSubtotal($(this).closest('.producto-item'));
        }
    );

    function calcularTotalesGenerales() {
        let totalCantidad = 0;
        let totalSubtotal = 0;
        let totalIva = 0;
        let totalGeneral = 0;

        document.querySelectorAll('.producto-item').forEach(item => {
            const cantidad = parseFloat(item.querySelector('.cantidad-input')?.value || 0);
            const subtotal = parseFloat(item.querySelector('.subtotal-input')?.value || 0);
            const iva = parseFloat(item.querySelector('.iva-monto-input')?.value || 0);
            const total = parseFloat(item.querySelector('.total-input')?.value || 0);

            totalCantidad += cantidad;
            totalSubtotal += subtotal;
            totalIva += iva;
            totalGeneral += total;
        });

        document.getElementById('total-cantidad').textContent = totalCantidad;
        document.getElementById('total-subtotal').textContent = numberFormat(totalSubtotal);
        document.getElementById('total-iva').textContent = numberFormat(totalIva);
        document.getElementById('total-general').textContent = numberFormat(totalGeneral);

        const cotizacion = parseFloat(document.getElementById('cotizacion').value || 0);
        document.getElementById('total-general-pesos').textContent = numberFormat(totalGeneral * cotizacion);
    }

    $('#cotizacion').on('input', calcularTotalesGenerales);

    $('#pedido-form').on('submit', function() {
        $('#spinner').css('display', 'flex');
    });

    $(document).on('click', '.btn-eliminar-producto', function() {
        $(this).closest('.producto-item').remove();
        calcularTotalesGenerales();
    });

    // --- MODAL DE BÚSQUEDA DE PRODUCTO ---
    let currentSelectIndex = null;

    $(document).on('click', '.buscar-producto-btn', function() {
        currentSelectIndex = $(this).data('index');

        $('#inputBuscarProducto').val('');
        $('#modalBuscarProducto').modal('show');

        $('#tablaBusquedaProducto .seleccionar-producto-btn').each(function() {
            $(this).data('index', currentSelectIndex);
        });
    });

    function aplicarFiltroModal() {
        const texto = $('#inputBuscarProducto').val().toLowerCase();
        $('#tablaBusquedaProducto tbody tr').each(function() {
            const codigo = ($(this).data('codigo') || '').toString().toLowerCase();
            const nombre = ($(this).data('nombre') || '').toString().toLowerCase();
            const familiaNombre = ($(this).data('familia-nombre') || '').toString().toLowerCase();
            const coincide = codigo.includes(texto) || nombre.includes(texto) || familiaNombre.includes(texto);
            $(this).toggle(coincide);
        });
    }
    $('#inputBuscarProducto').on('keyup', aplicarFiltroModal);

    $(document).on('click', '.seleccionar-producto-btn', function() {
        const id = $(this).data('id');
        const precio = $(this).data('precio');
        const moneda = $(this).data('moneda');
        const index = $(this).data('index');
        const selectorBase = `productos[${index}]`;

        $(`select[name="${selectorBase}[producto_id]"]`).val(id).trigger('change');
        $(`input[name="${selectorBase}[precio]"]`).val(precio);
        $(`select[name="${selectorBase}[moneda_id]"]`).val(moneda);

        calcularSubtotal($(`select[name="${selectorBase}[producto_id]"]`).closest('.producto-item'));
        $('#modalBuscarProducto').modal('hide');
    });

    // --- CAMBIO AUTOMÁTICO DE COTIZACIÓN SEGÚN MONEDA ---
    const monedas = @json($monedas->keyBy('id'));
    document.getElementById('moneda_id').addEventListener('change', function() {
        const monedaId = this.value;
        const cotizacionInput = document.getElementById('cotizacion');
        if (monedas[monedaId]) {
            cotizacionInput.value = monedas[monedaId].tipo_cambio;
        }
    });

    function numberFormat(valor) {
        // Convierte 1234.56 a 1.234,56
        if (isNaN(valor)) return '';
        return valor
            .toFixed(2)
            .replace('.', ',')
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    // --- MODAL BUSCADOR Y CREAR LOCALIDAD (ÚNICO READY) ---

    // Abrir modal buscador de localidad
    $('#btnBuscarLocalidad').click(function () {
        $('#inputBuscarLocalidad').val('');
        $('#modalBuscarLocalidad').modal('show');
        aplicarFiltroModalLocalidad();
    });

    // Filtrar localidades en el modal
    $('#inputBuscarLocalidad').on('keyup', aplicarFiltroModalLocalidad);

    function aplicarFiltroModalLocalidad() {
        const texto = $('#inputBuscarLocalidad').val().toLowerCase();
        $('#tablaBusquedaLocalidad tbody tr').each(function () {
            const nombre = ($(this).data('nombre') || '').toLowerCase();
            const provincia = ($(this).data('provincia-nombre') || '').toLowerCase();
            const pais = ($(this).data('pais-nombre') || '').toLowerCase();
            $(this).toggle(
                nombre.includes(texto) ||
                provincia.includes(texto) ||
                pais.includes(texto)
            );
        });
    }

    // Seleccionar localidad de la tabla o tras crear
$(document).on('click', '.seleccionar-localidad-btn', function () {
    // Extraer y normalizar los valores (nunca string "undefined")
    const id = $(this).data('id');
    const nombre = $(this).data('nombre') ?? '';

    let provincia_id = $(this).data('provincia-id');
    provincia_id = (provincia_id === undefined || provincia_id === 'undefined') ? '' : provincia_id;

    let provincia_nombre = $(this).data('provincia-nombre') ?? '';

    let pais_id = $(this).data('pais-id');
    pais_id = (pais_id === undefined || pais_id === 'undefined') ? '' : pais_id;

    let pais_nombre = $(this).data('pais-nombre') ?? '';

    $('#localidad_id').val(id || '');
    $('#localidad_nombre').val(nombre);
    $('#provincia_id').val(provincia_id);
    $('#provincia_nombre').val(provincia_nombre);
    $('#pais_id').val(pais_id);
    $('#pais_nombre').val(pais_nombre);

    $('#modalBuscarLocalidad').modal('hide');
});




    // Mostrar/ocultar formulario de nueva localidad
    $('#btnMostrarFormularioLocalidad').on('click', function() {
        $('#formNuevaLocalidad').slideDown();
        $(this).hide();
        $('#msgNuevaLocalidad').html('');
    });
    $('#btnCancelarNuevaLocalidad').on('click', function() {
        $('#formNuevaLocalidad').slideUp();
        $('#btnMostrarFormularioLocalidad').show();
        $('#nuevaLocalidadAjaxForm')[0].reset();
        $('#msgNuevaLocalidad').html('');
    });

    // Alta rápida de localidad AJAX
    $('#nuevaLocalidadAjaxForm').on('submit', function(e) {
        e.preventDefault();

        let data = {
            nombre: $('#nueva_localidad_nombre').val(),
            cp: $('#nueva_localidad_cp').val(),
            provincia_id: $('#nueva_localidad_provincia').val(),
            pais_id: $('#nueva_localidad_pais').val(),
            _token: '{{ csrf_token() }}'
        };

        $('#msgNuevaLocalidad').html('<span class="text-info">Guardando...</span>');

        $.post('{{ route("localidad.store") }}', data)
            .done(function(response) {
                if(response && response.id){
                    // Agregar la nueva localidad a la tabla del modal
                    let row = `<tr data-id="${response.id}"
                                   data-nombre="${response.nombre}"
                                   data-provincia-id="${response.provincia_id}"
                                   data-provincia-nombre="${response.provincia_nombre || ''}"
                                   data-pais-id="${response.pais_id}"
                                   data-pais-nombre="${response.pais_nombre || ''}"
                                   data-cp="${response.cp}">
                        <td>${response.nombre}</td>
                        <td>${response.cp}</td>
                        <td>${response.provincia_nombre || ''}</td>
                        <td>${response.pais_nombre || ''}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm seleccionar-localidad-btn"
                                    data-id="${response.id}"
                                    data-nombre="${response.nombre}"
                                    data-provincia-id="${response.provincia_id}"
                                    data-provincia-nombre="${response.provincia_nombre || ''}"
                                    data-pais-id="${response.pais_id}"
                                    data-pais-nombre="${response.pais_nombre || ''}"
                                    data-cp="${response.cp}">
                                Seleccionar
                            </button>
                        </td>
                    </tr>`;
                    $('#tablaBusquedaLocalidad tbody').prepend(row);

                    setTimeout(function() {
                        $('#tablaBusquedaLocalidad tbody tr').first().find('.seleccionar-localidad-btn').trigger('click');
                    }, 200);

                    $('#msgNuevaLocalidad').html('<span class="text-success">¡Localidad creada y seleccionada!</span>');
                    $('#formNuevaLocalidad').slideUp();
                    $('#btnMostrarFormularioLocalidad').show();
                    $('#nuevaLocalidadAjaxForm')[0].reset();
                } else if(response && response.error) {
                    $('#msgNuevaLocalidad').html('<span class="text-danger">'+response.error+'</span>');
                } else {
                    $('#msgNuevaLocalidad').html('<span class="text-danger">Ocurrió un error inesperado.</span>');
                }
            })
            .fail(function(xhr) {
                let errores = xhr.responseJSON.errors || {};
                let msg = 'Error: ';
                if(errores.nombre) msg += '<br>'+errores.nombre[0];
                if(errores.cp) msg += '<br>'+errores.cp[0];
                if(errores.provincia_id) msg += '<br>'+errores.provincia_id[0];
                if(errores.pais_id) msg += '<br>'+errores.pais_id[0];
                $('#msgNuevaLocalidad').html('<span class="text-danger">'+msg+'</span>');
            });
    });

});
</script>


<!-- Modal de Búsqueda de Producto -->
<div class="modal fade" id="modalBuscarProducto" tabindex="-1" aria-labelledby="modalBuscarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarProductoLabel">Buscar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="inputBuscarProducto" class="form-control mb-3" placeholder="Escriba nombre o código...">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-hover" id="tablaBusquedaProducto">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Familia</th>
                                <th></th>
                            </tr>
                        </thead>


                        @foreach ($productos as $producto)
                        <tr class="producto-row"
                            data-id="{{ $producto->id }}"
                            data-nombre="{{ $producto->nombre }}"
                            data-codigo="{{ $producto->codigo }}"
                            data-familia-nombre="{{ $producto->familia->nombre }}">
                            <td>{{ $producto->codigo }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->familia->nombre }}</td>
                            <td>
                                <button class="btn btn-sm btn-success seleccionar-producto-btn"
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

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection