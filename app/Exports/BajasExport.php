<?php

namespace App\Exports;

use App\Models\baja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Nette\Utils\Arrays;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BajasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return baja::select('id_registro',
        'concepto',)->get();
    }

    public function headings(): array{
       return['Id del voluntario', 'Concepto'] ;

    }
}
