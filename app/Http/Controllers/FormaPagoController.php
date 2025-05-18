<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    $formaPagos = FormaPago::all();
    return view('abm.forma-pagos.index', compact('formaPagos'));
    }

    public function create()
    {
        return view('abm.forma-pagos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:forma_pagos',
            'descripcion' => 'nullable|string',
            'diferencia' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        FormaPago::create($validated);

        return redirect()->route('forma-pagos.index')
            ->with('success', 'Forma de pago creada correctamente.');
    }

    public function show(FormaPago $formaPago)
    {
        return view('abm.forma-pagos.show', compact('formaPago'));
    }

    public function edit(FormaPago $formaPago)
    {
        return view('abm.forma-pagos.edit', compact('formaPago'));
    }

    public function update(Request $request, FormaPago $formaPago)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:forma_pagos,nombre,'.$formaPago->id,
            'descripcion' => 'nullable|string',
            'diferencia' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        $formaPago->update($validated);

        return redirect()->route('forma-pagos.index')
            ->with('success', 'Forma de pago actualizada correctamente.');
    }

    public function destroy(FormaPago $formaPago)
    {
        $formaPago->delete();

        return redirect()->route('forma-pagos.index')
            ->with('success', 'Forma de pago eliminada correctamente.');
    }
}
