<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;

class Entregadespensa extends Model
{
    use HasFactory;

    protected $table = 'entregadespensas';

    protected $fillable = [
        'volunteer_id',
        'fecha',
        'hora',
        'cantidad',
        'responsable',
    ];

    /**
     * Una entrega pertenece a un voluntario
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }
}