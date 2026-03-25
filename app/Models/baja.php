<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class Baja extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'tipo',
        'motivo',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    // 🔗 Relación con Volunteer
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

    /**
     * Saber si la restricción sigue activa
     */
    public function estaActiva()
    {
        if ($this->tipo === 'definitiva') {
            return true;
        }

        if ($this->tipo === 'temporal') {
            if (!$this->fecha_fin) {
                return false;
            }

            return now()->toDateString() <= $this->fecha_fin->toDateString();
        }

        return false;
    }

    /**
     * Mostrar etiqueta bonita del tipo
     */
    public function getTipoTextoAttribute()
    {
        return match ($this->tipo) {
            'definitiva' => 'Baja definitiva',
            'temporal' => 'Suspensión temporal',
            default => 'Sin definir',
        };
    }

    /**
     * Mostrar etiqueta bonita del estatus
     */
    public function getEstatusTextoAttribute()
    {
        return $this->estaActiva() ? 'Activa' : 'Vencida';
    }
}

