<?php

namespace App\Http\Controllers;

use id;
use Carbon\Carbon;
use App\Models\Pais;
use App\Models\Color;
use App\Models\Flete;
//use App\Models\Cliente;
use App\Models\Moneda;
use App\Models\Pedido;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\FormaPago;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\SubPedido;
use App\Mail\PedidoCreado;
use Illuminate\Support\Facades\File;//imagenes

//correo electronico
use App\Models\TipoPedido;
use Illuminate\Http\Request;
use App\Models\SubCotizacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('verPublico');
    }


    public function index(Request $request)
{
  $user = Auth::user();

$query = Pedido::with(['user', 'subPedidos.producto'])
    ->orderBy('id', 'desc');

if ((int) $user->role_id === 3) {
    $query->where('user_id', $user->id); // Muestra solo sus pedidos
}

if ($request->has('search')) {
    $search = $request->input('search');
    $query->where(function ($q) use ($search) {
        $q->where('cliente', 'like', "%$search%")
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhere('id', 'like', "%$search%")
            ->orWhereHas('subPedidos.producto', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%");
            });
    });
}

    $pedidos = $query->paginate(10);

    return view('components.pedidos.index', compact('pedidos'));
}


    public function create()
    {
        //$clientes = Cliente::all();
        $formasPago = FormaPago::all();
$productos = Producto::with('familia')
    ->where('activo', 1)
    ->orderBy('nombre')
    ->orderBy('codigo')
    ->get();
        $colores = Color::all();
        $monedas = Moneda::all();
        $tipoPedidos = TipoPedido::all();
        $fletes = Flete::all();
        $localidades = Localidad::orderBy('nombre')->get();
        $provincias = Provincia::with('pais')->orderBy('provincia')->get();
        $paises = Pais::orderBy('pais')->get();

        $categorias = Categoria::all();
        $familias = Familia::all();

        return view('components.pedidos.create', compact(
            'formasPago',
            'productos',
            'monedas',
            'tipoPedidos',
            'fletes',
            'localidades',
            'provincias',
            'paises',
            'categorias',
            'familias',
            'colores'
        ));
    }

    public function store(Request $request)
{
    //Log::info('PedidoController@store - Datos recibidos', $request->all());

    $request->validate([
        'cliente' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'localidad_id' => 'required|exists:localidad,id',
        'provincia_id' => 'required|exists:provincia,id',
        'pais_id' => 'sometimes|exists:pais,id',
        'telefono' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'contacto' => 'nullable|string|max:100',
        'categoria_id' => 'sometimes|exists:categoria,id',
        'tipo_pedido_id' => 'required|exists:tipo_pedidos,id',
        'fecha_necesidad' => 'required|date',
        'forma_pago_id' => 'required|exists:forma_pagos,id',
        'forma_entrega' => 'required|string|max:255',
        'observacion' => 'nullable|string',
        'bonificacion' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imagen_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'flete_id' => 'nullable|exists:fletes,id',
        'moneda_id' => 'required|exists:monedas,id',
        'cuit' => 'required|digits_between:1,11',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.precio' => 'required|numeric|min:0',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.moneda_id' => 'required|exists:monedas,id',
        'productos.*.iva' => 'required|numeric|min:0|max:100',
        'productos.*.color_id' => 'nullable|exists:colores,id',
        'productos.*.diferencia' => 'nullable|numeric',
    ]);

    DB::beginTransaction();

    try {
        $pedido = new Pedido();
        $pedido->fill($request->only([
            'tipo_pedido_id', 'fecha_necesidad', 'forma_pago_id', 'forma_entrega', 'observacion',
            'bonificacion', 'flete_id', 'cliente', 'direccion', 'localidad_id', 'provincia_id',
            'pais_id', 'telefono', 'email', 'contacto', 'moneda_id', 'categoria_id', 'cuit'
        ]));
        $pedido->fecha = now();
        $pedido->user_id = Auth::id();
        $pedido->token = Str::uuid();

        // Guardar imágenes
        foreach (['imagen', 'imagen_2'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('pedidos', 'public');
                $pedido->$field = '/storage/' . $path;

                $source = storage_path('app/public/' . $path);
                $dest = public_path('storage/' . $path);
                File::ensureDirectoryExists(dirname($dest));
                File::copy($source, $dest);
            }
        }

        $pedido->save();

        // Guardar subpedidos
        foreach ($request->productos as $producto) {
$bonificacion = (float)($producto['subbonificacion'] ?? $pedido->bonificacion);
$diferencia = (float)($producto['diferencia'] ?? 0);


            $precio = (float) $producto['precio'];
            $cantidad = (int) $producto['cantidad'];
            $iva = (float) $producto['iva'];

            $precioConDiferencia = $precio * (1 + $diferencia / 100);
            $subtotal = $precioConDiferencia * $cantidad * (1 - $bonificacion / 100);
            $total = $subtotal * (1 + $iva / 100);
            
          /*  Log::info('SubPedido - Datos a guardar', [
    'producto_id' => $producto['producto_id'],
    'precio' => $precio,
    'cantidad' => $cantidad,
    'moneda_id' => $producto['moneda_id'],
    'iva' => $iva,
    'detalle' => $producto['detalle'] ?? null,
    'color_id' => $producto['color_id'] ?? null,
    'subbonificacion' => $bonificacion,
    'diferencia' => $diferencia,
    'subtotal' => $subtotal,
    'total' => $total,
    'sub_fecha_entrega' => $pedido->fecha_necesidad,
    'pedido_id' => $pedido->id,
]);*/

SubPedido::create([
    'producto_id' => $producto['producto_id'],
    'precio' => $precio,
    'cantidad' => $cantidad,
    'moneda_id' => $producto['moneda_id'],
    'iva' => $iva,
    'detalle' => $producto['detalle'] ?? null,
    'color_id' => $producto['color_id'] ?? null,
    'subbonificacion' => $producto['descuento'] ?? 0, // este viene del input
    'descuento_2' => $producto['descuento_2'] ?? 0,
    'descuento_3' => $producto['descuento_3'] ?? 0,
    'descuento_4' => $producto['descuento_4'] ?? 0,
    'forma_pago_id' => $producto['forma_pago_id'] ?? $pedido->forma_pago_id, // fallback
    'diferencia' => $producto['diferencia'] ?? 0,
    'subtotal' => $subtotal,
    'total' => $total,
    'sub_fecha_entrega' => $pedido->fecha_necesidad,
    'pedido_id' => $pedido->id,
]);

        }

        DB::commit();

        try {
            Mail::to($pedido->email)
                ->cc([Auth::user()->email, 'administracionventas@comofrasrl.com.ar', 'ventas@comofrasrl.com.ar'])
                ->bcc(['industrial@comofrasrl.com.ar'])
                ->send(new PedidoCreado($pedido));
        } catch (\Exception $ex) {
            Log::error('Error al enviar correo: ' . $ex->getMessage());
        }

        return redirect()->route('pedidos.show', $pedido->id)
            ->with('success', 'Pedido creado correctamente' . (isset($ex) ? ', pero hubo un problema al enviar el correo.' : ' y correo enviado.'));

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('❌ Error al crear pedido: ' . $e->getMessage());
        return back()->with('error', 'Error al crear el pedido.');
    }
}




    public function show(Pedido $pedido)
    {

        //$pedido = Pedido::with(['subPedidos.color', 'subPedidos.producto'])->findOrFail($id);

$pedido->load([
    'formaPago',
    'user',
    'subPedidos.producto',
    'subPedidos.moneda',
    'subPedidos.color',
    'subPedidos.formaPago',
    'localidad',
    'provincia',
    'pais',
    'categoria',
    'moneda'
]);
        return view('components.pedidos.show', compact('pedido'));
    }



    public function edit(Pedido $pedido)
{
    // Cargar los subpedidos relacionados al pedido
    $pedido->load('subPedidos');

    // Obtener todos los productos activos que pueden ser seleccionados
    $productos = Producto::where('activo', 1)->orderBy('nombre')->orderBy('codigo')->get();

    // Obtener la última SubCotización por producto activo (usando los IDs de $productos)
    $subCotizaciones = SubCotizacion::whereIn('producto_id', $productos->pluck('id'))
        ->latest('id')
        ->get()
        ->keyBy('producto_id');

    // Catálogos
    $colores       = Color::all();
    $formasPago    = FormaPago::all();
    $monedas       = Moneda::all();
    $tipoPedidos   = TipoPedido::all();
    $fletes        = Flete::all();
    $localidades   = Localidad::orderBy('nombre')->get();
    $provincias    = Provincia::with('pais')->orderBy('provincia')->get();
    $paises        = Pais::orderBy('pais')->get();
    $categorias    = Categoria::all();
    $familias      = Familia::all();

    // Vista con todos los datos necesarios
    return view('components.pedidos.edit', compact(
        'pedido',
        'formasPago',
        'productos',
        'monedas',
        'tipoPedidos',
        'fletes',
        'localidades',
        'provincias',
        'paises',
        'categorias',
        'familias',
        'colores',
        'subCotizaciones'
    ));
}



   public function update(Request $request, $id)
{
    $pedido = Pedido::findOrFail($id);

$request->validate([
    'productos.*.producto_id' => 'required|exists:productos,id',
    'productos.*.precio' => 'required|numeric|min:0',
    'productos.*.cantidad' => 'required|integer|min:1',
    'productos.*.moneda_id' => 'required|exists:monedas,id',
    'productos.*.iva' => 'required|numeric|min:0|max:100',
    'productos.*.forma_pago_id' => 'nullable|exists:forma_pagos,id',
    'productos.*.descuento' => 'nullable|numeric|min:0|max:100',
    'productos.*.descuento_2' => 'nullable|numeric|min:0|max:100',
    'productos.*.descuento_3' => 'nullable|numeric|min:0|max:100',
    'productos.*.descuento_4' => 'nullable|numeric|min:0|max:100',
]);

    // Actualizar datos generales del pedido
    $pedido->fill($request->only([
        'tipo_pedido_id', 'cliente', 'direccion', 'localidad_id', 'telefono', 'email',
        'forma_entrega', 'cuit', 'fecha_necesidad', 'forma_pago_id', 'moneda_id',
        'bonificacion', 'flete_id', 'observacion'
    ]));

    // Manejo de imágenes
    foreach (['imagen', 'imagen_2'] as $field) {
        if ($request->hasFile($field)) {
            if ($pedido->$field && Storage::exists($pedido->$field)) {
                Storage::delete($pedido->$field);
            }
            $path = $request->file($field)->store('public/pedidos');
            $pedido->$field = str_replace('public/', '/storage/', $path);

            // Copiar a public
            $source = storage_path('app/' . $path);
            $dest = public_path(str_replace('public', 'storage', $path));
            \Illuminate\Support\Facades\File::ensureDirectoryExists(dirname($dest));
            \Illuminate\Support\Facades\File::copy($source, $dest);
        }

        if ($request->filled("eliminar_$field")) {
            if ($pedido->$field && Storage::exists($pedido->$field)) {
                Storage::delete($pedido->$field);
            }
            $pedido->$field = null;
        }
    }

    $pedido->save();

    // Obtener todos los IDs existentes enviados
    $idsEnviados = collect($request->input('productos', []))
        ->pluck('id')
        ->filter()
        ->toArray();

    // Eliminar subpedidos que no fueron reenviados
    $pedido->subPedidos()->whereNotIn('id', $idsEnviados)->delete();

    // Guardar los subpedidos reenviados y/o nuevos
    foreach ($request->input('productos', []) as $index => $prod) {
        if (isset($prod['eliminar']) && $prod['eliminar'] == 1) {
            continue; // salteamos productos marcados para eliminar
        }

        $sub = isset($prod['id']) ? SubPedido::find($prod['id']) : new SubPedido();

        $productoDB = Producto::find($prod['producto_id']);
$bonificacion = (float)($prod['subbonificacion'] ?? 0);
$diferencia = (float)($prod['diferencia'] ?? 0);


        $precio = (float)($prod['precio'] ?? 0);
        $cantidad = (int)($prod['cantidad'] ?? 0);
        $iva = (float)($prod['iva'] ?? 0);

        $precioConDiferencia = $precio * (1 + $diferencia / 100);
        $subtotal = $precioConDiferencia * $cantidad * (1 - $bonificacion / 100);
        $total = $subtotal * (1 + $iva / 100);

        $sub->pedido_id = $pedido->id;
        $sub->producto_id = $prod['producto_id'];
        $sub->color_id = $prod['color_id'] ?? null;
        $sub->moneda_id = $prod['moneda_id'];
        $sub->cantidad = $cantidad;
        $sub->precio = $precio;
        $sub->forma_pago_id = $prod['forma_pago_id'] ?? null;
        $sub->diferencia = $diferencia;
        $sub->subbonificacion = $bonificacion;
        $sub->descuento_2 = $prod['descuento_2'] ?? 0;
        $sub->descuento_3 = $prod['descuento_3'] ?? 0;
        $sub->descuento_4 = $prod['descuento_4'] ?? 0;
        $sub->iva = $iva;
        $sub->detalle = $prod['detalle'] ?? null;

        // Aquí se usa el valor enviado en el formulario:
$sub->sub_fecha_entrega = $producto['sub_fecha_entrega'] ?? $pedido->fecha_necesidad;

        $sub->subtotal = $subtotal;
        $sub->total = $total;

        $sub->save();

        Log::info('✏️ SubPedido creado/actualizado', $sub->toArray());
    }

    return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente.');
}



   public function destroy(Pedido $pedido)
{
    try {
        foreach (['imagen', 'imagen_2'] as $field) {
            if ($pedido->$field) {
                $path = str_replace('/storage/', '', $pedido->$field);
                Storage::disk('public')->delete($path);
                @unlink(public_path('storage/' . $path));
            }
        }

        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    } catch (\Exception $e) {
        Log::error('Error al eliminar pedido: ' . $e->getMessage());
        return back()->with('error', 'No se pudo eliminar el pedido.');
    }
}


    public function getLastPrice($productoId)
    {
        $subCotizacion = SubCotizacion::with('moneda') // Cargar relación moneda
            ->where('producto_id', $productoId)
            ->latest()
            ->first();

        return response()->json([
            'precio' => $subCotizacion ? $subCotizacion->precio : 0,
            'precio_bonificado' => $subCotizacion ? $subCotizacion->precio_bonificado : 0,
            'moneda_id' => $subCotizacion ? $subCotizacion->moneda_id : null,
            'moneda' => $subCotizacion && $subCotizacion->moneda ? $subCotizacion->moneda->moneda : null
        ]);
    }

    public function generarPDF(Pedido $pedido)
    {
        $pedido->load([
            //'cliente',
            'formaPago',
            'user',
            'subPedidos.producto',
            'subPedidos.moneda',
            'TipoPedido'
        ]);

        // Convertir las rutas a rutas absolutas del sistema de archivos
        $data = [
            'pedido' => $pedido,
            'logo_url' => 'https://interno.comofrasrl.com.ar/sistema/img/Logotipo2023.JPG',
            'imagen1_url' => $pedido->imagen ? config('app.url') . $pedido->imagen : null,
            'imagen2_url' => $pedido->imagen_2 ? config('app.url') . $pedido->imagen_2 : null,
        ];

        $pdf = Pdf::loadView('components.pedidos.pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('pedido-' . $pedido->id . '.pdf');
    }

    public function productosPorFamilia(Familia $familia)
    {
        // Verificar si la familia existe
        if (!$familia) {
            return response()->json(['error' => 'Familia no encontrada'], 404);
        }

$productos = Producto::where('familia_id', $familia->id)
    ->where('activo', 1)
    ->orderBy('nombre')
    ->orderBy('codigo')
    ->select([
        'id',
        'codigo',
        'nombre',
        'um_id',
        'familia_id',
        'detalle',
        'img'
    ])
    ->with(['unidad', 'familia'])
    ->get();

        return response()->json($productos);
    }

    public function getDiferencia($id)
    {
        $forma = \App\Models\FormaPago::find($id);

        if (!$forma) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        return response()->json(['diferencia' => $forma->diferencia]);
    }

    public function verPublico($token)
{
    $pedido = Pedido::where('token', $token)->with(['subPedidos.producto', 'user', 'localidad', 'provincia', 'pais', 'flete', 'formaPago'])->firstOrFail();

    return view('components.pedidos.show_public', compact('pedido'));
}

}
