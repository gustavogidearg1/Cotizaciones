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
    public function index(Request $request)
{
    $cotizaciones = Cotizacion::with('user')
        ->orderBy('id', 'desc')
        ->paginate(10);

    $ultimaCotizacion = Cotizacion::with(['subCotizaciones.producto', 'subCotizaciones.moneda'])->latest()->first();

    $query = $request->input('buscar');
    $subCotizaciones = collect();

    if ($ultimaCotizacion) {
        $subCotizaciones = $ultimaCotizacion->subCotizaciones()->with(['producto', 'moneda'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('producto', function ($p) use ($query) {
                    $p->where('nombre', 'like', "%{$query}%")
                      ->orWhere('codigo', 'like', "%{$query}%");
                });
            })
            ->paginate(20); // paginar de a 20
    }

    return view('components.cotizaciones.index', compact('cotizaciones', 'subCotizaciones', 'ultimaCotizacion', 'query'));
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

public function duplicarConAumento(Request $request)
{
    $porcentaje = $request->input('aumento', 0); // % de aumento
    $ultimaCotizacion = Cotizacion::latest()->with('subCotizaciones')->first();

    if (!$ultimaCotizacion) {
        return redirect()->route('cotizaciones.index')->with('error', 'No hay cotizaciones previas para copiar.');
    }

    $monedas = Moneda::all();
    $productos = Producto::where('activo', 1)->get();

    // Aplica aumento a cada precio
    $subCotizaciones = $ultimaCotizacion->subCotizaciones->map(function ($sub) use ($porcentaje) {
        $precioNuevo = round($sub->precio * (1 + $porcentaje / 100), 2);
        $bonifNuevo = round($sub->precio_bonificado * (1 + $porcentaje / 100), 2);
        return [
            'producto_id' => $sub->producto_id,
            'moneda_id' => $sub->moneda_id,
            'precio' => $precioNuevo,
            'precio_bonificado' => $bonifNuevo,
            'descuento' => $sub->descuento,
            'detalle' => $sub->detalle,
        ];
    });

    return view('components.cotizaciones.duplicar', compact('productos', 'monedas', 'subCotizaciones', 'porcentaje'));
}

public function productosUltimaCotizacion()
{
    $ultimaCotizacion = Cotizacion::with('subCotizaciones.producto', 'subCotizaciones.moneda')
        ->latest()
        ->first();

    if (!$ultimaCotizacion) {
        return back()->with('error', 'No hay cotizaciones registradas.');
    }

    $subCotizaciones = $ultimaCotizacion->subCotizaciones;

    return view('cotizaciones.productos_ultima', compact('subCotizaciones', 'ultimaCotizacion'));
}

public function actualizarSubCotizacion(Request $request, $id)
{
    $sub = SubCotizacion::findOrFail($id);

    $sub->precio = $request->input('precio');
    $sub->precio_bonificado = $request->input('precio_bonificado');
    $sub->detalle = $request->input('detalle');
    $sub->save();

    return back()->with('success', 'Producto actualizado correctamente.');
}

public function editarPrecios(Request $request)
{
    // Obtener la ¨²ltima cotizaci¨®n
    $ultimaCotizacion = \App\Models\Cotizacion::orderByDesc('id')->first();

    // Si hay b¨²squeda por producto
    $buscar = $request->input('buscar');
    $subCotizaciones = \App\Models\SubCotizacion::with(['producto', 'moneda'])
        ->where('cotizacion_id', $ultimaCotizacion?->id);

    if ($buscar) {
        $subCotizaciones = $subCotizaciones->whereHas('producto', function ($q) use ($buscar) {
            $q->where('nombre', 'like', "%$buscar%")
                ->orWhere('codigo', 'like', "%$buscar%");
        });
    }
    $subCotizaciones = $subCotizaciones->paginate(20);

    return view('components.cotizaciones.editar_precios', compact('ultimaCotizacion', 'subCotizaciones'));
}

public function guardarPrecios(Request $request)
{
    $productos = $request->input('productos', []);

    foreach ($productos as $sub_id => $datos) {
        $sub = \App\Models\SubCotizacion::find($sub_id);
        if ($sub) {
            $sub->precio = $datos['precio'];
            $sub->precio_bonificado = $datos['precio_bonificado'];
            $sub->detalle = $datos['detalle'] ?? null;
            $sub->save();
        }
    }
    return redirect()->route('components.cotizaciones.editar_precios')->with('success', 'Precios actualizados correctamente.');
}



}
