<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Volunteer;
use Carbon\Carbon;

class ImportVolunteers extends Command
{
    protected $signature = 'import:volunteers {path}';

    protected $description = 'Importar voluntarios desde un archivo CSV';

    public function handle(): void
    {
        $path = $this->argument('path');

        if (!file_exists($path)) {
            $this->error('El archivo no existe');
            return;
        }

        $file = fopen($path, 'r');
        $header = fgetcsv($file); // encabezados

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);

            Volunteer::create([
                'nombre_completo' => $data['nombre_completo'] ?? null,
                'genero' => $data['genero'] ?? null,
                'area' => $data['area'] ?? null,
                'fecha_nacimiento' => $this->parseDate($data['fecha_nacimiento'] ?? null),
                'documento_identidad' => null,
                'comprobante_domicilio' => null,
                'calle' => $data['calle'] ?? null,
                'colonia' => $data['colonia'] ?? null,
                'municipio' => $data['municipio'] ?? null,
                'cp' => $data['cp'] ?? null,
                'certificado_medico' => null,
                'acuerdo' => null,
                'aut_exclusion_responsabilidad' => null,
                'reglamento_voluntarios' => null,
                'nombre_contacto' => $data['nombre_contacto'] ?? null,
                'tel_emergencias' => $data['tel_emergencias'] ?? null,
                'fecha_ingreso' => $this->parseDate($data['fecha_ingreso'] ?? null),
            ]);
        }

        fclose($file);

        $this->info('Voluntarios importados correctamente ✅');
    }

    private function parseDate($date)
    {
        if (!$date) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
