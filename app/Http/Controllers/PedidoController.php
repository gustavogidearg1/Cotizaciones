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
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $query = Pedido::with(['user', 'subPedidos.producto'])
            ->orderBy('id', 'desc');

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
        $monedas = Moneda::all();

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
        Log::info('📝 PedidoController@store - Datos recibidos', $request->all());

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
                'tipo_pedido_id',
                'fecha_necesidad',
                'forma_pago_id',
                'forma_entrega',
                'observacion',
                'bonificacion',
                'flete_id',
                'cliente',
                'direccion',
                'localidad_id',
                'provincia_id',
                'pais_id',
                'telefono',
                'email',
                'contacto',
                'moneda_id',
                'categoria_id'
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


            $pedido->token = Str::uuid(); // o Str::random(32)

            $pedido->save();
            Log::info('✅ Pedido guardado correctamente', ['pedido_id' => $pedido->id]);

            // Subpedidos
            foreach ($request->productos as $producto) {
                $productoDB = Producto::find($producto['producto_id']);
                $esAccesorio = $productoDB && $productoDB->familia_id == 8;
                $esComponenteOImplemento = $productoDB && in_array($productoDB->familia_id, range(1, 7));

                $bonificacion = $esAccesorio ? 0 : (float) $pedido->bonificacion;
                $diferencia = $esComponenteOImplemento ? ((float)($producto['diferencia'] ?? 0)) : 0;

                $precio = (float) $producto['precio'];
                $cantidad = (int) $producto['cantidad'];
                $iva = (float) $producto['iva'];

                $precioConDiferencia = $precio * (1 + $diferencia / 100);
                $subtotal = $precioConDiferencia * $cantidad * (1 - $bonificacion / 100);
                $total = $subtotal * (1 + $iva / 100);

                $sub = SubPedido::create([
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
                ]);

                Log::info('✅ SubPedido creado', $sub->toArray());
            }

            DB::commit();

            try {
                Mail::to($pedido->email)
                    ->cc([
                        Auth::user()->email,
                        'grgodoy1984@gmail.com'
                    ])
                    ->bcc([
                        'industrial@comofrasrl.com.ar'
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
            Log::error('❌ Error al crear pedido: ' . $e->getMessage());
            Log::error('📦 Datos del request al fallar:', $request->all());
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
            'moneda',
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
        $monedas = Moneda::all();

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
            'diferencia' => 'nullable|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'flete_id' => 'nullable|exists:fletes,id',
            'moneda_id' => 'required|exists:monedas,id',

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
            $data = $request->only([
                'cliente',
                'direccion',
                'localidad_id',
                'provincia_id',
                'pais_id',
                'telefono',
                'email',
                'contacto',
                'categoria_id',
                'tipo_pedido_id',
                'fecha_necesidad',
                'forma_pago_id',
                'forma_entrega',
                'observacion',
                'bonificacion',
                'diferencia',
                'moneda_id',
                'flete_id'
            ]);

            // Imagen principal
            if ($request->has('eliminar_imagen')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $pedido->imagen));
                $data['imagen'] = null;
            } elseif ($request->hasFile('imagen')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $pedido->imagen));
                $data['imagen'] = '/storage/' . $request->file('imagen')->store('pedidos', 'public');
            }

            // Imagen secundaria
            if ($request->has('eliminar_imagen_2')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $pedido->imagen_2));
                $data['imagen_2'] = null;
            } elseif ($request->hasFile('imagen_2')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $pedido->imagen_2));
                $data['imagen_2'] = '/storage/' . $request->file('imagen_2')->store('pedidos', 'public');
            }

            $pedido->update($data);

            // Borrar subpedidos anteriores
            $pedido->subPedidos()->delete();

            foreach ($request->productos as $producto) {
                $productoDB = Producto::find($producto['producto_id']);
                $esAccesorio = $productoDB && $productoDB->familia_id == 8;
                $esComponenteOImplemento = $productoDB && in_array($productoDB->familia_id, range(1, 7));


                $bonificacion = $esAccesorio ? 0 : (float) $pedido->bonificacion;
                $diferencia = $esComponenteOImplemento ? ((float)($producto['diferencia'] ?? 0)) : 0;

                $precio = (float) $producto['precio'];
                $cantidad = (int) $producto['cantidad'];
                $iva = (float) $producto['iva'];

                $precioConDiferencia = $precio * (1 + $diferencia / 100);
                $subtotal = $precioConDiferencia * $cantidad * (1 - $bonificacion / 100);
                $total = $subtotal * (1 + $iva / 100);

                $sub = SubPedido::create([
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
                ]);

                Log::info('✅ SubPedido actualizado o creado', $sub->toArray());
            }

            DB::commit();

            return redirect()->route('pedidos.show', $pedido->id)->with('success', 'Pedido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ Error al actualizar pedido: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el pedido.');
        }
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
