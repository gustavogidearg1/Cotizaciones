<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamiliaController extends Controller
{
    public function index()
    {
        $familias = Familia::all();
        return view('abm.familias.index', compact('familias'));
    }

    public function create()
    {
        return view('abm.familias.create');
    }




    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_secundaria' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nombre');

        if ($request->hasFile('imagen_principal')) {
            $path = $request->file('imagen_principal')->store('img', 'public');
            $data['imagen_principal'] = $path;
        }

        if ($request->hasFile('imagen_secundaria')) {
            $path = $request->file('imagen_secundaria')->store('img', 'public');
            $data['imagen_secundaria'] = $path;
        }

        Familia::create($data);

        return redirect()->route('familias.index')->with('success', 'Familia creada correctamente.');
    }

    public function show(Familia $familia)
    {
        return view('abm.familias.show', compact('familia'));
    }

    public function edit(Familia $familia)
    {
        return view('abm.familias.edit', compact('familia'));
    }

    public function update(Request $request, Familia $familia)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_secundaria' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nombre');

        // Manejar imagen principal
        if ($request->has('remove_imagen_principal')) {
            Storage::disk('public')->delete($familia->imagen_principal);
            $data['imagen_principal'] = null;
        } elseif ($request->hasFile('imagen_principal')) {
            if ($familia->imagen_principal) {
                Storage::disk('public')->delete($familia->imagen_principal);
            }
            $path = $request->file('imagen_principal')->store('img', 'public');
            $data['imagen_principal'] = $path;
        }

        // Manejar imagen secundaria
        if ($request->has('remove_imagen_secundaria')) {
            Storage::disk('public')->delete($familia->imagen_secundaria);
            $data['imagen_secundaria'] = null;
        } elseif ($request->hasFile('imagen_secundaria')) {
            if ($familia->imagen_secundaria) {
                Storage::disk('public')->delete($familia->imagen_secundaria);
            }
            $path = $request->file('imagen_secundaria')->store('img', 'public');
            $data['imagen_secundaria'] = $path;
        }

        $familia->update($data);

        return redirect()->route('familias.index')->with('success', 'Familia actualizada correctamente.');
    }

public function destroy(Familia $familia)
{
    // Eliminar imágenes si existen
    if ($familia->imagen_principal) {
        Storage::disk('public')->delete($familia->imagen_principal);
    }

    if ($familia->imagen_secundaria) {
        Storage::disk('public')->delete($familia->imagen_secundaria);
    }

    $familia->delete();

    return redirect()->route('familias.index')->with('success', 'Familia eliminada correctamente.');
}
}
