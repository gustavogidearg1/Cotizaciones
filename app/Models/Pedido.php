<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\FormaPago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'tipo_pedido_id', 'fecha', 'fecha_necesidad', 'forma_pago_id',
        'forma_entrega', 'plazo_entrega', 'solicitante', 'observacion',
        'bonificacion', 'imagen', 'imagen_2', 'flete_id', 'user_id'
    ];

    protected $dates = [
        'fecha' => 'date',
        'fecha_necesidad' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subPedidos()
    {
        return $this->hasMany(SubPedido::class);
    }

    public function tipoPedido()
    {
        return $this->belongsTo(TipoPedido::class, 'tipo_pedido_id');
    }

    public function flete()
    {
        return $this->belongsTo(Flete::class);
    }

    public function getTotalAttribute()
    {
        return $this->subPedidos->sum('total');
    }
}
