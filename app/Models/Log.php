<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'info',
        'message',
        'context',
    ];

        protected $casts = [
        'context' => 'array', // <-- Este campo se convierte automáticamente a array
    ];
}
