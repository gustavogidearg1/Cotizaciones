<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::orderBy('id', 'asc')->paginate(10);
        return view('abm.tipos.index', compact('tipos'));
    }

    public function create()
    {
        return view('abm.tipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50'
        ]);

        Tipo::create($request->only('nombre'));

        return redirect()->route('tipos.index')->with('success', 'Tipo creado correctamente.');
    }

    public function show(Tipo $tipo)
    {
        return view('abm.tipos.show', compact('tipo'));
    }

    public function edit(Tipo $tipo)
    {
        return view('abm.tipos.edit', compact('tipo'));
    }

    public function update(Request $request, Tipo $tipo)
    {
        $request->validate([
            'nombre' => 'required|max:50'
        ]);

        $tipo->update($request->only('nombre'));

        return redirect()->route('tipos.index')->with('success', 'Tipo actualizado correctamente.');
    }

    public function destroy(Tipo $tipo)
    {
        $tipo->delete();
        return redirect()->route('tipos.index')->with('success', 'Tipo eliminado correctamente.');
    }
}

