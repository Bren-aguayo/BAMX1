<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    // 👇 TABLA REAL EN BD
    protected $table = 'volunteers';

    protected $fillable = [
        'nombre_completo',
        'genero',
        'area',
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
    ];

    /* ================= RELACIONES ================= */

    public function ingresoSalidas()
    {
        return $this->hasMany(Ingreso_Salida::class, 'id_registro');
    }

    public function permitidas()
    {
        return $this->hasMany(Permitida::class, 'id_registro');
    }

    public function anticipadas()
    {
        return $this->hasMany(Anticipada::class, 'id_registro');
    }

    public function extras()
    {
        return $this->hasMany(Extra::class, 'id_registro');
    }

    public function incidentes()
    {
        return $this->hasMany(Incidente::class, 'id_registro');
    }

    public function bajas()
    {
        return $this->hasMany(Baja::class, 'id_registro');
    }

    public function reingresos()
    {
        return $this->hasMany(Reingreso::class, 'id_registro');
    }

    public function norecibios()
    {
        return $this->hasMany(Norecibio::class, 'id_registro');
    }

    public function entrgadespensas()
    {
        return $this->hasMany(Entregadespensa::class, 'id_registro');
    }
}
