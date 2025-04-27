@extends('layouts.app')


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
                                <label for="cliente">Nombre del Cliente*</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección*</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="localidad_id">Localidad*</label>
                                <select class="form-control" id="localidad_id" name="localidad_id" required>
                                    @foreach($localidades as $localidad)
                                        <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="provincia_id">Provincia*</label>
                                <select class="form-control" id="provincia_id" name="provincia_id" required>
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="pais_id">País*</label>
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
                                <label for="telefono">Teléfono*</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="email">Email*</label>
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
                            <label for="tipo_pedido_id">Tipo de Pedido*</label>
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
                            <label for="fecha_necesidad">Fecha de Necesidad*</label>
                            <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                                   value="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="forma_pago_id">Forma de Pago*</label>
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
                            <label for="forma_entrega">Forma de Entrega*</label>
                            <input type="text" class="form-control" id="forma_entrega" name="forma_entrega" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="plazo_entrega">Plazo de Entrega</label>
                        <input type="text" class="form-control" id="plazo_entrega" name="plazo_entrega" maxlength="100">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="solicitante">Solicitante*</label>
                            <input type="text" class="form-control" id="solicitante" name="solicitante" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="bonificacion">Bonificación (%)*</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                   id="bonificacion" name="bonificacion" value="0" required>
                        </div>
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

        <!-- Productos -->
        <div class="card mb-4">
            <div class="card-header">Productos</div>
            <div class="card-body">
                <!-- Mostrar familias primero -->
                <div class="row mb-4" id="familias-container">
                    @foreach($familias as $familia)
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

                <!-- Contenedor para productos (inicialmente oculto) -->
                <div id="productos-container" style="display: none;">
                    <div id="productos-familia-container">
                        <!-- Productos de la familia seleccionada aparecerán aquí automáticamente -->
                    </div>

                    <button type="button" class="btn btn-secondary mt-3" id="agregar-producto">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Pedido
            </button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<!-- Template para productos (oculto) -->
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
    // Contador para índices de productos
    let productoCounter = 0;
    let familiaSeleccionada = null;

    // Función para agregar un nuevo producto
    function agregarProducto() {
        const productos = $('#productos-familia-container').data('productos');
        if (!productos || productos.length === 0) return;

        const template = $('#producto-template').html();
        const html = template.replace(/TEMPLATE_INDEX/g, productoCounter);
        const $newProduct = $(html);

        // Llenar el select con productos de la familia seleccionada
        const $select = $newProduct.find('.producto-select');
        $select.empty().append('<option value="">Seleccione un producto</option>');

        productos.forEach(producto => {
            $select.append(`<option value="${producto.id}" data-precio="${producto.precio || 0}">
                ${producto.codigo} - ${producto.nombre}
            </option>`);
        });

        $('#productos-familia-container').append($newProduct);
        productoCounter++;

        // Calcular subtotal inicial
        calcularSubtotal($newProduct);
    }

    // Manejar clic en una familia
    $(document).on('click', '.familia-item', function() {
        const familiaId = $(this).data('familia-id');
        familiaSeleccionada = familiaId;

        // Limpiar contenedor de productos
        $('#productos-familia-container').empty();
        productoCounter = 0;

        // Obtener productos de esta familia via AJAX
        $.get('/productos-por-familia/' + familiaId, function(productos) {
            // Mostrar contenedor de productos
            $('#productos-container').show();

            // Guardar los productos para usarlos luego
            $('#productos-familia-container').data('productos', productos);

            // Agregar automáticamente el primer producto
            agregarProducto();
        }).fail(function() {
            alert('Error al cargar productos de la familia');
        });
    });

    // Agregar producto adicional
    $('#agregar-producto').click(function() {
        if (!familiaSeleccionada) {
            alert('Primero seleccione una familia');
            return;
        }
        agregarProducto();
    });

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

        // Cuando se selecciona un producto, cargar su precio
        $('#productos-container').on('change', '.select-producto', function() {
        const selectedOption = $(this).find('option:selected');
        const precio = selectedOption.data('precio') || 0;
        $(this).closest('.producto-item').find('.precio-input').val(precio).trigger('change');
    });

    // Eventos para cálculos
    $('#productos-container').on('change', '.producto-select, .precio-input, .cantidad-input, .iva-input', function() {
        calcularSubtotal($(this).closest('.producto-item'));
    });

    $('#bonificacion').on('change', function() {
        $('.producto-item').each(function() {
            calcularSubtotal($(this));
        });
    });

    // Cuando se selecciona un producto, cargar su precio
    $('#productos-container').on('change', '.producto-select', function() {
    const productoId = $(this).val();
    const productoItem = $(this).closest('.producto-item');

    if (productoId) {
        $.get(`/pedidos/last-price/${productoId}`, function(data) {
            // Establecer precio
            const precioInput = productoItem.find('.precio-input');
            precioInput.val(data.precio_bonificado || data.precio || 0);

            // Establecer moneda si existe
            if (data.moneda_id) {
                productoItem.find('.moneda-select').val(data.moneda_id);
            }

            // Disparar evento change para calcular subtotales
            precioInput.trigger('change');
        }).fail(function() {
            console.error('Error al cargar precio y moneda');
        });
    }
});

    // Eliminar producto
    $('#productos-container').on('click', '.btn-eliminar-producto', function() {
        $(this).closest('.producto-item').remove();
        // No permitir eliminar el último producto
        if ($('.producto-item').length === 0 && familiaSeleccionada) {
            agregarProducto();
        }
    });

    // Validación del formulario
    $('#pedido-form').submit(function(e) {
        if ($('.producto-item').length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto');
            return false;
        }
    });

    // En tu archivo JavaScript de create/edit
$('#productos-container').on('change', '.select-producto', function() {
    const productoId = $(this).val();
    const productoItem = $(this).closest('.producto-item');

    if (productoId) {
        $.get(`/pedidos/last-price/${productoId}`, function(data) {
            productoItem.find('.precio-input').val(data.precio_bonificado).trigger('change');
        });
    }
});

});




</script>
@endsection
