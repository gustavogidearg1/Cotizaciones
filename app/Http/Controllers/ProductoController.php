<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Unidad;
use App\Models\Familia;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin-or-editor')->except(['index', 'show']);
    }

    public function index(Request $request)
{
    $search = $request->input('search');

    $productos = Producto::with(['unidad', 'familia', 'tipo', 'user'])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('codigo', 'like', "%{$search}%");
            });
        })
        ->orderBy('nombre')
        ->paginate(10);

    return view('abm.productos.index', compact('productos', 'search'));
}

    public function create()
    {
        $unidades = Unidad::all();
        $familias = Familia::all();
        $tipos = Tipo::all();
        return view('abm.productos.create', compact('unidades', 'familias', 'tipos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|numeric|unique:productos,codigo',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'um_id' => 'required|exists:unidades,id',
            'detalle' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'familia_id' => 'required|exists:familias,id',
            'activo' => 'required|boolean',
            'tipo_id' => 'required|exists:tipos,id',
            'links' => 'nullable|string|max:255',
            'volumen_carga_m3' => 'nullable|numeric|between:0,999999.99',
            'potencia_requerida_hp' => 'nullable|string|max:50',
            'toma_potencia_tom' => 'nullable|string|max:50',
            'tiempo_descarga_aprx_min' => 'nullable|string|max:50',
            'balanza' => 'nullable|string|max:50',
            'camaras' => 'nullable|string|max:50',
            'altura_maxima_mm' => 'nullable|numeric|between:0,999999.99',
            'altura_carga_mm' => 'nullable|numeric|between:0,999999.99',
            'longitud_total_mm' => 'nullable|numeric|between:0,999999.99',
            'peso_vacio_kg' => 'nullable|numeric|between:0,999999.99',
            'de_serie' => 'nullable|string|max:255',
            'opcional' => 'nullable|string|max:255',
            'colores' => 'nullable|string|max:255',
        ], [
            'codigo.unique' => 'Ya existe un producto con el código ingresado.',
            'nombre.unique' => 'Ya existe un producto con el nombre ingresado.',
        ]);


        $productoData = $validated;
        $productoData['user_id'] = auth()->id(); // ✅ Funciona perfectamente


        $productoData += $request->only([
            'links',
            'volumen_carga_m3',
            'potencia_requerida_hp',
            'toma_potencia_tom',
            'tiempo_descarga_aprx_min',
            'balanza',
            'camaras',
            'altura_maxima_mm',
            'altura_carga_mm',
            'longitud_total_mm',
            'peso_vacio_kg',
            'de_serie',
            'opcional',
            'colores'
        ]);


        // Procesar imágenes
        $imageFields = ['img', 'img_1', 'img_2', 'img_3'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('img', 'public');
                $productoData[$field] = '/storage/' . $path;
            }
        }

        Producto::create($productoData);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        $producto->load(['unidad', 'familia', 'tipo', 'user']);
        return view('abm.productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $unidades = Unidad::all();
        $familias = Familia::all();
        $tipos = Tipo::all();
        return view('abm.productos.edit', compact('producto', 'unidades', 'familias', 'tipos'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'codigo' => 'required|numeric|unique:productos,codigo,' . $producto->id,
            'nombre' => 'required|string|max:255|unique:productos,nombre,' . $producto->id,
            'um_id' => 'required|exists:unidades,id',
            'detalle' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'familia_id' => 'required|exists:familias,id',
            'activo' => 'required|boolean',
            'tipo_id' => 'required|exists:tipos,id',
            'links' => 'nullable|string|max:255',
            'volumen_carga_m3' => 'nullable|numeric|between:0,999999.99',
            'potencia_requerida_hp' => 'nullable|string|max:50',
            'toma_potencia_tom' => 'nullable|string|max:50',
            'tiempo_descarga_aprx_min' => 'nullable|string|max:50',
            'balanza' => 'nullable|string|max:50',
            'camaras' => 'nullable|string|max:50',
            'altura_maxima_mm' => 'nullable|numeric|between:0,999999.99',
            'altura_carga_mm' => 'nullable|numeric|between:0,999999.99',
            'longitud_total_mm' => 'nullable|numeric|between:0,999999.99',
            'peso_vacio_kg' => 'nullable|numeric|between:0,999999.99',
            'de_serie' => 'nullable|string|max:255',
            'opcional' => 'nullable|string|max:255',
            'colores' => 'nullable|string|max:255',


        ]);

        $productoData = $validated;

        $productoData += $request->only([
            'links',
            'volumen_carga_m3',
            'potencia_requerida_hp',
            'toma_potencia_tom',
            'tiempo_descarga_aprx_min',
            'balanza',
            'camaras',
            'altura_maxima_mm',
            'altura_carga_mm',
            'longitud_total_mm',
            'peso_vacio_kg',
            'de_serie',
            'opcional',
            'colores'
        ]);


        // Procesar imágenes
        $imageFields = ['img', 'img_1', 'img_2', 'img_3'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Eliminar imagen anterior si existe
                if ($producto->$field) {
                    $oldImagePath = str_replace('/storage/', '', $producto->$field);
                    Storage::disk('public')->delete($oldImagePath);
                }

                $path = $request->file($field)->store('img', 'public');
                $productoData[$field] = '/storage/' . $path;
            }
        }

        $producto->update($productoData);

        $productoData['user_id'] = auth()->id(); // opcional, si querés registrar el último que lo modificó


        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        // Eliminar imágenes asociadas
        $imageFields = ['img', 'img_1', 'img_2', 'img_3'];
        foreach ($imageFields as $field) {
            if ($producto->$field) {
                $imagePath = str_replace('/storage/', '', $producto->$field);
                Storage::disk('public')->delete($imagePath);
            }
        }

        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
