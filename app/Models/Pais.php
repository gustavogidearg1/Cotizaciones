<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'pais';
    protected $fillable = [
        'pais',
        // Agregar si falta:
        'created_at',
        'updated_at'
    ];

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class);
    }
}
