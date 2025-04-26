<?php


namespace App\Http\Controllers;

use id;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use App\Models\SubCotizacion;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::with('user')->get();
        return view('components.cotizaciones.index', compact('cotizaciones'));
    }

    public function create()
    {
        $monedas = Moneda::all();
        $productos = Producto::where('activo', 1)->get();

        return view('components.cotizaciones.create', [
            'monedas' => $monedas,
            'productos' => $productos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cotizacion' => 'required|unique:cotizaciones|max:100',
            'descripcion' => 'required|max:100',
            'vencimiento' => 'required|date',
            'observacion' => 'nullable|max:255',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.moneda_id' => 'required|exists:monedas,id',
            'productos.*.precio' => 'required|numeric',
            'productos.*.precio_bonificado' => 'required|numeric',
            'productos.*.descuento' => 'required|numeric',
            'productos.*.detalle' => 'nullable|max:100',
        ]);

        $cotizacion = Cotizacion::create([
            'cotizacion' => $request->cotizacion,
            'descripcion' => $request->descripcion,
            'vencimiento' => $request->vencimiento,
            'observacion' => $request->observacion,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->productos as $producto) {
            SubCotizacion::create([
                'producto_id' => $producto['producto_id'],
                'moneda_id' => $producto['moneda_id'],
                'precio' => $producto['precio'],
                'precio_bonificado' => $producto['precio_bonificado'],
                'descuento' => $producto['descuento'],
                'detalle' => $producto['detalle'],
                'cotizacion_id' => $cotizacion->id,
            ]);
        }

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización creada correctamente');
    }

    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load([
            'subCotizaciones.producto',
            'subCotizaciones.moneda',
            'user'
        ]);

        return view('components.cotizaciones.show', compact('cotizacion'));
    }

    public function edit(Cotizacion $cotizacion)
    {
        $monedas = Moneda::all();
        $productos = Producto::where('activo', 1)->get();

        // Convertir vencimiento a Carbon si es string
        if (is_string($cotizacion->vencimiento)) {
            $cotizacion->vencimiento = \Carbon\Carbon::parse($cotizacion->vencimiento);
        }

        $cotizacion->load('subCotizaciones');
        return view('components.cotizaciones.edit', compact('cotizacion', 'monedas', 'productos'));
    }
    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'cotizacion' => 'required|max:100|unique:cotizaciones,cotizacion,'.$cotizacion->id,
            'descripcion' => 'required|max:100',
            'vencimiento' => 'required|date',
            'observacion' => 'nullable|max:255',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.moneda_id' => 'required|exists:monedas,id',
            'productos.*.precio' => 'required|numeric',
            'productos.*.precio_bonificado' => 'required|numeric',
            'productos.*.descuento' => 'required|numeric',
            'productos.*.detalle' => 'nullable|max:100',
        ]);

        $cotizacion->update([
            'cotizacion' => $request->cotizacion,
            'descripcion' => $request->descripcion,
            'vencimiento' => $request->vencimiento,
            'observacion' => $request->observacion,
        ]);

        // Eliminar subcotizaciones antiguas
        $cotizacion->subCotizaciones()->delete();

        // Crear nuevas subcotizaciones
        foreach ($request->productos as $producto) {
            SubCotizacion::create([
                'producto_id' => $producto['producto_id'],
                'moneda_id' => $producto['moneda_id'],
                'precio' => $producto['precio'],
                'precio_bonificado' => $producto['precio_bonificado'],
                'descuento' => $producto['descuento'],
                'detalle' => $producto['detalle'],
                'cotizacion_id' => $cotizacion->id,
            ]);
        }

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización actualizada correctamente');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->subCotizaciones()->delete();
        $cotizacion->delete();
        return redirect()->route('cotizaciones.index')->with('success', 'Cotización eliminada correctamente');
    }
}
