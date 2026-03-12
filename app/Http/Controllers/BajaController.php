<?php

namespace App\Http\Controllers;

use App\Models\Baja;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class BajaController extends Controller
{
    /**
     * Mostrar listado de bajas
     */
    public function index()
    {
        $bajas = Baja::with('volunteer.area')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bajas.index', compact('bajas'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $volunteers = Volunteer::orderBy('nombre_completo')->get();
        return view('bajas.create', compact('volunteers'));
    }

    /**
     * Guardar nueva baja
     */
    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required', 'string', 'max:255'],
        ]);

        $volunteer = Volunteer::find($request->volunteer_id);

        if (!$volunteer) {
            return back()->with('error', 'Voluntario no encontrado.');
        }

        // 🔴 Evitar duplicar baja si ya está vetado
        if ($volunteer->is_vetado == 1) {
            return back()->with('info', 'Este voluntario ya está vetado.');
        }

        // 🔥 Crear registro en bajas
        Baja::create([
            'volunteer_id' => $request->volunteer_id,
            'motivo' => $request->motivo,
        ]);

        // 🔒 Marcar como vetado
        $volunteer->update([
            'is_vetado' => 1
        ]);

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Baja registrada correctamente y voluntario vetado.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Baja $baja)
    {
        $volunteers = Volunteer::orderBy('nombre_completo')->get();
        return view('bajas.edit', compact('baja', 'volunteers'));
    }

    /**
     * Actualizar baja
     */
    public function update(Request $request, Baja $baja)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required', 'string', 'max:255'],
        ]);

        $baja->update([
            'volunteer_id' => $request->volunteer_id,
            'motivo' => $request->motivo,
        ]);

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Baja actualizada correctamente.');
    }

    /**
     * Eliminar baja (reactivar voluntario)
     */
    public function destroy(Baja $baja)
    {
        $volunteer = Volunteer::find($baja->volunteer_id);

        if ($volunteer) {
            // 🔓 Quitar veto
            $volunteer->update([
                'is_vetado' => 0
            ]);
        }

        $baja->delete();

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Baja eliminada y voluntario reactivado.');
    }

    /**
     * Buscar voluntario por código (AJAX)
     */
    public function buscarVoluntario($codigo)
    {
        $volunteer = Volunteer::with('area')->find($codigo);

        if (!$volunteer) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'volunteer' => $volunteer
        ]);
    }
}