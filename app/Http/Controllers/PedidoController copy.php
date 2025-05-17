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
        // dd($request->all());
 Log::debug('Datos recibidos:', $request->all());
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'tipo_pedido_id' => 'required|exists:tipo_pedidos,id',
            'fecha_necesidad' => 'required|date',
            'forma_pago_id' => 'required|exists:forma_pagos,id',
            'forma_entrega' => 'required|string|max:255',
            'observacion' => 'nullable|string',
            'bonificacion' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'flete_id' => 'nullable|exists:fletes,id',
            'subpedidos' => 'required|array|min:1',
            'subpedidos.*.producto_id' => 'required|exists:productos,id',
            'subpedidos.*.precio' => 'required|numeric|min:0',
            'subpedidos.*.cantidad' => 'required|integer|min:1',
            'subpedidos.*.moneda_id' => 'required|exists:monedas,id',
            'subpedidos.*.color_id' => 'nullable|exists:colores,id',
            'subpedidos.*.iva' => 'required|numeric|min:0|max:100',
            'cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidad,id',
            'provincia_id' => 'required|exists:provincia,id',
            'pais_id' => 'sometimes|exists:pais,id',
            'telefono' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'contacto' => 'nullable|string|max:100',
            'categoria_id' => 'sometimes|exists:categorias,id',

        ]);

        // En tu método store, antes de crear el pedido:
        $localidad = Localidad::find($request->localidad_id);
        $provincia = Provincia::find($request->provincia_id);
        $pais = Pais::find($request->pais_id ?? 1);

        if (!$localidad || !$provincia || !$pais) {
            return back()->with('error', 'Error en las relaciones de ubicación')->withInput();
        }

        if ($validator->fails()) {
            //Log::error('Errores de validación:', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Creación del pedido
            $data = [
                'tipo_pedido_id' => $request->tipo_pedido_id,
                'fecha' => now(),
                'fecha_necesidad' => Carbon::parse($request->fecha_necesidad),
                'forma_pago_id' => $request->forma_pago_id,
                'forma_entrega' => $request->forma_entrega,
                'observacion' => $request->observacion,
                'bonificacion' => $request->bonificacion,
                'flete_id' => $request->flete_id,
                'user_id' => Auth::id(),
                'cliente' => $request->cliente,
                'direccion' => $request->direccion,
                'localidad_id' => $request->localidad_id,
                'provincia_id' => $request->provincia_id,
                'pais_id' => $request->pais_id ?? 1,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'contacto' => $request->contacto,
                'categoria_id' => $request->categoria_id ?? 1,
                'color_id' => $request->color_id,
            ];

            // Manejo de imágenes
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('pedidos', 'public');
                $data['imagen'] = '/storage/' . $path;
            }

            if ($request->hasFile('imagen_2')) {
                $path = $request->file('imagen_2')->store('pedidos', 'public');
                $data['imagen_2'] = '/storage/' . $path;
            }

            // Crear el pedido primero
            $pedido = Pedido::create($data);



            // Creación de subpedidos
            foreach ($request->productos as $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'] * (1 - ($request->bonificacion / 100));
                $total = $subtotal * (1 + ($producto['iva'] / 100));

                $subpedidoData = [
                    'producto_id' => $producto['producto_id'],
                    'precio' => $producto['precio'],
                    'subbonificacion' => $request->bonificacion,
                    'iva' => $producto['iva'],
                    'cantidad' => $producto['cantidad'],
                    'moneda_id' => $producto['moneda_id'],
                    'sub_fecha_entrega' => $request->fecha_necesidad,
                    'subtotal' => $subtotal,
                    'total' => $total,
                    'detalle' => $producto['detalle'] ?? null,
                    'pedido_id' => $pedido->id,
                    'color_id' => $producto['color_id'] ?? null,

                ];

                // Log::info('Creando subpedido:', $subpedidoData);
                SubPedido::create($subpedidoData);
            }

            // Envío de correo electrónico
            try {


                $pedidoConRelaciones = $pedido->load(['subPedidos.producto']);


                $emailsCC = [
                    'grgodoy1984@gmail.com',
                ];

                Mail::to($pedido->email)
                    ->cc($emailsCC)
                    ->send(new PedidoCreado($pedidoConRelaciones));

                if (!view()->exists('emails.pedido_creado')) {
                    //Log::error('Error: Vista de correo no encontrada');
                }
            } catch (\Exception $e) {

                // Aunque falle el correo, continuamos con la redirección
                return redirect()->route('pedidos.show', $pedido->id)
                    ->with('warning', 'Pedido creado, pero hubo un problema al enviar el correo de confirmación: ' . $e->getMessage());
            }

            // Redirección única después de todo el proceso
            return redirect()->route('pedidos.show', $pedido->id)
                ->with('success', 'Pedido creado correctamente.');
        } catch (\Exception $e) {

            return back()->withInput()->with('error', 'Error al crear el pedido: ' . $e->getMessage());
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

            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
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
