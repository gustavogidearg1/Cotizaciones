<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    protected $fillable = ['categoria', 'descripcion'];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
