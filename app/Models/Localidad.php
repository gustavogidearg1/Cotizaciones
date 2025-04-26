<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidad';
    protected $fillable = ['localidad', 'cp', 'provincia_id', 'pais_id'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
