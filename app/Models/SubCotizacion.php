<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCotizacion extends Model
{
    protected $table = 'sub_cotizaciones'; // Especifica el nombre correcto de la tabla

    protected $fillable = [
        'producto_id', 'moneda_id', 'precio', 'precio_bonificado',
        'descuento', 'detalle', 'cotizacion_id'
    ];

    public function cotizacion(): BelongsTo
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function moneda(): BelongsTo
    {
        return $this->belongsTo(Moneda::class);
    }
}
