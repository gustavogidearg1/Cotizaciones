<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $colores = Color::orderBy('nombre')->paginate(10);
        return view('abm.colores.index', compact('colores'));
    }

    public function create()
    {
        return view('abm.colores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:colores',
            'descripcion' => 'nullable|string|max:50|unique:colores'
        ]);

        Color::create($request->all());

        return redirect()->route('colores.index')
            ->with('success', 'Color creado correctamente.');
    }

    public function show(Color $color)
    {
        return view('abm.colores.show', compact('color'));
    }

    public function edit(Color $color)
    {
        return view('abm.colores.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:colores,nombre,'.$color->id,
            'descripcion' => 'nullable|string|max:50|unique:colores,descripcion,'.$color->id
        ]);

        $color->update($request->all());

        return redirect()->route('colores.index')
            ->with('success', 'Color actualizado correctamente.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colores.index')
            ->with('success', 'Color eliminado correctamente.');
    }
}
