<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return view('abm.pais.index', compact('paises'));
    }

    public function create()
    {
        return view('abm.pais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pais' => 'required|string|max:100|unique:pais',
        ]);

        Pais::create($request->all());

        return redirect()->route('pais.index')->with('success', 'País creado correctamente.');
    }

public function show($id)
{
    $pais = Pais::findOrFail($id);
    return view('abm.pais.show', compact('pais'));
}

// Cambié el nombre de la variable a $pais
    public function edit(Pais $pais)

 {
    return view('abm.pais.edit', compact('pais'));
}

    // update
    public function update(Request $request, Pais $pais)
    {
        $request->validate([
            'pais' => 'required|string|max:100|unique:pais,pais,' . $pais->id,
        ]);

        $pais->update($request->all());

        return redirect()->route('pais.index')->with('success', 'País actualizado correctamente.');
    }

    // destroy
    public function destroy(Pais $pais)
    {
        $pais->delete();
        return redirect()->route('pais.index')->with('success', 'País eliminado correctamente.');
    }
}
