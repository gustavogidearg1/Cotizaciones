@extends('layouts.app')

@section('content')
@include('components.pedidos._modal_buscar_producto')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <div class="row">
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
                                    <label for="cuit">CUIT<strong style="color: red;">*</strong></label>
                                    <input type="text" class="form-control" id="cuit" name="cuit" maxlength="11"
                                        value="{{ $pedido->cuit }}" required>
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
                                    <div class="form-group mb-3">
                                        <label for="cotizacion">Cotización</label>
                                        <input type="number" step="0.01" min="0" name="cotizacion" id="cotizacion"
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
                                        <label for="forma_entrega">Forma de Entrega*</label>
                                        <input type="text" class="form-control" id="forma_entrega" name="forma_entrega"
                                            value="{{ $pedido->forma_entrega }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="flete_id">Flete</label>
                                        <select class="form-control" id="flete_id" name="flete_id">
                                            <option value="">Seleccione flete</option>
                                            @foreach ($fletes as $flete)
                                            <option value="{{ $flete->id }}"
                                                {{ $pedido->flete_id == $flete->id ? 'selected' : '' }}>
                                                {{ $flete->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
<div class="col-md-4">
    <div class="form-group mb-3">
        <label for="fecha">Fecha del Pedido</label>
<input type="datetime-local" class="form-control" id="fecha" name="fecha"
       value="{{ \Carbon\Carbon::parse($pedido->fecha)->format('Y-m-d\TH:i') }}"
    </div>
</div>


                                <div class="col d-none">
                                    <div class="form-group">
                                        <label for="fecha_necesidad">Fecha de Necesidad*</label>
                                        <input type="date" class="form-control" id="fecha_necesidad" name="fecha_necesidad"
                                            value="{{ \Carbon\Carbon::parse($pedido->fecha_necesidad)->format('Y-m-d') }}"
                                            required>
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


                    <!-- Productos (SubPedidos) -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Productos</span>
                            <button type="button" class="btn btn-sm btn-success" id="agregar-producto-edit">
                                <i class="fas fa-plus-circle"></i> Agregar Producto
                            </button>
                        </div>
                        <div class="card-body" id="productos-container">
                            @foreach ($pedido->subPedidos as $index => $subPedido)
                            @include('components.pedidos._productos_form', ['subPedido' => $subPedido, 'index' => $index])
                            @endforeach
                        </div>
                    </div>


{{-- Bloque de totales generales --}}
<div id="resumen-totales" class="mt-4 card p-3 border">
    <h5 class="mb-2">Totales Generales</h5>
    <p><strong>Cantidad total de productos:</strong> <span id="total-cantidad">0</span></p>
    <p><strong>Subtotal:</strong> USD <span id="total-subtotal">0,00</span></p>
    <p><strong>Importe IVA:</strong> USD <span id="total-iva">0,00</span></p>
    <p><strong>Total:</strong> USD <span id="total-general">0,00</span></p>
    <p><strong>Total en Pesos:</strong> $ <span id="total-general-pesos">0,00</span></p>
</div>

<button type="submit" class="btn btn-primary mt-3">Actualizar Pedido</button>

                </div>
    </form>
</div>

<template id="template-producto-edit">
    @php
    $fechaEntregaDefault = $pedido->fecha_necesidad instanceof \Carbon\Carbon
    ? $pedido->fecha_necesidad->format('Y-m-d')
    : date('Y-m-d', strtotime($pedido->fecha_necesidad));
    @endphp
    @include('components.pedidos._productos_form_template', [
    'index' => 'TEMPLATE_INDEX',
    'formaPagoDefault' => $pedido->forma_pago_id,
    'fechaEntregaDefault' => $fechaEntregaDefault
    ])
</template>

<script>
    const subCotizaciones = @json($subCotizaciones);
    //console.log('🧾 subCotizaciones cargadas:', subCotizaciones);

    document.addEventListener("DOMContentLoaded", function() {
        let index = document.querySelectorAll('.producto-item').length;

        document.getElementById('agregar-producto-edit').addEventListener('click', function() {
            const template = document.getElementById('template-producto-edit');
            let html = template.innerHTML.replace(/TEMPLATE_INDEX/g, index);

            const fechaNecesidad = document.getElementById('fecha_necesidad')?.value || '';
            html = html.replace(/__FECHA_ENTREGA__/g, fechaNecesidad);

            const div = document.createElement('div');
            div.classList.add('producto-item', 'position-relative');
            div.innerHTML = html;

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-close position-absolute top-0 end-0 m-2 eliminar-producto';
            btn.title = 'Eliminar producto';
            btn.addEventListener('click', () => div.remove());
            div.appendChild(btn);

            document.getElementById('productos-container').appendChild(div);

            const select = div.querySelector('.producto-select');
            if (select) {
                select.addEventListener('change', handleProductoChange);
                if (select.value && !isNaN(parseInt(select.value))) {
                    select.dispatchEvent(new Event('change'));
                }
            }

            index++;
        });

        document.getElementById('productos-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('eliminar-producto')) {
                e.target.closest('.producto-item').remove();
                calcularTotalesGenerales();
            }


        });

        function handleProductoChange(e) {
            const select = e.target;
            const container = select.closest('.producto-item');
            const productoId = parseInt(select.value);

            const sub = subCotizaciones[productoId] || subCotizaciones[select.value];

            if (sub) {
                container.querySelector('.precio-input').value = sub.precio;
                container.querySelector('.moneda-select').value = sub.moneda_id;
                //console.log(`✅ SubCotización aplicada para producto ID: ${productoId}`, sub);
            } else {
                console.warn(`❌ No se encontró subCotización para producto ID: ${productoId}`);
            }

            const familia = parseInt(select.selectedOptions[0].dataset.familia);
            if (familia === 8) {
                container.querySelector('.descuento-porcentaje').value = 0;
                container.querySelector('.diferencia-pago-input').value = 0;
            }

            calcularTotales.call(container);
        }


        function calcularTotales() {
            const container = this.closest('.producto-item') || this;

            const cantidad = parseFloat(container.querySelector('.cantidad-input')?.value || 0);
            const precio = parseFloat(container.querySelector('.precio-input')?.value || 0);

            const d1 = parseFloat(container.querySelector('.descuento-porcentaje')?.value || 0);
            const d2 = parseFloat(container.querySelector('.descuento-2-input')?.value || 0);
            const d3 = parseFloat(container.querySelector('.descuento-3-input')?.value || 0);
            const d4 = parseFloat(container.querySelector('.descuento-4-input')?.value || 0);

            const diferencia = parseFloat(container.querySelector('.diferencia-pago-input')?.value || 0);
            const iva = parseFloat(container.querySelector('.iva-input')?.value || 0);

            let neto = precio;
            [d1, d2, d3, d4].forEach(desc => neto -= neto * (desc / 100));
            neto += neto * (diferencia / 100);

            const subtotal = cantidad * neto;
            const ivaMonto = subtotal * (iva / 100);
            const total = subtotal + ivaMonto;

            container.querySelector('.subtotal-input').value = subtotal.toFixed(2);
            container.querySelector('.iva-monto-input').value = ivaMonto.toFixed(2);
            container.querySelector('.total-input').value = total.toFixed(2);
        }

        document.getElementById('productos-container').addEventListener('change', function(e) {
            if (e.target.matches('.producto-select')) handleProductoChange(e);
        });

  document.getElementById('productos-container').addEventListener('input', function(e) {
    if (e.target.matches('.cantidad-input, .precio-input, .descuento-porcentaje, .descuento-2-input, .descuento-3-input, .descuento-4-input, .diferencia-pago-input, .iva-input')) {
        calcularTotales.call(e.target.closest('.producto-item'));
        calcularTotalesGenerales();
    }
});

document.getElementById('cotizacion').addEventListener('input', calcularTotalesGenerales);

        document.querySelectorAll('.producto-select').forEach(select => {
            const event = new Event('change');
            select.dispatchEvent(event);
        });

        let currentSelectIndex = null;

        $(document).on('click', '.buscar-producto-btn', function() {
            currentSelectIndex = $(this).data('index');
            $('#inputBuscarProducto').val('');
            $('#modalBuscarProducto').modal('show');

            $('#tablaBusquedaProducto .seleccionar-producto-btn').each(function() {
                $(this).data('index', currentSelectIndex);
            });
        });

        $(document).on('click', '.seleccionar-producto-btn', function() {
            const id = $(this).data('id');
            const index = $(this).data('index');
            const selectorBase = `productos[${index}]`;

            // Setea el valor en el <select> y dispara el evento 'change'
            const select = document.querySelector(`select[name="${selectorBase}[producto_id]"]`);
            if (select) {
                select.value = id;
                select.dispatchEvent(new Event('change'));
            }

            $('#modalBuscarProducto').modal('hide');
        });

        function aplicarFiltroModal() {
            const texto = $('#inputBuscarProducto').val().toLowerCase();

            $('#tablaBusquedaProducto tbody tr').each(function() {
                const codigo = ($(this).data('codigo') || '').toString().toLowerCase();
                const nombre = ($(this).data('nombre') || '').toString().toLowerCase();
                const familia = ($(this).data('familia-nombre') || '').toString().toLowerCase();

                const coincide = codigo.includes(texto) || nombre.includes(texto) || familia.includes(texto);
                $(this).toggle(coincide);
            });
        }

        $('#inputBuscarProducto').on('keyup', aplicarFiltroModal);

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

        function numberFormat(valor) {
            // Convierte 1234.56 a 1.234,56 (estilo argentino)
            if (isNaN(valor)) return '0,00';
            return valor
                .toFixed(2) // dos decimales
                .replace('.', ',') // decimal a coma
                .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // miles a puntos
        }
 calcularTotalesGenerales();

    });
</script>
@endsection