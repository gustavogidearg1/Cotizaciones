<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


public function index()
{
    $familiasPermitidas = [1, 2, 3, 4, 5, 6];

    $porImplemento = DB::table('sub_pedidos')
        ->join('productos', 'sub_pedidos.producto_id', '=', 'productos.id')
        ->whereIn('productos.familia_id', $familiasPermitidas)
        ->select('productos.nombre as producto', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('productos.nombre')
        ->orderByDesc('cantidad')
        ->limit(10)
        ->get();

    $porUsuario = DB::table('sub_pedidos')
        ->join('productos', 'sub_pedidos.producto_id', '=', 'productos.id')
        ->whereIn('productos.familia_id', $familiasPermitidas)
        ->join('pedidos', 'sub_pedidos.pedido_id', '=', 'pedidos.id')
        ->join('users', 'pedidos.user_id', '=', 'users.id')
        ->select('users.name as usuario', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('users.name')
        ->orderByDesc('cantidad')
        ->get();

    $porMes = DB::table('sub_pedidos')
        ->join('productos', 'sub_pedidos.producto_id', '=', 'productos.id')
        ->whereIn('productos.familia_id', $familiasPermitidas)
        ->join('pedidos', 'sub_pedidos.pedido_id', '=', 'pedidos.id')
        ->select(DB::raw("DATE_FORMAT(pedidos.created_at, '%Y-%m') as mes"), DB::raw('COUNT(*) as cantidad'))
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

    return view('home', compact('porImplemento', 'porUsuario', 'porMes'));
}

}
