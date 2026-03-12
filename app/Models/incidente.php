<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class Incidente extends Model
{
    use HasFactory;

    protected $table = 'incidentes';

    protected $fillable = [
        'volunteer_id',
        'motivo',
        'fecha',
        'hora',
        'encargado',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }
}

