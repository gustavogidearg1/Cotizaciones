<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;

   protected $fillable = ['nombre', 'descripcion', 'diferencia', 'activo'];

       protected $casts = [
        'activo' => 'boolean',
        'diferencia' => 'decimal:2'
    ];
}

