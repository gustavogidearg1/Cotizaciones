<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincia';
    protected $fillable = [
        'provincia',
        'pais_id',
        // Agregar si falta:
        'created_at',
        'updated_at'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
    public function localidades()
    {
        return $this->hasMany(Localidad::class, 'provincia_id');
    }
}
