<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\guardia;

class entradasalidaguardia extends Model
{
    use HasFactory;

    protected $table = 'entradasalidaguardias';

    protected $fillable = [
        'id_guardia',
        'hora_entrada',
        'hora_salida',
        'fecha',
    ];

    public function guardia()
    {
        return $this->belongsTo(guardia::class, 'id_guardia');
    }
}

