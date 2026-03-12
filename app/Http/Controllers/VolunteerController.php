<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    /**
     * Mostrar lista de voluntarios
     */
    public function index()
    {
        $volunteers = Volunteer::with('area')->orderBy('id', 'desc')->get();

        return view('volunteers.index', compact('volunteers'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $areas = Area::orderBy('nombre')->get();
        return view('volunteers.create', compact('areas'));
    }

    /**
     * Guardar nuevo voluntario
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_completo'               => 'required|string|max:255',
            'genero'                        => 'required|string|max:20',
            'area_id'                       => 'required|exists:areas,id',
            'fecha_nacimiento'              => 'nullable|date',
            'calle'                         => 'nullable|string|max:255',
            'colonia'                       => 'nullable|string|max:255',
            'municipio'                     => 'nullable|string|max:255',
            'cp'                            => 'nullable|string|max:10',
            'nombre_contacto'               => 'required|string|max:255',
            'tel_emergencias'               => 'required|string|max:20',
            'fecha_ingreso'                 => 'required|date',

            // Documentos
            'documento_identidad'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'comprobante_domicilio'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'certificado_medico'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'acuerdo'                       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'aut_exclusion_responsabilidad' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'reglamento_voluntarios'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',

            // Foto: dos opciones
            'foto_upload'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_camera'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Guardar documentos
        $documentos = [
            'documento_identidad',
            'comprobante_domicilio',
            'certificado_medico',
            'acuerdo',
            'aut_exclusion_responsabilidad',
            'reglamento_voluntarios',
        ];

        foreach ($documentos as $archivo) {
            if ($request->hasFile($archivo)) {
                $data[$archivo] = $request->file($archivo)->store('documentos', 'public');
            }
        }

        // Guardar foto desde galería/subida
        if ($request->hasFile('foto_upload')) {
            $data['foto'] = $request->file('foto_upload')->store('fotos_voluntarios', 'public');
        }

        // Guardar foto desde cámara
        if ($request->hasFile('foto_camera')) {
            $data['foto'] = $request->file('foto_camera')->store('fotos_voluntarios', 'public');
        }

        Volunteer::create($data);

        return redirect()->route('volunteers.index')
            ->with('success', 'Voluntario registrado correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Volunteer $volunteer)
    {
        $areas = Area::orderBy('nombre')->get();
        return view('volunteers.edit', compact('volunteer', 'areas'));
    }

    /**
     * Actualizar voluntario
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'nombre_completo'               => 'required|string|max:255',
            'genero'                        => 'required|string|max:20',
            'area_id'                       => 'required|exists:areas,id',
            'fecha_nacimiento'              => 'nullable|date',
            'calle'                         => 'nullable|string|max:255',
            'colonia'                       => 'nullable|string|max:255',
            'municipio'                     => 'nullable|string|max:255',
            'cp'                            => 'nullable|string|max:10',
            'nombre_contacto'               => 'required|string|max:255',
            'tel_emergencias'               => 'required|string|max:20',
            'fecha_ingreso'                 => 'required|date',

            // Documentos
            'documento_identidad'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'comprobante_domicilio'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'certificado_medico'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'acuerdo'                       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'aut_exclusion_responsabilidad' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'reglamento_voluntarios'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',

            // Foto: dos opciones
            'foto_upload'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_camera'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $documentos = [
            'documento_identidad',
            'comprobante_domicilio',
            'certificado_medico',
            'acuerdo',
            'aut_exclusion_responsabilidad',
            'reglamento_voluntarios',
        ];

        foreach ($documentos as $archivo) {
            if ($request->hasFile($archivo)) {
                if ($volunteer->$archivo && Storage::disk('public')->exists($volunteer->$archivo)) {
                    Storage::disk('public')->delete($volunteer->$archivo);
                }

                $data[$archivo] = $request->file($archivo)->store('documentos', 'public');
            }
        }

        // Si suben foto desde galería
        if ($request->hasFile('foto_upload')) {
            if ($volunteer->foto && Storage::disk('public')->exists($volunteer->foto)) {
                Storage::disk('public')->delete($volunteer->foto);
            }

            $data['foto'] = $request->file('foto_upload')->store('fotos_voluntarios', 'public');
        }

        // Si toman foto desde cámara
        if ($request->hasFile('foto_camera')) {
            if ($volunteer->foto && Storage::disk('public')->exists($volunteer->foto)) {
                Storage::disk('public')->delete($volunteer->foto);
            }

            $data['foto'] = $request->file('foto_camera')->store('fotos_voluntarios', 'public');
        }

        $volunteer->update($data);

        return redirect()->route('volunteers.index')
            ->with('success', 'Voluntario actualizado correctamente');
    }

    /**
     * Eliminar voluntario
     */
    public function destroy(Volunteer $volunteer)
    {
        $archivos = [
            'foto',
            'documento_identidad',
            'comprobante_domicilio',
            'certificado_medico',
            'acuerdo',
            'aut_exclusion_responsabilidad',
            'reglamento_voluntarios',
        ];

        foreach ($archivos as $archivo) {
            if ($volunteer->$archivo && Storage::disk('public')->exists($volunteer->$archivo)) {
                Storage::disk('public')->delete($volunteer->$archivo);
            }
        }

        $volunteer->delete();

        return redirect()->route('volunteers.index')
            ->with('success', 'Voluntario eliminado correctamente');
    }
}

