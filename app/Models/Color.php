<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colores';

    //$fillable: Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    //$casts: Conversión de tipos para los timestamps
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
