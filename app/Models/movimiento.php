<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_registro',
        'hora',
        'id_area_salida',
        'id_area_entrada',
        'motivo',
    ];


    public function id_area_salidas(){
        return $this->belongsTo(area::class,'id_area_salida');
    }
     public function id_area_entradas(){
        return $this->belongsTo(area::class,'id_area_entrada');
    }

    public function registros(){
        return $this->belongsTo(registro::class,'id_registro');
    }
}
