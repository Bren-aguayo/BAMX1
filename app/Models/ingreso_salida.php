<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class ingreso_salida extends Model
{
    use HasFactory;

    // 👇 Muy importante cuando el modelo no sigue convención
    protected $table = 'ingreso_salidas';

    protected $fillable = [
        'id_registro',
        'hora_entrada',
        'hora_salida',
        'fecha',
    ];

    /**
     * Relación con volunteers
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'id_registro', 'id');
    }
}
