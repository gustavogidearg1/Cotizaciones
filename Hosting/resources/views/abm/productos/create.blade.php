@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <h1>Crear Nuevo Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
<div class="row">
<div class="col-md-2">
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>
 </div>
 <div class="col-md-8">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255" required>
        </div>
 </div>

 <div class="col-md-2">
        <div class="form-group">
            <label for="um_id">Unidad de Medida</label>
            <select class="form-control" id="um_id" name="um_id" required>
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                @endforeach
            </select>
        </div>
 </div>
        </div>



        <div class="form-group">
            <label for="detalle">Detalle</label>
            <textarea class="form-control" id="detalle" name="detalle" rows="5"></textarea>
        </div>

        {{-- Este bloque va al inicio del formulario --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Se encontraron errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Luego los campos de imagen --}}

<div class="row">
<div class="col-md-6">
<div class="form-group">
    <label for="img">Imagen Principal</label>
    <input type="file" class="form-control" id="img" name="img" accept="image/*">
    <small class="form-text text-muted">Formatos aceptados: jpeg, png, jpg, gif. Tamaño máximo: 2MB</small>
    @error('img')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

</div>

<div class="col-md-6">
<div class="form-group">
    <label for="img_1">Imagen 2</label>
    <input type="file" class="form-control" id="img_1" name="img_1" accept="image/*">
    @error('img_1')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

</div>

</div>


<div class="row">
<div class="col-md-6">

<div class="form-group">
    <label for="img_2">Imagen 3</label>
    <input type="file" class="form-control" id="img_2" name="img_2" accept="image/*">
    @error('img_2')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
</div>

<div class="col-md-6">

    <div class="form-group">
    <label for="img_3">Imagen 4</label>
    <input type="file" class="form-control" id="img_3" name="img_3" accept="image/*">
    @error('img_3')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
</div>


</div>


<div class="row">
<div class="col-md-4">
        <div class="form-group">
            <label for="familia_id">Familia</label>
            <select class="form-control" id="familia_id" name="familia_id" required>
                @foreach($familias as $familia)
                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                @endforeach
            </select>
        </div>

</div>

<div class="col-md-4">

            <div class="form-group">
            <label for="activo">Activo</label>
            <select class="form-control" id="activo" name="activo" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

</div>

<div class="col-md-4">

        <div class="form-group">
            <label for="tipo_id">Tipo</label>
            <select class="form-control" id="tipo_id" name="tipo_id" required>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

</div>

</div>
            <div class="form-group">
    <label for="links">Links</label>
    <input type="text" class="form-control" id="links" name="links" value="{{ old('links', $producto->links ?? '') }}">
</div>



<div class="row">


<div class="col-md-4">

<div class="form-group">
    <label for="volumen_carga_m3">Volumen de Carga (m³)</label>
    <input type="number" class="form-control" step="0.01" name="volumen_carga_m3" value="{{ old('volumen_carga_m3', $producto->volumen_carga_m3 ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="potencia_requerida_hp">Potencia Requerida (HP)</label>
    <input type="text" class="form-control" name="potencia_requerida_hp" value="{{ old('potencia_requerida_hp', $producto->potencia_requerida_hp ?? '') }}">
</div>

</div>

<div class="col-md-4">

    <div class="form-group">
    <label for="toma_potencia_tom">TOMA DE POTENCIA (R.P.M)</label>
    <input type="text" class="form-control" name="toma_potencia_tom" value="{{ old('toma_potencia_tom', $producto->toma_potencia_tom ?? '') }}">
</div>

</div>

</div>


<div class="row">
<div class="col-md-4">

<div class="form-group">
    <label for="tiempo_descarga_aprx_min">TIEMPO DE DESCARGA APROXIMADO (MIN.)</label>
    <input type="text" class="form-control" name="tiempo_descarga_aprx_min" value="{{ old('tiempo_descarga_aprx_min', $producto->tiempo_descarga_aprx_min ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="balanza">Balanza</label>
    <input type="text" class="form-control" name="balanza" value="{{ old('balanza', $producto->balanza ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="camaras">Camaras</label>
    <input type="text" class="form-control" name="camaras" value="{{ old('camaras', $producto->camaras ?? '') }}">
</div>

</div>

</div>


<div class="row">
<div class="col-md-4">

<div class="form-group">
    <label for="altura_maxima_mm">ALTURA MAXIMA (MM)</label>
    <input type="text" class="form-control" name="altura_maxima_mm" value="{{ old('altura_maxima_mm', $producto->altura_maxima_mm ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="altura_carga_mm">ALTURA DE CARGA (MM)</label>
    <input type="text" class="form-control" name="altura_carga_mm" value="{{ old('altura_carga_mm', $producto->altura_carga_mm ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="longitud_total_mm">LONGITUD TOTAL (MM)</label>
    <input type="text" class="form-control" name="longitud_total_mm" value="{{ old('longitud_total_mm', $producto->longitud_total_mm ?? '') }}">
</div>

</div>

</div>


<div class="row">
<div class="col-md-4">

<div class="form-group">
    <label for="peso_vacio_kg">PESO EN VACIO (KG)</label>
    <input type="text" class="form-control" name="peso_vacio_kg" value="{{ old('peso_vacio_kg', $producto->peso_vacio_kg ?? '') }}">
</div>



</div>

<div class="col-md-4">

<div class="form-group">
    <label for="de_serie">DE SERIE</label>
    <input type="text" class="form-control" name="de_serie" value="{{ old('de_serie', $producto->de_serie ?? '') }}">
</div>

</div>

<div class="col-md-4">

<div class="form-group">
    <label for="colores">COLORES</label>
    <input type="text" class="form-control" name="colores" value="{{ old('colores', $producto->colores ?? '') }}">
</div>

</div>

</div>


<div class="form-group">
    <label for="opcional">OPCIONAL</label>
    <input type="text" class="form-control" name="opcional" value="{{ old('opcional', $producto->opcional ?? '') }}">
</div>



        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
