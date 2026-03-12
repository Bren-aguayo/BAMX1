<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permitida extends Model
{
    use HasFactory;

    protected $table = 'permitidas';

    protected $fillable = [
        'volunteer_id',
        'hora_salida',
        'fecha',
        'encargado_salida',
        'motivo',
        'hora_reingreso',
        'encargado_reingreso',
        'concepto_reingreso',
        'estado',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }
}

