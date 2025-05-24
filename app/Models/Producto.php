<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
    'codigo', 'nombre', 'um_id', 'detalle',
    'img', 'img_1', 'img_2', 'img_3',
    'familia_id', 'activo', 'tipo_id', 'user_id',
    'links', 'volumen_carga_m3', 'potencia_requerida_hp', 'toma_potencia_tom',
    'tiempo_descarga_aprx_min', 'balanza', 'camaras',
    'altura_maxima_mm', 'altura_carga_mm', 'longitud_total_mm',
    'peso_vacio_kg', 'de_serie', 'opcional', 'colores'
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
