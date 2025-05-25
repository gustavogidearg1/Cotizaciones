<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index()
    {
        $provincias = Provincia::with('pais')->get();
        return view('abm.provincia.index', compact('provincias'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('abm.provincia.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provincia' => 'required|string|max:100|unique:provincia',
            'pais_id' => 'required|exists:pais,id',
        ]);

        Provincia::create($request->only('provincia', 'pais_id'));

        return redirect()->route('provincia.index')->with('success', 'Provincia creada correctamente.');
    }

    public function show($id)
    {
        $provincia = Provincia::with('pais')->findOrFail($id);
        return view('abm.provincia.show', compact('provincia'));
    }

    public function edit(Provincia $provincia)
    {
        $paises = Pais::all();
        return view('abm.provincia.edit', compact('provincia', 'paises'));
    }

    public function update(Request $request, Provincia $provincia)
    {
        $request->validate([
            'provincia' => 'required|string|max:100|unique:provincia,provincia,' . $provincia->id,
            'pais_id' => 'required|exists:pais,id',
        ]);

        $provincia->update($request->only('provincia', 'pais_id'));

        return redirect()->route('provincia.index')->with('success', 'Provincia actualizada correctamente.');
    }

    public function destroy(Provincia $provincia)
    {
        $provincia->delete();
        return redirect()->route('provincia.index')->with('success', 'Provincia eliminada correctamente.');
    }
}
