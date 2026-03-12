<?php

namespace App\Exports;

use App\Models\ingreso_salida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IngresossalidasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ingreso_salida::select('id_registro',
        'hora_entrada',
        'hora_salida',
        'fecha',)->get();
    }

    public function headings():array{
        return['Id del voluntario', 'Hora de entrada', 'Hora de salida', 'Fecha'];
    }
}
