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

</style>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Crear Nuevo Pedido</h1>

    <form action="{{ route('pedidos.store') }}" method="POST" id="pedido-form" enctype="multipart/form-data">
        @csrf

        <!-- Formulario principal -->
        <div class="card mb-4">
            <div class="card-header">Datos del Pedido</div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="cliente">Nombre del Cliente<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="localidad_id">Localidad<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="localidad_id" name="localidad_id" required>
                                    @foreach($localidades as $localidad)
                                        <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="provincia_id">Provincia<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="provincia_id" name="provincia_id" required>
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="pais_id">País<strong style="color: red;">*</strong></label>
                                <select class="form-control" id="pais_id" name="pais_id">
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id }}" {{ $pais->id == 1 ? 'selected' : '' }}>
                                            {{ $pais->pais  }}
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
                                <label for="contacto">Contacto</label>
                                <input type="text" class="form-control" id="contacto" name="contacto">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tipo_pedido_id">Tipo de Pedido<strong style="color: red;">*</strong></label>
                            <select class="form-control" id="tipo_pedido_id" name="tipo_pedido_id" required>
                                <option value="">Seleccione un tipo</option>
                                @foreach($tipoPedidos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $tipo->id == 1 ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="fecha_necesidad">Fecha de Necesidad<strong style="color: red;">*</strong></label>
                            <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                                   value="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="forma_pago_id">Forma de Pago<strong style="color: red;">*</strong></label>
                            <select class="form-control" id="forma_pago_id" name="forma_pago_id" required>
                                <option value="">Seleccione forma de pago</option>
                                @foreach($formasPago as $formaPago)
                                    <option value="{{ $formaPago->id }}">{{ $formaPago->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="forma_entrega">Forma de Entrega<strong style="color: red;">*</strong></label>
                            <input type="text" class="form-control" id="forma_entrega" name="forma_entrega" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="plazo_entrega">Plazo de Entrega</label>
                            <input type="text" class="form-control" id="plazo_entrega" name="plazo_entrega" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="solicitante">Solicitante<strong style="color: red;">*</strong></label>
                            <input type="text" class="form-control" id="solicitante" name="solicitante" required>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="bonificacion">Bonificación (%)<strong style="color: red;">*</strong></label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                   id="bonificacion" name="bonificacion" value="0" required>
                        </div>
                    </div>


                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="flete_id">Flete</label>
                        <select class="form-control" id="flete_id" name="flete_id">
                            <option value="">Seleccione flete</option>
                            @foreach($fletes as $flete)
                                <option value="{{ $flete->id }}"{{ $flete->id == 1 ? 'selected' : '' }}>{{ $flete->nombre }}</option>
                            @endforeach
                        </select>
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
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="imagen_2">Imagen Secundaria</label>
                            <input type="file" class="form-control" id="imagen_2" name="imagen_2" accept="image/*">
                            <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
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
            @foreach($familias->whereBetween('id', [1, 6]) as $familia)
                @if($familia->imagen_principal)
                    <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}" style="cursor: pointer;">
                        <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                             alt="{{ $familia->nombre }}"
                             class="img-fluid img-thumbnail">
                        <p class="text-center mt-2">{{ $familia->nombre }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="productos-implementos-container" class="productos-container" style="display: none;">
            <div class="productos-familia-container"></div>
            <button type="button" class="btn btn-secondary mt-3 agregar-producto" data-seccion="implementos">
                <i class="fas fa-plus"></i> Agregar Producto
            </button>
        </div>
    </div>
</div>

<!-- Fin Sección de Productos Implementos -->
<h2><strong>Componentes</strong></h2>
<!-- Sección de Neumáticos y Ruedas -->
<div class="card mb-4">
    <div class="card-header">Componentes</div>
    <div class="card-body">
        <div class="row mb-4 familias-container" data-seccion="neumaticos">
            @foreach($familias->whereBetween('id', [7]) as $familia)
                @if($familia->imagen_principal)
                    <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}" style="cursor: pointer;">
                        <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                             alt="{{ $familia->nombre }}"
                             class="img-fluid img-thumbnail">
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
            @foreach($familias->whereBetween('id', [8]) as $familia)
                @if($familia->imagen_principal)
                    <div class="col-md-2 mb-3 familia-item" data-familia-id="{{ $familia->id }}" style="cursor: pointer;">
                        <img src="{{ asset('storage/' . $familia->imagen_principal) }}"
                             alt="{{ $familia->nombre }}"
                             class="img-fluid img-thumbnail">
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
</div>

<!-- Template único para productos (oculto) -->
<template id="producto-template">
<div class="producto-item mb-3 p-3 border rounded">
<button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto">
    <i class="fas fa-trash"></i> Eliminar
</button>
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>Producto*</label>
            <select class="form-control producto-select" name="productos[TEMPLATE_INDEX][producto_id]" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio ?? 0 }}">
                        {{ $producto->codigo }} - {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-3">
            <label>Color</label>
            <select class="form-control color-select" name="productos[TEMPLATE_INDEX][color_id]">
                <option value="">Seleccione un color</option>
                @foreach($colores as $color)
                    <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>Moneda*</label>
            <select class="form-control moneda-select" name="productos[TEMPLATE_INDEX][moneda_id]" required>
                <option value="">Seleccione moneda</option>
                @foreach($monedas as $moneda)
                    <option value="{{ $moneda->id }}">{{ $moneda->moneda }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Precio*</label>
            <input type="number" step="0.01" min="0" class="form-control precio-input"
                   name="productos[TEMPLATE_INDEX][precio]" value="0.00" required>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label>Cantidad*</label>
            <input type="number" min="1" class="form-control cantidad-input"
                   name="productos[TEMPLATE_INDEX][cantidad]" value="1" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>IVA (%)*</label>
            <input type="number" step="0.01" min="0" max="100" class="form-control iva-input"
                   name="productos[TEMPLATE_INDEX][iva]" value="10.50" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Subtotal</label>
            <input type="text" class="form-control subtotal-input" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Total</label>
            <input type="text" class="form-control total-input" readonly>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label>Detalle</label>
            <input type="text" class="form-control" name="productos[TEMPLATE_INDEX][detalle]" maxlength="255">
        </div>
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
    // Contador para índices de productos por sección
    let productoCounters = {
        implementos: 0,
        neumaticos: 0,
        balanza: 0
    };

    const familiasSinColor = [7,8]; // IDs de familias que no llevan color

    // Objeto para almacenar la familia seleccionada por sección
    let familiasSeleccionadas = {
        implementos: null,
        neumaticos: null,
        balanza: null
    };

    // Objeto para almacenar productos por familia
    let productosPorFamilia = {
        implementos: [],
        neumaticos: [],
        balanza: []
    };

    // Función para calcular subtotal y total
    function calcularSubtotal(productoItem) {
        const precio = parseFloat(productoItem.find('.precio-input').val()) || 0;
        const cantidad = parseInt(productoItem.find('.cantidad-input').val()) || 0;
        const bonificacion = parseFloat($('#bonificacion').val()) || 0;
        const iva = parseFloat(productoItem.find('.iva-input').val()) || 0;

        const subtotal = precio * cantidad * (1 - (bonificacion / 100));
        const total = subtotal * (1 + (iva / 100));

        productoItem.find('.subtotal-input').val(subtotal.toFixed(2));
        productoItem.find('.total-input').val(total.toFixed(2));
    }

    // Función para agregar un nuevo producto
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

        // Llenar el select con productos de la familia seleccionada
        const $select = $newProduct.find('.producto-select');
        $select.empty().append('<option value="">Seleccione un producto</option>');

        productos.forEach(producto => {
            $select.append(`<option value="${producto.id}">
                ${producto.codigo} - ${producto.nombre}
            </option>`);
        });

        contenedor.append($newProduct);
        productoCounters[seccion]++;
        calcularSubtotal($newProduct);
    }

    // Manejar clic en una familia
    $(document).on('click', '.familia-item', function() {
        const familiaId = $(this).data('familia-id');
        const seccion = $(this).closest('.familias-container').data('seccion');

        // Marcar visualmente la familia seleccionada
        $(this).closest('.familias-container').find('.familia-item').removeClass('border-primary');
        $(this).addClass('border border-primary');

        // Si ya está seleccionada esta familia, no hacer nada
        if (familiasSeleccionadas[seccion] === familiaId) {
            return;
        }

        familiasSeleccionadas[seccion] = familiaId;

        // Mostrar contenedor de productos de esta sección (si estaba oculto)
        $(`#productos-${seccion}-container`).show().find('.productos-familia-container').empty();
        productoCounters[seccion] = 0;

        // Obtener productos de esta familia via AJAX
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

    // Agregar producto adicional
    $(document).on('click', '.agregar-producto', function() {
        const seccion = $(this).data('seccion');
        agregarProducto(seccion);
    });

    // Cuando se selecciona un producto, cargar su precio histórico
    $(document).on('change', '.producto-select', function() {
        const productoId = $(this).val();
        const productoItem = $(this).closest('.producto-item');

        // Resetear valores
        productoItem.find('.precio-input').val(0);
        productoItem.find('.moneda-select').val('');

        if (productoId) {
            // Obtener último precio desde sub_pedidos
            $.get(`/pedidos/last-price/${productoId}`)
                .done(function(data) {
                    if(data.precio) {
                        productoItem.find('.precio-input').val(data.precio).trigger('change');
                    }
                    if(data.moneda_id) {
                        productoItem.find('.moneda-select').val(data.moneda_id).trigger('change');
                    }
                })
                .fail(function() {
                    console.log('No se encontró precio histórico para este producto');
                });
        }
    });

    // Eventos para cálculos
    $(document).on('change', '.producto-select, .precio-input, .cantidad-input, .iva-input, .moneda-select', function() {
        calcularSubtotal($(this).closest('.producto-item'));
    });

    $('#bonificacion').on('change', function() {
        $('.producto-item').each(function() {
            calcularSubtotal($(this));
        });
    });

    // Eliminar producto
    $(document).on('click', '.btn-eliminar-producto', function() {
        const productoItem = $(this).closest('.producto-item');
        const seccion = productoItem.closest('.productos-container').attr('id').replace('productos-', '').replace('-container', '');

        productoItem.remove();

        // Verificar si quedan productos en la sección
        if ($(`#productos-${seccion}-container .producto-item`).length === 0 && familiasSeleccionadas[seccion]) {
            agregarProducto(seccion);
        }
    });

    // Validación y envío del formulario
    $('#pedido-form').submit(function(e) {
    e.preventDefault();

    // Validar campos obligatorios del formulario principal
    const camposRequeridos = ['#cliente', '#direccion', '#localidad_id', '#telefono', '#email', '#tipo_pedido_id', '#fecha_necesidad', '#forma_pago_id', '#forma_entrega', '#solicitante'];
    let formularioValido = true;

    camposRequeridos.forEach(selector => {
        if (!$(selector).val()) {
            alert(`El campo ${$(selector).attr('id')} es obligatorio`);
            formularioValido = false;
            $(selector).focus();
            return false;
        }
    });

    if (!formularioValido) return false;

    // Validar que hay al menos un producto
    if ($('.producto-item').length === 0) {
        alert('Debe agregar al menos un producto. Seleccione una familia y agregue productos.');
        return false;
    }

    // Validar que todos los productos tengan los campos requeridos
    let productosValidos = true;
    $('.producto-item').each(function(index) {
        const productoSelect = $(this).find('.producto-select').val();
        const monedaSelect = $(this).find('.moneda-select').val();
        const precio = parseFloat($(this).find('.precio-input').val()) || 0;

        if (!productoSelect) {
            alert(`El producto en la posición ${index + 1} no tiene producto seleccionado`);
            productosValidos = false;
            return false;
        }

        if (!monedaSelect) {
            alert(`El producto en la posición ${index + 1} no tiene moneda seleccionada`);
            productosValidos = false;
            return false;
        }

        if (precio <= 0) {
            alert(`El producto en la posición ${index + 1} debe tener un precio válido`);
            productosValidos = false;
            return false;
        }
    });

    if (!productosValidos) {
        return false;
    }

    // Recolectar datos del formulario principal
    const formData = {
        cliente: $('#cliente').val(),
        direccion: $('#direccion').val(),
        localidad_id: $('#localidad_id').val(),
        provincia_id: $('#provincia_id').val(),
        pais_id: $('#pais_id').val(),
        telefono: $('#telefono').val(),
        email: $('#email').val(),
        contacto: $('#contacto').val(),
        tipo_pedido_id: $('#tipo_pedido_id').val(),
        fecha_necesidad: $('#fecha_necesidad').val(),
        forma_pago_id: $('#forma_pago_id').val(),
        forma_entrega: $('#forma_entrega').val(),
        plazo_entrega: $('#plazo_entrega').val(),
        solicitante: $('#solicitante').val(),
        bonificacion: $('#bonificacion').val(),
        flete_id: $('#flete_id').val(),
        observacion: $('#observacion').val()
    };

    // Recolectar datos de productos
    let productosData = [];
$('.producto-item').each(function(index) {
    let producto = {
        producto_id: $(this).find('.producto-select').val(),
        precio: parseFloat($(this).find('.precio-input').val()) || 0,
        cantidad: parseInt($(this).find('.cantidad-input').val()) || 1,
        moneda_id: $(this).find('.moneda-select').val(),
        iva: parseFloat($(this).find('.iva-input').val()) || 10.5,
        detalle: $(this).find('input[name*="detalle"]').val() || null,
        color_id: $(this).find('.color-select').val() || null // Asegurar que el color se envía con cada producto
    };
    productosData.push(producto);
});

    // Mostrar datos en el modal
// Mostrar datos en el modal
$('#debugFormData').text(JSON.stringify(formData, null, 2));

// Formatea los productos como tabla
let productsHtml = '';
productosData.forEach(producto => {
    const productoObj = $('.producto-select option[value="' + producto.producto_id + '"]').text();
    const total = producto.precio * producto.cantidad * (1 - (formData.bonificacion / 100)) * (1 + (producto.iva / 100));

    productsHtml += `
        <tr>
            <td>${productoObj}</td>
            <td>${producto.cantidad}</td>
            <td>$${producto.precio.toFixed(2)}</td>
            <td>$${total.toFixed(2)}</td>
        </tr>`;
});

$('#debugProductsTable tbody').html(productsHtml);

// Formatea los datos principales como tabla
let formDataHtml = '';
for (const key in formData) {
    if (formData[key]) {
        formDataHtml += `
            <tr>
                <td>${key.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
                <td>${formData[key]}</td>
            </tr>`;
    }
}
$('#debugFormTable').html(formDataHtml);

// Mostrar el modal
const debugModal = new bootstrap.Modal(document.getElementById('debugModal'));
debugModal.show();

// Configurar el botón de confirmación
$('#confirmSubmit').off('click').on('click', function () {
    debugModal.hide();
    $('#pedido-form').unbind('submit').submit();
});

});
});
    </script>

<!-- Modal para ver datos del formulario -->
<div class="modal fade" id="debugModal" tabindex="-1" aria-labelledby="debugModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Cambiado de modal-xl a modal-lg para que no sea tan ancho -->
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="debugModalLabel">
            <i class="fas fa-check-circle me-2"></i>Confirmación de Pedido
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- UNA SOLA COLUMNA -->
          <div class="card mb-4">
            <div class="card-header bg-light">
              <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Datos Principales</h6>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-sm table-striped mb-0" id="debugFormTable">
                  <!-- Los datos se insertarán aquí via JS -->
                </table>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header bg-light">
              <h6 class="mb-0"><i class="fas fa-boxes me-2"></i>Productos Seleccionados</h6>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-sm mb-0" id="debugProductsTable">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Los datos se insertarán aquí via JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i>Cancelar
          </button>
          <button type="button" class="btn btn-primary" id="confirmSubmit">
            <i class="fas fa-check me-2"></i>Confirmar Pedido
          </button>
        </div>
      </div>
    </div>
  </div>


@endsection
