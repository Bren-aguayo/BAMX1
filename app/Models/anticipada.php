<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class Anticipada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_registro',
        'hora',
        'fecha',
        'motivo',
        'encargado'
    ];

    // 👇 AHORA pertenece directamente a Volunteer
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'id_registro');
    }
}

