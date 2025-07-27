@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="container">

        <h1>Editar {{ $pedido->tipoPedido->nombre }} #{{ $pedido->id }}</h1>


        <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" id="pedido-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Formulario principal -->
            <div class="card mb-4">
                <div class="card-header">Datos del Pedido/ Cotizacion</div>
                <div class="card-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">


                                <div class="form-group mb-3">
                                    <label for="tipo_pedido_id">Tipo de Pedido*</label>
                                    <select class="form-control" id="tipo_pedido_id" name="tipo_pedido_id" required>
                                        <option value="">Seleccione un tipo</option>
                                        @foreach ($tipoPedidos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $pedido->tipo_pedido_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="cliente">Cliente*</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        value="{{ $pedido->cliente }}" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="direccion">Dirección*</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="{{ $pedido->direccion }}" required>
                                </div>
                            </div>




                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="localidad_id">Localidad*</label>
<select class="form-control" id="localidad_id" name="localidad_id" required>
    @foreach ($localidades as $localidad)
        <option value="{{ $localidad->id }}"
            {{ old('localidad_id', $pedido->localidad_id ?? 1) == $localidad->id ? 'selected' : '' }}>
            {{ $localidad->nombre }}
        </option>
    @endforeach
</select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="provincia_id">Provincia*</label>
<select class="form-control" id="provincia_id" name="provincia_id" required>
    @foreach ($provincias as $provincia)
        <option value="{{ $provincia->id }}"
            {{ old('provincia_id', $pedido->localidad->provincia_id ?? 1) == $provincia->id ? 'selected' : '' }}>
            {{ $provincia->provincia }}
        </option>
    @endforeach
</select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="pais_id">País*</label>
<select class="form-control" id="pais_id" name="pais_id" required>
    @foreach ($paises as $pais)
        <option value="{{ $pais->id }}"
            {{ old('pais_id', $pedido->localidad->pais_id ?? 1) == $pais->id ? 'selected' : '' }}>
            {{ $pais->pais }}
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
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        value="{{ $pedido->telefono }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $pedido->email }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="forma_entrega">Forma de Entrega*</label>
                                    <input type="text" class="form-control" id="forma_entrega" name="forma_entrega"
                                        value="{{ $pedido->forma_entrega }}" required>
                                </div>
                            </div>





                        </div>



                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="cuit">CUIT<strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control" id="cuit" name="cuit" maxlength="11"
                                    value="{{ $pedido->cuit }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="fecha_necesidad">Fecha de Necesidad*</label>
                                <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                                    value="{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('Y-m-d') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="forma_pago_id">Forma de Pago*</label>
                                <select class="form-control" id="forma_pago_id" name="forma_pago_id" required>
                                    <option value="">Seleccione forma de pago</option>
                                    @foreach ($formasPago as $formaPago)
                                        <option value="{{ $formaPago->id }}"
                                            {{ $pedido->forma_pago_id == $formaPago->id ? 'selected' : '' }}>
                                            {{ $formaPago->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="diferencia">Diferencia (%)</label>
                                <input type="number" step="0.01" class="form-control" id="diferencia"
                                    name="diferencia" value="{{ old('diferencia', $pedido->diferencia ?? 0) }}">
                                <small class="text-muted">Este campo solo se aplica a productos de tipo Implemento o
                                    Componente.</small>
                            </div>

                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="moneda_id" class="form-label">Moneda del Pedido</label>
                                <select name="moneda_id" id="moneda_id" class="form-select" required>
                                    <option value="">Seleccione una moneda</option>
                                    @foreach ($monedas as $moneda)
                                        <option value="{{ $moneda->id }}"
                                            {{ old('moneda_id', $pedido->moneda_id) == $moneda->id ? 'selected' : '' }}>
                                            {{ $moneda->moneda }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="for3m-group mb-3">
                                <label for="bonificacion">Bonificación (%)*</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control"
                                    id="bonificacion" name="bonificacion" value="{{ $pedido->bonificacion }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="for3m-group mb-3">
                                <label for="flete_id">Flete</label>
                                <select class="form-control" id="flete_id" name="flete_id">
                                    <option value="">Seleccione flete</option>
                                    @foreach ($fletes as $flete)
                                        <option value="{{ $flete->id }}"
                                            {{ $pedido->flete_id == $flete->id ? 'selected' : '' }}>
                                            {{ $flete->nombre }}
                                        </o3ption>
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
                                <input type="file" class="form-control" id="imagen" name="imagen"
                                    accept="image/*">
                                @if ($pedido->imagen)
                                    <div class="mt-2">
                                        <img src="{{ asset(str_replace('/storage/', 'storage/', $pedido->imagen)) }}"
                                            class="img-thumbnail" style="max-height: 100px;">
                                        <div class="form-check mt-2">
                                            <input type="checkbox" class="form-check-input" id="eliminar_imagen"
                                                name="eliminar_imagen">
                                            <label class="form-check-label" for="eliminar_imagen">Eliminar imagen
                                                actual</label>
                                        </div>
                                    </div>
                                @endif
                                <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo:
                                    2MB</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="imagen_2">Imagen Secundaria</label>
                                <input type="file" class="form-control" id="imagen_2" name="imagen_2"
                                    accept="image/*">
                                @if ($pedido->imagen_2)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $pedido->imagen_2)) }}"
                                            class="img-thumbnail" style="max-height: 100px;">
                                        <div class="form-check mt-2">
                                            <input type="checkbox" class="form-check-input" id="eliminar_imagen_2"
                                                name="eliminar_imagen_2">
                                            <label class="form-check-label" for="eliminar_imagen_2">Eliminar imagen
                                                actual</label>
                                        </div>
                                    </div>
                                @endif
                                <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo:
                                    2MB</small>
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
            @foreach ($pedido->subPedidos as $index => $subPedido)
                <div class="producto-item mb-3 p-3 border rounded">
                    <button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                    @include('components.pedidos._productos_form', [
                        'index' => $index,
                        'subPedido' => $subPedido,
                        'productos' => $productos,
                        'colores' => $colores,
                        'monedas' => $monedas,
                        'formasPago' => $formasPago
                    ])
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mt-3" id="agregar-producto">
            <i class="fas fa-plus"></i> Agregar Producto
        </button>

        <div class="mt-4">
            <div class="row">
                <div class="col-md-4">
                    <label><strong>Subtotal General</strong></label>
                    <input type="text" id="subtotal-general" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label><strong>Importe IVA Total</strong></label>
                    <input type="text" id="iva-general" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label><strong>Total General</strong></label>
                    <input type="text" id="total-general" class="form-control" readonly>
                </div>
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Pedido
            </button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </div>
</div>
</form>

    <!-- @include('components.pedidos._productos_form', ['index' => 'new_']) -->
@endsection

<script>
    const familiaPorProducto = {
        @foreach ($productos as $producto)
            {{ $producto->id }}: {{ $producto->familia_id }},
        @endforeach
    };
</script>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let productoIndex = {{ $pedido->subPedidos->count() }};
    const productosContainer = document.getElementById('productos-container');
    const agregarProductoBtn = document.getElementById('agregar-producto');

    function actualizarTotalesGenerales() {
        let subtotal = 0, iva = 0, total = 0;

        $('.producto-item').each(function () {
            subtotal += parseFloat($(this).find('.subtotal-input').val()) || 0;
            iva += parseFloat($(this).find('.iva-monto-input').val()) || 0;
            total += parseFloat($(this).find('.total-input').val()) || 0;
        });

        $('#subtotal-general').val(subtotal.toFixed(2));
        $('#iva-general').val(iva.toFixed(2));
        $('#total-general').val(total.toFixed(2));
    }

    function inicializarEventosProducto(producto) {
        const precioInput = producto.querySelector('.precio-input');
        const cantidadInput = producto.querySelector('.cantidad-input');
        const descuentoInputs = producto.querySelectorAll('.descuento-porcentaje, .descuento-2-input, .descuento-3-input, .descuento-4-input');
        const diferenciaInput = producto.querySelector('.diferencia-pago-input');
        const ivaInput = producto.querySelector('.iva-input');
        const subtotalInput = producto.querySelector('.subtotal-input');
        const ivaMontoInput = producto.querySelector('.iva-monto-input');
        const totalInput = producto.querySelector('.total-input');
        const productoSelect = producto.querySelector('.producto-select');

        function calcular() {
            let precio = parseFloat(precioInput.value) || 0;
            let cantidad = parseFloat(cantidadInput.value) || 0;
            let descuento1 = parseFloat(producto.querySelector('.descuento-porcentaje').value) || 0;
            let descuento2 = parseFloat(producto.querySelector('.descuento-2-input').value) || 0;
            let descuento3 = parseFloat(producto.querySelector('.descuento-3-input').value) || 0;
            let descuento4 = parseFloat(producto.querySelector('.descuento-4-input').value) || 0;
            let diferencia = parseFloat(diferenciaInput.value) || 0;
            const iva = parseFloat(ivaInput.value) || 0;

            const selectedOption = productoSelect?.options[productoSelect.selectedIndex];
            const familiaId = selectedOption?.getAttribute('data-familia');
            const esAccesorio = familiaId === '8';

            if (esAccesorio) {
                descuento1 = descuento2 = descuento3 = descuento4 = diferencia = 0;
                producto.querySelector('.descuento-porcentaje').value = 0;
                producto.querySelector('.descuento-2-input').value = 0;
                producto.querySelector('.descuento-3-input').value = 0;
                producto.querySelector('.descuento-4-input').value = 0;
                diferenciaInput.value = 0;
            }

            let precioFinal = precio;
            precioFinal *= (1 - descuento1 / 100);
            precioFinal *= (1 - descuento2 / 100);
            precioFinal *= (1 - descuento3 / 100);
            precioFinal *= (1 - descuento4 / 100);
            precioFinal *= (1 + diferencia / 100);

            const subtotal = precioFinal * cantidad;
            const importeIva = subtotal * (iva / 100);
            const total = subtotal + importeIva;

            subtotalInput.value = subtotal.toFixed(2);
            ivaMontoInput.value = importeIva.toFixed(2);
            totalInput.value = total.toFixed(2);

            actualizarTotalesGenerales();
        }

        [precioInput, cantidadInput, diferenciaInput, ivaInput].forEach(el => el.addEventListener('input', calcular));
        descuentoInputs.forEach(el => el.addEventListener('input', calcular));
        productoSelect?.addEventListener('change', calcular);

        producto.querySelector('.btn-eliminar-producto')?.addEventListener('click', () => {
            producto.remove();
            actualizarTotalesGenerales();
        });

        calcular();
    }

function agregarProducto() {
    const index = document.querySelectorAll('.producto-item').length;

    fetch(`/subpedido-template`)
        .then(response => response.text())
        .then(html => {
            const finalHtml = html.replace(/__INDEX__/g, index); // ✅ reemplazo
            const wrapper = document.createElement('div');
            wrapper.classList.add('producto-item', 'mb-3', 'p-3', 'border', 'rounded');
            wrapper.innerHTML = `
                <button type="button" class="btn btn-danger btn-sm mb-2 btn-eliminar-producto">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                ${finalHtml}
            `;
            productosContainer.appendChild(wrapper);
            inicializarEventosProducto(wrapper);
        });
}



    agregarProductoBtn.addEventListener('click', agregarProducto);

    document.querySelectorAll('.producto-item').forEach(producto => {
        inicializarEventosProducto(producto);
    });

    actualizarTotalesGenerales();
});

// Mostrar en consola los datos enviados
document.getElementById('pedido-form').addEventListener('submit', function (e) {
    const form = e.target;
    const formData = new FormData(form);

    console.log('🔍 Datos enviados al backend:');

    for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }
});


</script>
@endsection

