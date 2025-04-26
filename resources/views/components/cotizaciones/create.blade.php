@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Crear Nueva Cotización</h1>

    <!-- Debug messages (cambiamos a alert-warning para que sea más visible) -->
    <div id="debug-messages" class="alert alert-warning mb-4">
                <div id="debug-content"></div>
    </div>

    <form action="{{ route('cotizaciones.store') }}" method="POST" id="cotizacion-form">
        @csrf

        <!-- Formulario principal -->
        <div class="card mb-4">
            <div class="card-header">Datos de la Cotización</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cotizacion">Código de Cotización*</label>
                            <input type="text" class="form-control" id="cotizacion" name="cotizacion" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción*</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vencimiento">Fecha de Vencimiento*</label>
                            <input type="date" class="form-control" id="vencimiento" name="vencimiento" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="observacion">Observaciones</label>
                    <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
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
                <i class="fas fa-save"></i> Guardar Cotización
            </button>
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">
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
                    <select class="form-control" name="productos[TEMPLATE_INDEX][producto_id]" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
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
                    <input type="number" step="0.01" min="0" class="form-control"
                           name="productos[TEMPLATE_INDEX][precio]" value="0.00" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Precio Bonif.*</label>
                    <input type="number" step="0.01" min="0" class="form-control"
                           name="productos[TEMPLATE_INDEX][precio_bonificado]" value="0.00" required>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>Desc.%*</label>
                    <input type="number" step="0.01" min="0" max="100" class="form-control"
                           name="productos[TEMPLATE_INDEX][descuento]" value="0.00" required>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Detalle</label>
                    <input type="text" class="form-control" name="productos[TEMPLATE_INDEX][detalle]" maxlength="100">
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
    // Función para mostrar mensajes de debug
    function showDebugMessage(message) {
        $('#debug-content').append('<div>' + message + '</div>');
        console.log(message);
    }

    //showDebugMessage('JavaScript cargado correctamente');

    //Verificar elementos importantes
    //showDebugMessage('Formulario principal ' + ($('#cotizacion-form').length ? 'encontrado' : 'NO encontrado'));
    //showDebugMessage('Botón agregar ' + ($('#agregar-producto').length ? 'encontrado' : 'NO encontrado'));
    //showDebugMessage('Template ' + ($('#producto-template').length ? 'encontrado' : 'NO encontrado'));

    // Configurar fecha de vencimiento (solo si existe el campo)
    if ($('#vencimiento').length) {
        const vencimiento = new Date();
        vencimiento.setMonth(vencimiento.getMonth() + 1);
        const fechaFormateada = vencimiento.toISOString().split('T')[0];
        $('#vencimiento').val(fechaFormateada);
       // showDebugMessage('Fecha de vencimiento configurada: ' + fechaFormateada);
    } else {
        showDebugMessage('Error: No se encontró el campo de vencimiento');
    }

    // Contador para índices de productos
    let productoCounter = 0;
    //showDebugMessage('Contador de productos inicializado en: ' + productoCounter);

    // Agregar producto usando el template
    $('#agregar-producto').click(function() {
        const template = $('#producto-template').html();
        if (!template) {
          // showDebugMessage('Error: No se encontró el template');
            return;
        }

        const html = template.replace(/TEMPLATE_INDEX/g, productoCounter);
        $('#productos-container').append(html);
       // showDebugMessage('Producto agregado con índice: ' + productoCounter);
        productoCounter++;
    });

    // Eliminar producto (delegación de eventos)
    $('#productos-container').on('click', '.btn-eliminar-producto', function() {
        $(this).closest('.producto-item').remove();
        showDebugMessage('Producto eliminado');
    });

    // Validación del formulario
    $('#cotizacion-form').submit(function(e) {
        if ($('.producto-item').length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto');
            return false;
        }
    });

    // Agregar un producto automáticamente al cargar la página
   // showDebugMessage('Agregando primer producto automáticamente...');
    $('#agregar-producto').trigger('click');
});
</script>
@endsection
