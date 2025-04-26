<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flete;
use App\Models\Moneda;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\FormaPago;
use App\Models\SubPedido;
use App\Models\TipoPedido;
use Illuminate\Http\Request;
use App\Models\SubCotizacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

//correo electronico
use App\Mail\PedidoCreado;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Pedido::with(['cliente', 'user'])
            ->orderBy('fecha', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('cliente', function($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%");
                })
                ->orWhereHas('user', function($q) use ($search) {
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
        $clientes = Cliente::all();
        $formasPago = FormaPago::all();
        $productos = Producto::where('activo', 1)
            ->where('tipo_id', 1)
            ->get();
        $monedas = Moneda::all();
        $tipoPedidos = TipoPedido::all();
        $fletes = Flete::all();

        return view('components.pedidos.create', compact(
            'clientes', 'formasPago', 'productos', 'monedas', 'tipoPedidos', 'fletes'
        ));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'tipo_pedido_id' => 'required|exists:tipo_pedidos,id',
            'fecha_necesidad' => 'required|date',
            'forma_pago_id' => 'required|exists:forma_pagos,id',
            'forma_entrega' => 'required|string|max:255',
            'plazo_entrega' => 'nullable|string|max:100',
            'solicitante' => 'required|string|max:100',
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
        ]);

        try {
            // Creación del pedido
            $data = [
                'cliente_id' => $request->cliente_id,
                'tipo_pedido_id' => $request->tipo_pedido_id,
                'fecha' => now(),
                'fecha_necesidad' => Carbon::parse($request->fecha_necesidad),
                'forma_pago_id' => $request->forma_pago_id,
                'forma_entrega' => $request->forma_entrega,
                'plazo_entrega' => $request->plazo_entrega,
                'solicitante' => $request->solicitante,
                'observacion' => $request->observacion,
                'bonificacion' => $request->bonificacion,
                'flete_id' => $request->flete_id,
                'user_id' => Auth::id(),
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

            $pedido = Pedido::create($data);

            // Creación de subpedidos
            foreach ($request->productos as $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'] * (1 - ($request->bonificacion / 100));
                $total = $subtotal * (1 + ($producto['iva'] / 100));

                SubPedido::create([
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
                ]);
            }

            // Envío de correo electrónico
            try {
                Log::info('Intentando enviar correo a gustavog@live.com.ar');

                $pedidoConRelaciones = $pedido->load(['cliente', 'subPedidos.producto']);
                Log::debug('Datos del pedido para el correo:', $pedidoConRelaciones->toArray());

                $emailsCC = [
                    //'gerenciaproduccion@comofrasrl.com.ar',
                    'grgodoy1984@gmail.com',

                ];

                Mail::to('gustavog@live.com.ar')
                    ->cc($emailsCC)
                    ->send(new PedidoCreado($pedidoConRelaciones));

                Log::info('Correo enviado exitosamente');

                if (!view()->exists('emails.pedido_creado')) {
                    Log::error('Error: Vista de correo no encontrada');
                }

                return redirect()->route('pedidos.show', $pedido->id)
        ->with('success', 'Pedido creado correctamente.');



            } catch (\Exception $e) {
                Log::error('Error al enviar correo: ' . $e->getMessage());
                Log::error('Trace completo:', ['exception' => $e]);

                return redirect()->route('pedidos.show', $pedido->id)
                ->with('warning', 'Pedido creado, pero hubo un problema al enviar el correo de confirmación: '.$e->getMessage());
            }

        } catch (\Exception $e) {
            Log::info('Datos recibidos en update:', $request->all());
            return back()->withInput()->with('error', 'Error al crear el pedido: ' . $e->getMessage());
        }
    }

    public function show(Pedido $pedido)
    {
        $pedido->load([
            'cliente',
            'formaPago',
            'user',
            'subPedidos.producto',
            'subPedidos.moneda'
        ]);
        return view('components.pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $formasPago = FormaPago::all();
        $productos = Producto::where('activo', 1)->get();
        $monedas = Moneda::all();
        $tipoPedidos = TipoPedido::all();
        $fletes = Flete::all();

        $pedido->load('subPedidos');

        return view('components.pedidos.edit', compact(
            'pedido', 'clientes', 'formasPago', 'productos', 'monedas', 'tipoPedidos', 'fletes'
        ));
    }

    public function update(Request $request, Pedido $pedido)

    {
        Log::info('Datos recibidos en update:', $request->all());
        //dd($request->all());
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'tipo_pedido_id' => 'required|exists:tipo_pedidos,id',
            'fecha_necesidad' => 'required|date',
            'forma_pago_id' => 'required|exists:forma_pagos,id',
            'forma_entrega' => 'required|string|max:255',
            'plazo_entrega' => 'nullable|string|max:100',
            'solicitante' => 'required|string|max:100',
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
        ]);

        $data = [
            'cliente_id' => $request->cliente_id,
            'tipo_pedido_id' => $request->tipo_pedido_id,
            'fecha_necesidad' => $request->fecha_necesidad,
            'forma_pago_id' => $request->forma_pago_id,
            'forma_entrega' => $request->forma_entrega,
            'plazo_entrega' => $request->plazo_entrega,
            'solicitante' => $request->solicitante,
            'observacion' => $request->observacion,
            'bonificacion' => $request->bonificacion,
            'flete_id' => $request->flete_id,
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
        foreach ($request->productos as $productoData) {
            $subtotal = $productoData['precio'] * $productoData['cantidad'] * (1 - ($request->bonificacion / 100));
            $total = $subtotal * (1 + ($productoData['iva'] / 100));

            SubPedido::create([
                'producto_id' => $productoData['producto_id'],
                'precio' => $productoData['precio'],
                'subbonificacion' => $request->bonificacion,
                'iva' => $productoData['iva'],
                'cantidad' => $productoData['cantidad'],
                'moneda_id' => $productoData['moneda_id'],
                'sub_fecha_entrega' => $request->fecha_necesidad,
                'subtotal' => $subtotal,
                'total' => $total,
                'detalle' => $productoData['detalle'] ?? null,
                'pedido_id' => $pedido->id,
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
            Log::error('Error al eliminar pedido: ' . $e->getMessage());
            return back()->with('error', 'No se pudo eliminar el pedido.');
        }
    }

    public function getLastPrice($productoId)
    {
        $subCotizacion = SubCotizacion::where('producto_id', $productoId)
            ->latest()
            ->first();

        return response()->json([
            'precio' => $subCotizacion ? $subCotizacion->precio : 0,
            'precio_bonificado' => $subCotizacion ? $subCotizacion->precio_bonificado : 0
        ]);
    }

    public function generarPDF(Pedido $pedido)
    {
        $pedido->load([
            'cliente',
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
            'imagen1_url' => $pedido->imagen ? config('app.url').$pedido->imagen : null,
            'imagen2_url' => $pedido->imagen_2 ? config('app.url').$pedido->imagen : null,
        ];

        $pdf = Pdf::loadView('components.pedidos.pdf', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->download('pedido-'.$pedido->id.'.pdf');
    }
}
