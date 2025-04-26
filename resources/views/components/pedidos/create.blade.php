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
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="cliente_id">Cliente*</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
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
                                <option value="{{ $flete->id }}">{{ $flete->nombre }}</option>
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
                <div id="productos-container">
                    <!-- Productos se agregarán aquí -->
                </div>

                <button type="button" class="btn btn-secondary mt-3" id="agregar-producto">
                    <i class="fas fa-plus"></i> Agregar Producto
                </button>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label>Producto*</label>
                    <select class="form-control select-producto" name="productos[TEMPLATE_INDEX][producto_id]" required>
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
                    <select class="form-control" name="productos[TEMPLATE_INDEX][moneda_id]" required>
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
                           name="productos[TEMPLATE_INDEX][iva]" value="21.00" required>
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

    // Agregar producto usando el template
    $('#agregar-producto').click(function() {
        const template = $('#producto-template').html();
        const html = template.replace(/TEMPLATE_INDEX/g, productoCounter);
        $('#productos-container').append(html);
        productoCounter++;
    });

    // Eliminar producto (delegación de eventos)
    $('#productos-container').on('click', '.btn-eliminar-producto', function() {
        $(this).closest('.producto-item').remove();
    });

    // Calcular subtotal cuando cambia precio, cantidad o bonificación
    $('#productos-container').on('change', '.select-producto, .precio-input, .cantidad-input, .iva-input', function() {
    const productoItem = $(this).closest('.producto-item');
    const precio = parseFloat(productoItem.find('.precio-input').val()) || 0;
    const cantidad = parseInt(productoItem.find('.cantidad-input').val()) || 0;
    const bonificacion = parseFloat($('#bonificacion').val()) || 0;
    const iva = parseFloat(productoItem.find('.iva-input').val()) || 0;

    const subtotal = precio * cantidad * (1 - (bonificacion / 100));
    const total = subtotal * (1 + (iva / 100));

    productoItem.find('.subtotal-input').val(subtotal.toFixed(2));
    productoItem.find('.total-input').val(total.toFixed(2)); // Asegúrate de agregar este campo
});

    // Cuando se selecciona un producto, cargar su precio
    $('#productos-container').on('change', '.select-producto', function() {
        const selectedOption = $(this).find('option:selected');
        const precio = selectedOption.data('precio') || 0;
        $(this).closest('.producto-item').find('.precio-input').val(precio).trigger('change');
    });

    // Calcular subtotales cuando cambia la bonificación general
    $('#bonificacion').on('change', function() {
        $('.producto-item').each(function() {
            const precio = parseFloat($(this).find('.precio-input').val()) || 0;
            const cantidad = parseInt($(this).find('.cantidad-input').val()) || 0;
            const bonificacion = parseFloat($('#bonificacion').val()) || 0;

            const subtotal = precio * cantidad * (1 - (bonificacion / 100));
            $(this).find('.subtotal-input').val(subtotal.toFixed(2));
        });
    });

    // Validación del formulario
    $('#pedido-form').submit(function(e) {
        if ($('.producto-item').length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto');
            return false;
        }
    });

    // Agregar un producto automáticamente al cargar la página
    $('#agregar-producto').trigger('click');
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


</script>
@endsection
