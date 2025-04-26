<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'um_id',
        'detalle',
        'img',
        'img_1',
        'img_2',
        'img_3',
        'familia_id',
        'activo',
        'tipo_id',
        'user_id'
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'um_id');
    }

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
