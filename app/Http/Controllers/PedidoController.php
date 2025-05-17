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

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $query = Pedido::with(['user', 'subPedidos.producto'])
            ->orderBy('fecha', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('cliente', 'like', "%$search%") // Buscar directamente en campo cliente
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    })
                    ->orWhere('solicitante', 'like', "%$search%")
                    ->orWhere('id', 'like', "%$search%");
            });
        }

        $pedidos = $query->paginate(10);

        return view('components.pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        //$clientes = Cliente::all();
        $formasPago = FormaPago::all();
        $productos = Producto::where('activo', 1)
            ->where('tipo_id', 1)
            ->get();
        $colores = Color::all();
        $monedas = Moneda::all();
        $tipoPedidos = TipoPedido::all();
        $fletes = Flete::all();
        $localidades = Localidad::all();
        $provincias = Provincia::with('pais')->get(); // Cargar relación país
        $paises = Pais::all();
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

        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.precio' => 'required|numeric|min:0',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.moneda_id' => 'required|exists:monedas,id',
        'productos.*.iva' => 'required|numeric|min:0|max:100',
        'productos.*.color_id' => 'nullable|exists:colores,id',
    ]);

    DB::beginTransaction();

    try {
        $pedido = new Pedido();
        $pedido->fill($request->only([
            'tipo_pedido_id', 'fecha_necesidad', 'forma_pago_id',
            'forma_entrega', 'observacion', 'bonificacion', 'flete_id',
            'cliente', 'direccion', 'localidad_id', 'provincia_id', 'pais_id',
            'telefono', 'email', 'contacto', 'categoria_id'
        ]));
        $pedido->fecha = now();
        $pedido->user_id = Auth::id();

        // Imágenes
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('pedidos', 'public');
            $pedido->imagen = '/storage/' . $path;
        }
        if ($request->hasFile('imagen_2')) {
            $path = $request->file('imagen_2')->store('pedidos', 'public');
            $pedido->imagen_2 = '/storage/' . $path;
        }

        $pedido->save();

        // Subpedidos
        foreach ($request->productos as $producto) {

                $productoDB = Producto::find($producto['producto_id']);

                $esAccesorio = $productoDB && $productoDB->familia_id == 8;

            SubPedido::create([
        'producto_id' => $producto['producto_id'],
        'precio' => $producto['precio'],
        'cantidad' => $producto['cantidad'],
        'moneda_id' => $producto['moneda_id'],
        'iva' => $producto['iva'],
        'detalle' => $producto['detalle'] ?? null,
        'color_id' => $producto['color_id'] ?? null,
        'subbonificacion' => $esAccesorio ? 0 : $pedido->bonificacion,
        'sub_fecha_entrega' => $pedido->fecha_necesidad,
        'pedido_id' => $pedido->id,
            ]);
        }

DB::commit();

try {
    // Obtener el mail del usuario logueado
    $userEmail = Auth::user()->email;

Mail::to($pedido->email)
    ->cc([
        Auth::user()->email,             // Usuario que cargó el pedido
        'grgodoy1984@gmail.com'   // Otro más
    ])
    ->bcc([
        'industrial@comofrasrl.com.ar'  // Copia oculta
    ])
    ->send(new PedidoCreado($pedido));
} catch (\Exception $ex) {
    Log::error('Error al enviar correo: ' . $ex->getMessage());
}

return redirect()->route('pedidos.show', $pedido->id)
    ->with('success', 'Pedido creado correctamente' .
        (isset($ex) ? ', pero hubo un problema al enviar el correo.' : ' y correo enviado.'));


    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al crear pedido: ' . $e->getMessage());
        return back()->with('error', 'Error al crear el pedido: ' . $e->getMessage());
    }
}


    public function show(Pedido $pedido)
    {

        //$pedido = Pedido::with(['subPedidos.color', 'subPedidos.producto'])->findOrFail($id);

        $pedido->load([
            //'cliente',
            'formaPago',
            'user',
            'subPedidos.producto',
            'subPedidos.moneda',
            'localidad',
            'provincia',
            'pais',
            'categoria',
            'subPedidos.color'
        ]);
        return view('components.pedidos.show', compact('pedido'));
    }



    public function edit(Pedido $pedido)
    {
        $colores = Color::all();
        $formasPago = FormaPago::all();
        $productos = Producto::where('activo', 1)->get();
        $monedas = Moneda::all();
        $tipoPedidos = TipoPedido::all();
        $fletes = Flete::all();

        $localidades = Localidad::all();
        $provincias = Provincia::with('pais')->get();
        $paises = Pais::all();
        $categorias = Categoria::all();
        $familias = Familia::all();

        $pedido->load('subPedidos');

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
            'colores'
        ));
    }

    public function update(Request $request, Pedido $pedido)

    {
        //Log::info('Datos recibidos en update:', $request->all());
        //dd($request->all());
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

            'subpedidos' => 'required|array|min:1',  // ← Validación para 'subpedidos'
            'subpedidos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.precio' => 'required|numeric|min:0',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.moneda_id' => 'required|exists:monedas,id',
            'productos.*.iva' => 'required|numeric|min:0|max:100',
            'color_id' => 'nullable|exists:colores,id',

        ]);

        $data = [

            'tipo_pedido_id' => $request->tipo_pedido_id,
            'fecha_necesidad' => $request->fecha_necesidad,
            'forma_pago_id' => $request->forma_pago_id,
            'forma_entrega' => $request->forma_entrega,
            'observacion' => $request->observacion,
            'bonificacion' => $request->bonificacion,
            'flete_id' => $request->flete_id,
            'cliente' => $request->cliente,
            'direccion' => $request->direccion,
            'localidad_id' => $request->localidad_id,
            'provincia_id' => $request->provincia_id,
            'pais_id' => $request->pais_id ?? 1, // Valor por defecto
            'telefono' => $request->telefono,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'categoria_id' => $request->categoria_id ?? 1,
        ];

        // Procesar imagen principal
        if ($request->has('eliminar_imagen')) {
            $oldImagePath = str_replace('/storage/', '', $pedido->imagen);
            Storage::disk('public')->delete($oldImagePath);
            $data['imagen'] = null;
        } elseif ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($pedido->imagen) {
                $oldImagePath = str_replace('/storage/', '', $pedido->imagen);
                Storage::disk('public')->delete($oldImagePath);
            }

            $path = $request->file('imagen')->store('pedidos', 'public');
            $data['imagen'] = '/storage/' . $path;
        }

        // Procesar imagen secundaria
        if ($request->has('eliminar_imagen_2')) {
            $oldImagePath = str_replace('/storage/', '', $pedido->imagen_2);
            Storage::disk('public')->delete($oldImagePath);
            $data['imagen_2'] = null;
        } elseif ($request->hasFile('imagen_2')) {
            if ($pedido->imagen_2) {
                $oldImagePath = str_replace('/storage/', '', $pedido->imagen_2);
                Storage::disk('public')->delete($oldImagePath);
            }

            $path = $request->file('imagen_2')->store('pedidos', 'public');
            $data['imagen_2'] = '/storage/' . $path;
        }

        $pedido->update($data);

        // Eliminar todos los subpedidos existentes
        $pedido->subPedidos()->delete();


        // Crear nuevos subpedidos con los datos del formulario
        foreach ($request->subpedidos as $subpedidoData) {
            $subtotal = $subpedidoData['precio'] * $subpedidoData['cantidad'] * (1 - ($request->bonificacion / 100));
            $total = $subtotal * (1 + ($subpedidoData['iva'] / 100));

            SubPedido::create([
                'producto_id' => $subpedidoData['producto_id'],
                'precio' => $subpedidoData['precio'],
                'subbonificacion' => $request->bonificacion,
                'iva' => $subpedidoData['iva'],
                'cantidad' => $subpedidoData['cantidad'],
                'moneda_id' => $subpedidoData['moneda_id'],
                'sub_fecha_entrega' => $request->fecha_necesidad,
                'subtotal' => $subtotal,
                'total' => $total,
                'detalle' => $subpedidoData['detalle'] ?? null,
                'pedido_id' => $pedido->id,
                'color_id' => $subpedidoData['color_id']
            ]);
        }
        return redirect()->route('pedidos.show', $pedido->id)
            ->with('success', 'Pedido actualizado correctamente.');
    }


    public function destroy(Pedido $pedido)
    {
        try {
            // Eliminar imágenes primero
            if ($pedido->imagen) {
                $imagePath = str_replace('/storage/', '', $pedido->imagen);
                Storage::disk('public')->delete($imagePath);
            }

            if ($pedido->imagen_2) {
                $imagePath = str_replace('/storage/', '', $pedido->imagen_2);
                Storage::disk('public')->delete($imagePath);
            }

            $pedido->delete();

            return redirect()->route('pedidos.index')
                ->with('success', 'Pedido eliminado correctamente.');
        } catch (\Exception $e) {
            //Log::error('Error al eliminar pedido: ' . $e->getMessage());
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
            'imagen2_url' => $pedido->imagen_2 ? config('app.url') . $pedido->imagen : null,
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
            ->select([
                'id',
                'codigo',
                'nombre',
                'um_id',
                'familia_id',
                'detalle',
                'img'
            ])
            ->with(['unidad', 'familia']) // Cargar relaciones necesarias
            ->get();

        return response()->json($productos);
    }
}
