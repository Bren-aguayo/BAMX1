<?php

namespace App\Http\Controllers;

use App\Models\Baja;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BajaController extends Controller
{
    /**
     * Mostrar listado de restricciones
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
     * Guardar nueva restricción
     */
    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'tipo' => ['required', 'in:definitiva,temporal'],
            'motivo' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        ]);

        $volunteer = Volunteer::find($request->volunteer_id);

        if (!$volunteer) {
            return back()->with('error', 'Voluntario no encontrado.');
        }

        // Validación extra para suspensión temporal
        if ($request->tipo === 'temporal' && !$request->fecha_fin) {
            return back()
                ->withErrors(['fecha_fin' => 'La fecha fin es obligatoria para una suspensión temporal.'])
                ->withInput();
        }

        // Evitar duplicar una restricción activa
        $restriccionActiva = Baja::where('volunteer_id', $request->volunteer_id)
            ->where(function ($query) {
                $query->where('tipo', 'definitiva')
                    ->orWhere(function ($q) {
                        $q->where('tipo', 'temporal')
                          ->whereDate('fecha_fin', '>=', Carbon::today());
                    });
            })
            ->exists();

        if ($restriccionActiva) {
            return back()->with('info', 'Este voluntario ya tiene una restricción activa.');
        }

        Baja::create([
            'volunteer_id' => $request->volunteer_id,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo,
            'fecha_inicio' => $request->fecha_inicio ?? Carbon::today()->toDateString(),
            'fecha_fin' => $request->tipo === 'temporal' ? $request->fecha_fin : null,
        ]);

        // Marcar como restringido
        $volunteer->update([
            'is_vetado' => 1
        ]);

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Restricción registrada correctamente.');
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
     * Actualizar restricción
     */
    public function update(Request $request, Baja $baja)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'tipo' => ['required', 'in:definitiva,temporal'],
            'motivo' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        ]);

        if ($request->tipo === 'temporal' && !$request->fecha_fin) {
            return back()
                ->withErrors(['fecha_fin' => 'La fecha fin es obligatoria para una suspensión temporal.'])
                ->withInput();
        }

        $baja->update([
            'volunteer_id' => $request->volunteer_id,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo,
            'fecha_inicio' => $request->fecha_inicio ?? Carbon::today()->toDateString(),
            'fecha_fin' => $request->tipo === 'temporal' ? $request->fecha_fin : null,
        ]);

        // Revisar si el voluntario debe seguir restringido
        $volunteer = Volunteer::find($request->volunteer_id);

        if ($volunteer) {
            $tieneRestriccionActiva = Baja::where('volunteer_id', $volunteer->id)
                ->where(function ($query) {
                    $query->where('tipo', 'definitiva')
                        ->orWhere(function ($q) {
                            $q->where('tipo', 'temporal')
                              ->whereDate('fecha_fin', '>=', Carbon::today());
                        });
                })
                ->exists();

            $volunteer->update([
                'is_vetado' => $tieneRestriccionActiva ? 1 : 0
            ]);
        }

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Restricción actualizada correctamente.');
    }

    /**
     * Eliminar restricción y revalidar acceso del voluntario
     */
    public function destroy(Baja $baja)
    {
        $volunteer = Volunteer::find($baja->volunteer_id);

        $baja->delete();

        if ($volunteer) {
            $tieneRestriccionActiva = Baja::where('volunteer_id', $volunteer->id)
                ->where(function ($query) {
                    $query->where('tipo', 'definitiva')
                        ->orWhere(function ($q) {
                            $q->where('tipo', 'temporal')
                              ->whereDate('fecha_fin', '>=', Carbon::today());
                        });
                })
                ->exists();

            $volunteer->update([
                'is_vetado' => $tieneRestriccionActiva ? 1 : 0
            ]);
        }

        return redirect()
            ->route('bajas.index')
            ->with('success', 'Restricción eliminada correctamente.');
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

