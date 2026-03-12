<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\entradasalidaguardia;

class guardia extends Model
{
    use HasFactory;

    protected $table = 'guardias';

    protected $fillable = [
        'nombre',
        'apellido',
        'area',
    ];

    public function entradasSalidas()
    {
        return $this->hasMany(entradasalidaguardia::class, 'id_guardia');
    }
}

