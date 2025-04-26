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
        $formasPago = FormaPago::all();
        return view('components.forma-pagos.index', compact('formasPago'));
    }

    public function create()
    {
        return view('components.forma-pagos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        FormaPago::create($request->all());

        return redirect()->route('forma-pagos.index')
            ->with('success', 'Forma de pago creada correctamente.');
    }

    public function edit(FormaPago $formaPago)
    {
        return view('components.forma-pagos.edit', compact('formaPago'));
    }

    public function update(Request $request, FormaPago $formaPago)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $formaPago->update($request->all());

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
