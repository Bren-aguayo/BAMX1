<?php

namespace App\Http\Controllers;

use App\Models\ingreso_salida;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class IngresoSalidaController extends Controller
{
    /**
     * Mostrar registros
     */
    public function index()
    {
        // Cargar volunteer y su área
        $ingreso_salidas = ingreso_salida::with('volunteer.area')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->get();

        return view('ingreso_salidas.index', compact('ingreso_salidas'));
    }

    /**
     * Mostrar formulario
     */
    public function create()
    {
        return view('ingreso_salidas.create');
    }

    /**
     * Registrar entrada o salida
     */
    public function registrarEntrada(Request $request)
    {
        $request->validate([
            'id_registro' => 'required|exists:volunteers,id',
        ]);

        $fechaHoy = now('America/Mexico_City')->toDateString();

        // Buscar voluntario con su área
        $volunteer = Volunteer::with('area')->find($request->id_registro);

        if (!$volunteer) {
            return back()->with('error', 'Voluntario no encontrado.');
        }

        // Ruta de foto o imagen por defecto
        $foto = $volunteer->foto ? asset('storage/' . $volunteer->foto) : asset('images/sin-foto.png');

        // VALIDACIÓN DE VETADO
        if ($volunteer->is_vetado == 1) {
            return back()
                ->with('error', 'Acceso denegado - Voluntario vetado.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $foto);
        }

        // Buscar si ya existe registro hoy
        $registro = ingreso_salida::where('id_registro', $request->id_registro)
            ->where('fecha', $fechaHoy)
            ->first();

        // REGISTRAR ENTRADA
        if (!$registro) {
            ingreso_salida::create([
                'id_registro'  => $request->id_registro,
                'hora_entrada' => now('America/Mexico_City')->format('H:i:s'),
                'fecha'        => $fechaHoy,
            ]);

            return back()
                ->with('success', 'Entrada registrada correctamente.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $foto);
        }

        // REGISTRAR SALIDA
        if (!$registro->hora_salida) {
            $registro->update([
                'hora_salida' => now('America/Mexico_City')->format('H:i:s'),
            ]);

            return back()
                ->with('success', 'Salida registrada correctamente.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $foto);
        }

        // Ya registró todo
        return back()
            ->with('info', 'Ya registraste entrada y salida el día de hoy.')
            ->with('nombre', $volunteer->nombre_completo)
            ->with('area', $volunteer->area->nombre ?? 'Sin área')
            ->with('foto', $foto);
    }

    /**
     * Eliminar registro
     */
    public function destroy(ingreso_salida $ingreso_salida)
    {
        $ingreso_salida->delete();

        return back()->with('success', 'Registro eliminado correctamente.');
    }
}

