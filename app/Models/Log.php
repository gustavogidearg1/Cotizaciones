<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'info', 'message', 'context'
    ];

    protected $casts = [
        'context' => 'array', // Convierte automáticamente JSON a array y viceversa
    ];
}
