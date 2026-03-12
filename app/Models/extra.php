<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class Extra extends Model
{
    use HasFactory;

    protected $table = 'extras';

    protected $fillable = [
        'id_registro',
        'entrada',
        'salida',
        'encargado',
        'motivo',
        'horas_extra',
        'pago_extra',
        'estado_entrega',
        'fecha_entrega',
        'hora_entrega',
        'responsable_entrega',
    ];

    /**
     * Relación con Volunteer
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'id_registro');
    }

    /**
     * Accesor para mostrar nombre completo
     */
    public function getNombreVoluntarioAttribute()
    {
        return $this->volunteer
            ? $this->volunteer->nombre_completo
            : 'Voluntario no encontrado';
    }
}

