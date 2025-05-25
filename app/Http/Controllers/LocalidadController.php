<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function index()
    {
        $localidades = Localidad::with(['provincia', 'pais'])->get();
        return view('abm.localidad.index', compact('localidades'));
    }

    public function create()
    {
        $provincias = Provincia::all();
        $paises = Pais::all();
        return view('abm.localidad.create', compact('provincias', 'paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:localidad,nombre',
            'cp' => 'required|string|max:10',
            'provincia_id' => 'required|exists:provincia,id',
            'pais_id' => 'required|exists:pais,id',
        ]);

        Localidad::create($request->only('nombre', 'cp', 'provincia_id', 'pais_id'));

        return redirect()->route('localidad.index')->with('success', 'Localidad creada correctamente.');
    }

    public function show($id)
    {
        $localidad = Localidad::with(['provincia', 'pais'])->findOrFail($id);
        return view('abm.localidad.show', compact('localidad'));
    }

    public function edit(Localidad $localidad)
    {
        $provincias = Provincia::all();
        $paises = Pais::all();
        return view('abm.localidad.edit', compact('localidad', 'provincias', 'paises'));
    }

    public function update(Request $request, Localidad $localidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:localidad,nombre,' . $localidad->id,
            'cp' => 'required|string|max:10',
            'provincia_id' => 'required|exists:provincia,id',
            'pais_id' => 'required|exists:pais,id',
        ]);

        $localidad->update($request->only('nombre', 'cp', 'provincia_id', 'pais_id'));

        return redirect()->route('localidad.index')->with('success', 'Localidad actualizada correctamente.');
    }

    public function destroy(Localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidad.index')->with('success', 'Localidad eliminada correctamente.');
    }
}
