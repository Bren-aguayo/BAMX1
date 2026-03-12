<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteers';

    protected $fillable = [
        'nombre_completo',
        'genero',
        'area_id',
        'fecha_nacimiento',
        'documento_identidad',
        'comprobante_domicilio',
        'calle',
        'colonia',
        'municipio',
        'cp',
        'certificado_medico',
        'acuerdo',
        'aut_exclusion_responsabilidad',
        'reglamento_voluntarios',
        'nombre_contacto',
        'tel_emergencias',
        'fecha_ingreso',
        'foto',
        'is_vetado', // 🔴 Ahora sí se puede actualizar correctamente
    ];

    /**
     * Relación con área
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Relación con bajas
     */
    public function bajas()
    {
        return $this->hasMany(Baja::class, 'volunteer_id');
    }

    public function permitidas()
{
    return $this->hasMany(Permitida::class, 'volunteer_id');
}


}

