@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <h1>Editar Cotización</h1>

    <form action="{{ route('cotizaciones.update', $cotizacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('components.cotizaciones._form')

        <div id="productos-container">
            @foreach($cotizacion->subCotizaciones as $index => $subCotizacion)
                <div class="producto-item mb-3 p-3 border rounded">
                    <button type="button" class="btn btn-danger btn-sm mb-2" onclick="this.parentNode.remove()">Eliminar Producto</button>
                    @include('components.cotizaciones._productos_form', [
                        'index' => $index,
                        'subCotizacion' => $subCotizacion
                    ])
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="agregar-producto">Agregar Producto</button>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Actualizar Cotización</button>
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@include('components.cotizaciones._productos_form', ['index' => 'new_'])
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let productoIndex = {{ count($cotizacion->subCotizaciones) }};
        const productosContainer = document.getElementById('productos-container');
        const agregarProductoBtn = document.getElementById('agregar-producto');

        agregarProductoBtn.addEventListener('click', function() {
            const template = `@include('components.cotizaciones._productos_form', ['index' => 'new_${productoIndex}'])`;
            const div = document.createElement('div');
            div.className = 'producto-item mb-3 p-3 border rounded';
            div.innerHTML = template;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-danger btn-sm mb-2';
            removeBtn.textContent = 'Eliminar Producto';
            removeBtn.onclick = function() {
                div.remove();
            };

            div.prepend(removeBtn);
            productosContainer.appendChild(div);

            productoIndex++;
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
