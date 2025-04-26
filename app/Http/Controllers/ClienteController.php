<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with(['localidad', 'provincia', 'categoria'])->get();
        return view('abm.cliente.index', compact('clientes'));
    }

    public function create()
    {
        $localidades = Localidad::all();
        $provincias = Provincia::all();
        $categorias = Categoria::all();
        return view('abm.cliente.create', compact('localidades', 'provincias', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:cliente|max:255',
            'descuento' => 'numeric|min:0|max:100',
            'email' => 'nullable|email',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Cliente::create($request->all());

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('abm.cliente.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $localidades = Localidad::all();
        $provincias = Provincia::all();
        $categorias = Categoria::all();
        return view('abm.cliente.edit', compact('cliente', 'localidades', 'provincias', 'categorias'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:cliente,nombre,'.$cliente->id,
            'descuento' => 'numeric|min:0|max:100',
            'email' => 'nullable|email',
        ]);

        $cliente->update($request->all());

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente eliminado exitosamente');
    }
}
