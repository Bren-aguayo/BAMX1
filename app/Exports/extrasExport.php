<?php

namespace App\Exports;

use App\Models\extra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class extrasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return extra::select(
             'id_registro',
        'entrada',
        'salida',
        'encargado',
        'motivo',
        )->get();
    }

    public function headings():array{
        return['Id del voluntario', 'Hora de entrada', 'Hora de salida', 'Encargado que autorizo', 'Motivo'];
    }
}
