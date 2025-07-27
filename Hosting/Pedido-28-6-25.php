<?php

namespace App\Models;

//use App\Models\Cliente;
use App\Models\FormaPago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_pedido_id',
        'fecha',
        'fecha_necesidad',
        'forma_pago_id',
        'forma_entrega',
        'observacion',
        'bonificacion',
        'imagen',
        'imagen_2',
        'flete_id',
        'user_id',
        'cliente',
        'direccion',
        'localidad_id',
        'provincia_id',
        'pais_id',
        'telefono',
        'email',
        'contacto',
        'diferencia',
        'categoria_id',
        'moneda_id',
        'color_id',
        'cuit'
    ];

    protected $dates = [
        'fecha' => 'date',
        'fecha_necesidad' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
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

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}
