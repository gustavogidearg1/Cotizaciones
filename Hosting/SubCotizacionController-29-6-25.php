<?php

namespace App\Http\Controllers;

use App\Models\SubCotizacion;
use App\Models\Producto;
use App\Models\Moneda;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class SubCotizacionController extends Controller
{
    public function create(Cotizacion $cotizacion)
    {
        $productos = Producto::all();
        $monedas = Moneda::all();
        return view('sub_cotizaciones.create', compact('cotizacion', 'productos', 'monedas'));
    }

    public function store(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'moneda_id' => 'required|exists:monedas,id',
            'precio' => 'required|numeric|min:0',
            'precio_bonificado' => 'required|numeric|min:0',
            'descuento' => 'required|numeric|min:0|max:100',
            'detalle' => 'nullable|max:100',
        ]);

        $subCotizacion = new SubCotizacion($request->all());
        $subCotizacion->cotizacion_id = $cotizacion->id;
        $subCotizacion->save();

        return redirect()->route('cotizaciones.show', $cotizacion)
            ->with('success', 'Producto agregado a la cotización exitosamente.');
    }

    public function edit(Cotizacion $cotizacion, SubCotizacion $subCotizacion)
    {
        $productos = Producto::all();
        $monedas = Moneda::all();
        return view('sub_cotizaciones.edit', compact('cotizacion', 'subCotizacion', 'productos', 'monedas'));
    }

    public function update(Request $request, Cotizacion $cotizacion, SubCotizacion $subCotizacion)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'moneda_id' => 'required|exists:monedas,id',
            'precio' => 'required|numeric|min:0',
            'precio_bonificado' => 'required|numeric|min:0',
            'descuento' => 'required|numeric|min:0|max:100',
            'detalle' => 'nullable|max:100',
        ]);

        $subCotizacion->update($request->all());

        return redirect()->route('cotizaciones.show', $cotizacion)
            ->with('success', 'Producto actualizado en la cotización exitosamente.');
    }

    public function destroy(Cotizacion $cotizacion, SubCotizacion $subCotizacion)
    {
        $subCotizacion->delete();

        return redirect()->route('cotizaciones.show', $cotizacion)
            ->with('success', 'Producto eliminado de la cotización exitosamente.');
    }
}
