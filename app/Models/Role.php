<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    // Relación con usuarios
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    // Constantes para los roles
    public const ADMIN = 1;
    public const EDITOR = 2;
    public const GUEST = 3;

    // Método para obtener nombres legibles
    public static function getRoleName($id): string
    {
        return self::find($id)->name ?? 'Desconocido';
    }
}
