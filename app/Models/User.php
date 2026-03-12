<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function esAdmin()
    {
        return $this->rol === 'administracion';
    }

    public function esEncargado()
    {
        return $this->rol === 'encargado';
    }

    public function esGuardia()
    {
        return $this->rol === 'guardia';
    }

    public function esDespensas()
    {
        return $this->rol === 'despensas';
    }

    public function tieneRol($rol)
    {
        return $this->rol === $rol;
    }

    public function tieneAlgunRol(array $roles)
    {
        return in_array($this->rol, $roles);
    }
}

