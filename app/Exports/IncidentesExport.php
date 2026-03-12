<?php

namespace App\Exports;

use App\Models\incidente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncidentesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return incidente::select('id_registro',
        'motivo',
        'fecha',
        'hora',
        'encargado',)->get();
    }

    public function headings():array{
        return['Id del voluntario', 'Motivo', 'Fecha', 'Hora', 'Encargado'];
    }
}
