<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'nom_corto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Métodos de verificación de roles
    public function isAdmin(): bool
    {
        return $this->role_id == 1;
    }

    public function isEditor(): bool
    {
        return $this->role_id === Role::EDITOR;
    }

    public function isGuest(): bool
    {
        return $this->role_id === Role::GUEST;
    }

    // Método para verificar múltiples roles
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role_id, $roles);
    }

    public function hasRole($roleName)
{
    return $this->role->name === $roleName;
}
}
