<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    protected $table = 'familias';

    protected $fillable = [
        'nombre',
        'imagen_principal',
        'imagen_secundaria'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
