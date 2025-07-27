<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

            foreach (['imagen_principal', 'imagen_secundaria'] as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store('images', 'public');
            $data[$field] = $path;

            // Copiar a public/storage
            $source = storage_path('app/public/' . $path);
            $dest = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($dest));
            File::copy($source, $dest);
        }
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
        foreach (['imagen_principal', 'imagen_secundaria'] as $field) {
        if ($request->has("remove_$field")) {
            Storage::disk('public')->delete($familia->$field);
            @unlink(public_path('storage/' . $familia->$field));
            $data[$field] = null;
        } elseif ($request->hasFile($field)) {
            if ($familia->$field) {
                Storage::disk('public')->delete($familia->$field);
                @unlink(public_path('storage/' . $familia->$field));
            }

            $path = $request->file($field)->store('images', 'public');
            $data[$field] = $path;

            $source = storage_path('app/public/' . $path);
            $dest = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($dest));
            File::copy($source, $dest);
        }
    }

        $familia->update($data);

        return redirect()->route('familias.index')->with('success', 'Familia actualizada correctamente.');
    }

public function destroy(Familia $familia)
{
    foreach (['imagen_principal', 'imagen_secundaria'] as $field) {
        if ($familia->$field) {
            Storage::disk('public')->delete($familia->$field);
            @unlink(public_path('storage/' . $familia->$field));
        }
    }

    $familia->delete();

    return redirect()->route('familias.index')->with('success', 'Familia eliminada correctamente.');
}

}
