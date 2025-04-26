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
    }

    public function index()
    {
        $productos = Producto::with(['unidad', 'familia', 'tipo', 'user'])->get();
        return view('abm.productos.index', compact('productos'));
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
'codigo' => 'required|numeric|unique:productos',
        'nombre' => 'required|string|max:255|unique:productos',
        'um_id' => 'required|exists:unidades,id',
        'detalle' => 'nullable|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'familia_id' => 'required|exists:familias,id',
        'activo' => 'required|boolean',
        'tipo_id' => 'required|exists:tipos,id',
        ]);

        $productoData = $validated;
        $productoData['user_id'] = auth()->id();

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
            'codigo' => 'required|numeric|unique:productos,codigo,'.$producto->id,
            'nombre' => 'required|string|max:255|unique:productos,nombre,'.$producto->id,
            'um_id' => 'required|exists:unidades,id',
            'detalle' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'familia_id' => 'required|exists:familias,id',
            'activo' => 'required|boolean',
            'tipo_id' => 'required|exists:tipos,id',
        ]);

        $productoData = $validated;

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
