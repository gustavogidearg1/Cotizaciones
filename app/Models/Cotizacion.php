<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'cotizacion', 'descripcion', 'vencimiento', 'observacion', 'user_id'
    ];

    // Especifica qué campos deben tratarse como fechas
    protected $dates = ['vencimiento', 'created_at', 'updated_at'];

    public function subCotizaciones(): HasMany
    {
        return $this->hasMany(SubCotizacion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
