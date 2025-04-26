@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Editar Pedido #{{ $pedido->id }}</h1>

    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" id="pedido-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

 <!-- Formulario principal -->
 <div class="card mb-4">
    <div class="card-header">Datos del Pedido/ Cotizacion</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="cliente_id">Cliente*</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
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
                            <option value="{{ $tipo->id }}" {{ $pedido->tipo_pedido_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="fecha_necesidad">Fecha de Necesidad*</label>
                    <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                           value="{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="forma_pago_id">Forma de Pago*</label>
                    <select class="form-control" id="forma_pago_id" name="forma_pago_id" required>
                        <option value="">Seleccione forma de pago</option>
                        @foreach($formasPago as $formaPago)
                            <option value="{{ $formaPago->id }}" {{ $pedido->forma_pago_id == $formaPago->id ? 'selected' : '' }}>
                                {{ $formaPago->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="forma_entrega">Forma de Entrega*</label>
                    <input type="text" class="form-control" id="forma_entrega" name="forma_entrega"
                           value="{{ $pedido->forma_entrega }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="plazo_entrega">Plazo de Entrega</label>
                    <input type="text" class="form-control" id="plazo_entrega" name="plazo_entrega"
                           value="{{ $pedido->plazo_entrega }}" maxlength="100">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="solicitante">Solicitante*</label>
                    <input type="text" class="form-control" id="solicitante" name="solicitante"
                           value="{{ $pedido->solicitante }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="bonificacion">Bonificación (%)*</label>
                    <input type="number" step="0.01" min="0" max="100" class="form-control"
                           id="bonificacion" name="bonificacion" value="{{ $pedido->bonificacion }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="flete_id">Flete</label>
                    <select class="form-control" id="flete_id" name="flete_id">
                        <option value="">Seleccione flete</option>
                        @foreach($fletes as $flete)
                            <option value="{{ $flete->id }}" {{ $pedido->flete_id == $flete->id ? 'selected' : '' }}>
                                {{ $flete->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="observacion">Observaciones</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="2">{{ $pedido->observacion }}</textarea>
        </div>

<!-- Sección de imágenes - Organizada en filas -->
<div class="row">
<div class="col-md-6">
<div class="form-group mb-3">
    <label for="imagen">Imagen Principal</label>
    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
    @if($pedido->imagen)
    <div class="mt-2">
        <img src="{{ asset(str_replace('/storage/', 'storage/', $pedido->imagen)) }}" class="img-thumbnail" style="max-height: 100px;">
        <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="eliminar_imagen" name="eliminar_imagen">
            <label class="form-check-label" for="eliminar_imagen">Eliminar imagen actual</label>
        </div>
    </div>
    @endif
    <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
</div>
</div>
<div class="col-md-6">
<div class="form-group mb-3">
    <label for="imagen_2">Imagen Secundaria</label>
    <input type="file" class="form-control" id="imagen_2" name="imagen_2" accept="image/*">
    @if($pedido->imagen_2)
    <div class="mt-2">
        <img src="{{ asset('storage/' . str_replace('public/', '', $pedido->imagen_2)) }}" class="img-thumbnail" style="max-height: 100px;">
        <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="eliminar_imagen_2" name="eliminar_imagen_2">
            <label class="form-check-label" for="eliminar_imagen_2">Eliminar imagen actual</label>
        </div>
    </div>
    @endif
    <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
</div>
</div>
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
                    @foreach($pedido->subPedidos as $index => $subPedido)
                        <div class="producto-item mb-3 p-3 border rounded">
                            <button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                            @include('components.pedidos._productos_form', [
                                'index' => $index,
                                'subPedido' => $subPedido
                            ])
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-secondary mt-3" id="agregar-producto">
                    <i class="fas fa-plus"></i> Agregar Producto
                </button>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Pedido
            </button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<!-- @include('components.pedidos._productos_form', ['index' => 'new_']) -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', function() {
    // Inicializa el contador con la cantidad de productos existentes
    let productoIndex = {{ $pedido->subPedidos->count() }};
    const productosContainer = document.getElementById('productos-container');
    const agregarProductoBtn = document.getElementById('agregar-producto');

    // Función para agregar nuevo producto
    function agregarProducto() {
        const newIndex = productoIndex++;
        const template = document.createElement('div');
        template.innerHTML = `
            <div class="producto-item mb-3 p-3 border rounded">
                <button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto">
                    <i class="fas fa-trash"></i> Eliminar
                </button>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Producto*</label>
                            <select name="productos[${newIndex}][producto_id]" class="form-control select-producto" required>
                                <option value="">Seleccione producto</option>
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
                            <select name="productos[${newIndex}][moneda_id]" class="form-control" required>
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
                                   name="productos[${newIndex}][precio]" value="0" required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Cantidad*</label>
                            <input type="number" min="1" class="form-control cantidad-input"
                                   name="productos[${newIndex}][cantidad]" value="1" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>IVA (%)*</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control iva-input"
                                   name="productos[${newIndex}][iva]" value="21" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Subtotal</label>
                            <input type="text" class="form-control subtotal-input" value="0.00" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" class="form-control total-input" value="0.00" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Detalle</label>
                            <input type="text" class="form-control"
                                   name="productos[${newIndex}][detalle]" maxlength="255">
                        </div>
                    </div>
                </div>
            </div>
        `.trim();

        const newProducto = template.firstChild;
        productosContainer.appendChild(newProducto);

        // Configurar eventos para el nuevo producto
        inicializarEventosProducto(newProducto);
    }

    // Función para inicializar eventos de un producto
    function inicializarEventosProducto(productoItem) {
        // Evento de eliminación
        const removeBtn = productoItem.querySelector('.btn-eliminar-producto');
        removeBtn.addEventListener('click', function() {
            productoItem.remove();
        });

        // Evento para cargar precio cuando se selecciona producto
        $(productoItem).find('.select-producto').change(function() {
            const productoId = $(this).val();
            if (productoId) {
                $.get(`/pedidos/last-price/${productoId}`, function(data) {
                    $(this).closest('.producto-item').find('.precio-input').val(data.precio_bonificado).trigger('change');
                }.bind(this));
            }
        });

        // Eventos para calcular totales
        $(productoItem).find('.precio-input, .cantidad-input, .iva-input').on('input change', function() {
            calcularTotales($(this).closest('.producto-item'));
        });
    }

    // Función para calcular totales
    function calcularTotales(productoItem) {
        const precio = parseFloat($(productoItem).find('.precio-input').val()) || 0;
        const cantidad = parseInt($(productoItem).find('.cantidad-input').val()) || 0;
        const bonificacion = parseFloat($('#bonificacion').val()) || 0;
        const iva = parseFloat($(productoItem).find('.iva-input').val()) || 0;

        const subtotal = precio * cantidad * (1 - (bonificacion / 100));
        const total = subtotal * (1 + (iva / 100));

        $(productoItem).find('.subtotal-input').val(subtotal.toFixed(2));
        $(productoItem).find('.total-input').val(total.toFixed(2));
    }

    // Configurar eventos para productos existentes
    $('#productos-container').on('change', '.select-producto', function() {
        const productoId = $(this).val();
        if (productoId) {
            $.get(`/pedidos/last-price/${productoId}`, function(data) {
                $(this).closest('.producto-item').find('.precio-input').val(data.precio_bonificado).trigger('change');
            }.bind(this));
        }
    });

    $('#productos-container').on('input change', '.precio-input, .cantidad-input, .iva-input', function() {
        calcularTotales($(this).closest('.producto-item'));
    });

    $('#bonificacion').on('input change', function() {
        $('.producto-item').each(function() {
            calcularTotales($(this));
        });
    });

    // Inicializar eventos para productos existentes al cargar
    document.querySelectorAll('.producto-item').forEach(item => {
        inicializarEventosProducto(item);
    });

    // Configurar evento para el botón de agregar producto
    agregarProductoBtn.addEventListener('click', agregarProducto);

    // Calcular valores iniciales para productos existentes
    $('.producto-item').each(function() {
        calcularTotales($(this));
    });
});
</script>
@endsection
