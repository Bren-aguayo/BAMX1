<?php

namespace App\Exports;

use App\Models\registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return registro::select('id',  'nombre',
        'apellido_p',
        'apellido_m',
        'genero',
        'nac',
        'ine',
        'domicilio',
        'calle',
        'colonia',
        'municipio',
        'codigop',
        'certificadom',
        'acuerdo',
        'autorizacion',
        'reglamento',
        'contactoemergencia',
        'telefonoemergencia',
        'fechaingreso',
        'principal',
        'alternativa_uno',
        'alternativa_dos',
        'especiales',
        'foto',)->get();
        
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Apellido', 'Apellido materno', 'Género', 'Fecha de nacimiento', 'Ine',
        'Comprobante de domicilio', 'Calle', 'Colonia', 'Municipio', 'Código Postal',
        'Certificado medico', 'Acuerdo', 'Atorización', 'Reglamento', 'Nombre del contacto de emergencia',
        'Numero del contacto de emergencia', 'Fecha de ingreso', 'Área principal', 'Área alternativa', 'Área alternativa',
        'Cndiciones especiales', 'Foto'];
    }
}
