<?php

namespace App\Http\Controllers;

use App\Models\Permitida;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class PermitidaController extends Controller
{
    /**
     * Mostrar historial
     */
    public function index()
    {
        $permitidas = Permitida::with('volunteer.area')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_salida', 'desc')
            ->get();

        return view('permitidas.index', compact('permitidas'));
    }

    /**
     * Mostrar formulario
     */
    public function create()
    {
        return view('permitidas.create');
    }

    /**
     * Registrar salida permitida o reingreso
     */
    public function registrarMovimiento(Request $request)
    {
        $request->validate([
            'id_registro' => 'required|exists:volunteers,id',
            'motivo'      => 'required|string|max:255',
            'encargado'   => 'required|string|max:255',
        ]);

        $fechaHoy = now('America/Mexico_City')->toDateString();
        $horaActual = now('America/Mexico_City')->format('H:i:s');

        $volunteer = Volunteer::with('area')->find($request->id_registro);

        if (!$volunteer) {
            return back()->with('error', 'Voluntario no encontrado.');
        }

        $foto = $volunteer->foto
            ? asset('storage/' . $volunteer->foto)
            : asset('images/sin-foto.png');

        if ($volunteer->is_vetado == 1) {
            return back()
                ->with('error', 'Acceso denegado - Voluntario vetado.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $foto);
        }

        // Buscar salida pendiente del día o la más reciente sin reingreso
        $registroPendiente = Permitida::where('volunteer_id', $request->id_registro)
            ->where('estado', 'fuera')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_salida', 'desc')
            ->first();

        // SI NO HAY SALIDA PENDIENTE => REGISTRAR SALIDA
        if (!$registroPendiente) {
            Permitida::create([
                'volunteer_id' => $request->id_registro,
                'fecha' => $fechaHoy,
                'hora_salida' => $horaActual,
                'encargado_salida' => $request->encargado,
                'motivo' => $request->motivo,
                'estado' => 'fuera',
            ]);

            return back()
                ->with('success', 'Salida permitida registrada correctamente.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $foto);
        }

        // SI YA HAY SALIDA PENDIENTE => REGISTRAR REINGRESO
        $registroPendiente->update([
            'hora_reingreso' => $horaActual,
            'encargado_reingreso' => $request->encargado,
            'concepto_reingreso' => $request->motivo,
            'estado' => 'reingreso',
        ]);

        return back()
            ->with('success', 'Reingreso registrado correctamente.')
            ->with('nombre', $volunteer->nombre_completo)
            ->with('area', $volunteer->area->nombre ?? 'Sin área')
            ->with('foto', $foto);
    }

    /**
     * Eliminar registro
     */
    public function destroy(Permitida $permitida)
    {
        $permitida->delete();

        return back()->with('success', 'Registro eliminado correctamente.');
    }
}
