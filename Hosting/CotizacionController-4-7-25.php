<?php


namespace App\Http\Controllers;

use id;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use App\Models\SubCotizacion;
use Illuminate\Support\Facades\Auth;

//importacion
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
//use League\Csv\Writer;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::with('user')
    ->orderBy('id', 'desc')
    ->paginate(5);
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

        return redirect()->route('cotizaciones.index')->with('success', 'CotizaciÃ³n creada correctamente');
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

        return redirect()->route('cotizaciones.index')->with('success', 'CotizaciÃ³n actualizada correctamente');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->subCotizaciones()->delete();
        $cotizacion->delete();
        return redirect()->route('cotizaciones.index')->with('success', 'CotizaciÃ³n eliminada correctamente');
    }
    
public function buscarProducto(Request $request)
{
    $search = $request->input('search');

    $productos = Producto::with(['unidad', 'familia', 'tipo', 'user'])
        ->where(function ($query) use ($search) {
            $query->where('codigo', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%");
        })
        ->paginate(10);

    return view('components.cotizaciones.buscar_producto', compact('productos', 'search'));
}

public function consultaProducto($id)
{
    $producto = Producto::with(['unidad', 'familia', 'tipo', 'user'])->findOrFail($id);

    $ultimoPrecio = SubCotizacion::with(['cotizacion', 'moneda'])
        ->where('producto_id', $producto->id)
        ->orderByDesc('cotizacion_id')
        ->first();

    return view('components.cotizaciones.consulta_producto', compact('producto', 'ultimoPrecio'));
}

public function formImportar()
{
    return view('components.cotizaciones.import');
}

public function importar(Request $request)
{
    $request->validate([
        'cotizacion' => 'required|unique:cotizaciones|max:100',
        'descripcion' => 'required|max:100',
        'vencimiento' => 'required|date',
        'archivo_csv' => 'required|mimes:csv,txt|max:2048'
    ]);

    $cotizacion = Cotizacion::create([
        'cotizacion' => $request->cotizacion,
        'descripcion' => $request->descripcion,
        'vencimiento' => $request->vencimiento,
        'user_id' => Auth::id()
    ]);

    $csv = \League\Csv\Reader::createFromPath($request->file('archivo_csv')->getRealPath(), 'r');
    $csv->setHeaderOffset(0);

    $errores = [];
    $linea = 1;

    foreach ($csv->getRecords() as $record) {
        $linea++;

        $validator = Validator::make($record, [
            'producto_id' => 'required|exists:productos,id',
            'moneda_id' => 'required|exists:monedas,id',
            'precio' => 'required|numeric',
            'precio_bonificado' => 'required|numeric',
            'descuento' => 'required|numeric',
            'detalle' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            $errores[] = "L¨ªnea $linea: " . implode(' | ', $validator->errors()->all());
            continue;
        }

        SubCotizacion::create([
            'producto_id' => $record['producto_id'],
            'moneda_id' => $record['moneda_id'],
            'precio' => $record['precio'],
            'precio_bonificado' => $record['precio_bonificado'],
            'descuento' => $record['descuento'],
            'detalle' => $record['detalle'] ?? '-',
            'cotizacion_id' => $cotizacion->id
        ]);
    }

    if (count($errores) > 0) {
        session()->flash('errores_importacion', $errores);
    }

    return redirect()->route('cotizaciones.index')->with('success', 'Cotizaci¨®n importada correctamente');
}



public function exportarPlantilla()
{
    $productos = Producto::where('activo', 1)->get();

    $filename = 'plantilla_cotizacion_' . date('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($productos) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['producto_id', 'moneda_id', 'precio', 'precio_bonificado', 'descuento', 'detalle']);

        foreach ($productos as $producto) {
            fputcsv($handle, [
                $producto->id,
                1,
                0.00,
                0.00,
                0.00,
                '',
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}




}
