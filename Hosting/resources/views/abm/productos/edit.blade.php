@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="codigo">Código</label>
                    <input type="number" class="form-control" id="codigo" name="codigo" value="{{ $producto->codigo }}" required>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}" maxlength="255" required>
                </div>

            </div>
            <div class="col-md-4">

                <div class="form-group mb-4">
                    <label for="um_id">Unidad de Medida</label>
                    <select class="form-control" id="um_id" name="um_id" required>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ $producto->um_id == $unidad->id ? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                   <div class="form-group mb-3">
                    <label for="detalle">Detalle</label>
                    <textarea class="form-control" id="detalle" name="detalle" rows="3">{{ $producto->detalle }}</textarea>
                </div>

                    <div class="row">
            <div class="col-md-4">

                <div class="form-group mb-3">
                    <label for="familia_id">Familia</label>
                    <select class="form-control" id="familia_id" name="familia_id" required>
                        @foreach($familias as $familia)
                            <option value="{{ $familia->id }}" {{ $producto->familia_id == $familia->id ? 'selected' : '' }}>{{ $familia->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="col-md-4">

                <div class="form-group mb-3">
                    <label for="activo">Activo</label>
                    <select class="form-control" id="activo" name="activo" required>
                        <option value="1" {{ $producto->activo ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ !$producto->activo ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                   </div>

                <div class="col-md-4">

                <div class="form-group mb-3">
                    <label for="tipo_id">Tipo</label>
                    <select class="form-control" id="tipo_id" name="tipo_id" required>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ $producto->tipo_id == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                </div>


            </div>


            </div>
        </div>

        <!-- Sección de imágenes -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen Principal</h5>
                        @if($producto->img)
                            <img src="{{ $producto->img }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img" name="remove_img">
                                <label class="form-check-label" for="remove_img">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img" name="img" accept="image/*">
                        <small class="form-text text-muted">Formatos: jpeg, png, jpg, gif. Max: 2MB</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 2</h5>
                        @if($producto->img_1)
                            <img src="{{ $producto->img_1 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_1" name="remove_img_1">
                                <label class="form-check-label" for="remove_img_1">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_1" name="img_1" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 3</h5>
                        @if($producto->img_2)
                            <img src="{{ $producto->img_2 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_2" name="remove_img_2">
                                <label class="form-check-label" for="remove_img_2">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_2" name="img_2" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen 4</h5>
                        @if($producto->img_3)
                            <img src="{{ $producto->img_3 }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-width: 100%;">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="remove_img_3" name="remove_img_3">
                                <label class="form-check-label" for="remove_img_3">Eliminar imagen</label>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="img_3" name="img_3" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <hr>
<h4 class="mt-4 mb-3">Especificaciones Técnicas</h4>

<div class="form-group mb-3">
    <label for="links">Links</label>
    <input type="text" class="form-control" id="links" name="links" value="{{ old('links', $producto->links) }}">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="volumen_carga_m3">Volumen de Carga (m³)</label>
            <input type="number" step="0.01" class="form-control" name="volumen_carga_m3" value="{{ old('volumen_carga_m3', $producto->volumen_carga_m3) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="potencia_requerida_hp">Potencia Requerida (HP)</label>
            <input type="text" class="form-control" name="potencia_requerida_hp" value="{{ old('potencia_requerida_hp', $producto->potencia_requerida_hp) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="toma_potencia_tom">TOMA DE POTENCIA (R.P.M)</label>
            <input type="text" class="form-control" name="toma_potencia_tom" value="{{ old('toma_potencia_tom', $producto->toma_potencia_tom) }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="tiempo_descarga_aprx_min">TIEMPO DE DESCARGA APROXIMADO (MIN.)</label>
            <input type="text" class="form-control" name="tiempo_descarga_aprx_min" value="{{ old('tiempo_descarga_aprx_min', $producto->tiempo_descarga_aprx_min) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="balanza">Balanza</label>
            <input type="text" class="form-control" name="balanza" value="{{ old('balanza', $producto->balanza) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="camaras">Cámaras</label>
            <input type="text" class="form-control" name="camaras" value="{{ old('camaras', $producto->camaras) }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="altura_maxima_mm">ALTURA MÁXIMA (MM)</label>
            <input type="text" class="form-control" name="altura_maxima_mm" value="{{ old('altura_maxima_mm', $producto->altura_maxima_mm) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="altura_carga_mm">ALTURA DE CARGA (MM)</label>
            <input type="text" class="form-control" name="altura_carga_mm" value="{{ old('altura_carga_mm', $producto->altura_carga_mm) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="longitud_total_mm">LONGITUD TOTAL (MM)</label>
            <input type="text" class="form-control" name="longitud_total_mm" value="{{ old('longitud_total_mm', $producto->longitud_total_mm) }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="peso_vacio_kg">PESO EN VACÍO (KG)</label>
            <input type="text" class="form-control" name="peso_vacio_kg" value="{{ old('peso_vacio_kg', $producto->peso_vacio_kg) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="de_serie">DE SERIE</label>
            <input type="text" class="form-control" name="de_serie" value="{{ old('de_serie', $producto->de_serie) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="colores">COLORES</label>
            <input type="text" class="form-control" name="colores" value="{{ old('colores', $producto->colores) }}">
        </div>
    </div>
</div>

<div class="form-group mb-4">
    <label for="opcional">OPCIONAL</label>
    <input type="text" class="form-control" name="opcional" value="{{ old('opcional', $producto->opcional) }}">
</div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
