<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// 👇 IMPORTACIONES NECESARIAS
use App\Models\Volunteer;
use App\Models\Registro;
use App\Models\Movimiento;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad_minima',
        'cantidad_maxima',
        'encargado',
        'gerente',
    ];

    /**
     * 🔗 Un área tiene muchos voluntarios
     */
    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class, 'area_id');
    }

    // ---- Relaciones que ya tenías ----

    public function registro(): HasMany
    {
        return $this->hasMany(Registro::class, 'principal');
    }

    public function alternativa_uno(): HasMany
    {
        return $this->hasMany(Registro::class, 'alternativa_uno');
    }

    public function alternativa_dos(): HasMany
    {
        return $this->hasMany(Registro::class, 'alternativa_dos');
    }

    public function id_area_salida(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'id_area_salida');
    }

    public function id_area_entrada(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'id_area_entrada');
    }
}
