<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPedido extends Model
{
    use HasFactory;

protected $fillable = [
    'producto_id',
    'precio',
    'subbonificacion',
    'descuento_2',
    'descuento_3',
    'descuento_4',
    'diferencia',
    'iva',
    'cantidad',
    'moneda_id',
    'forma_pago_id',
    'sub_fecha_entrega',
    'subtotal',
    'total',
    'detalle',
    'pedido_id',
    'color_id'
];


    protected $dates = ['sub_fecha_entrega'];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class)->withDefault([
            'nombre' => 'Color no especificado'
        ]);
    }

    // Eventos del modelo
    protected static function booted()
    {
        static::creating(function ($subPedido) {
            $subtotal = $subPedido->precio * $subPedido->cantidad * (1 - ($subPedido->subbonificacion / 100));
            $subPedido->subtotal = $subtotal;
            $subPedido->total = $subtotal * (1 + ($subPedido->iva / 100));
        });

        static::updating(function ($subPedido) {
            $subtotal = $subPedido->precio * $subPedido->cantidad * (1 - ($subPedido->subbonificacion / 100));
            $subPedido->subtotal = $subtotal;
            $subPedido->total = $subtotal * (1 + ($subPedido->iva / 100));
        });
    }

    public function formaPago()
{
    return $this->belongsTo(FormaPago::class);
}

}
