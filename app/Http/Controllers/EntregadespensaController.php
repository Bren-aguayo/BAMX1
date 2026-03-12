<?php

namespace App\Http\Controllers;

use App\Models\Entregadespensa;
use App\Models\Volunteer;
use App\Models\ingreso_salida;
use Illuminate\Http\Request;

class EntregadespensaController extends Controller
{
    public function index()
    {
        $entregadespensas = Entregadespensa::with('volunteer.area')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        return view('entregadespensas.index', compact('entregadespensas'));
    }

    public function create()
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('entregadespensas.create', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'responsable' => ['required', 'string'],
        ]);

        $volunteer = Volunteer::with('area')->find($request->volunteer_id);

        if (!$volunteer) {
            return redirect()
                ->route('entregadespensas.create')
                ->with('error', 'Voluntario no encontrado.');
        }

        // Verificar que trabajó hoy
        $trabajoHoy = ingreso_salida::where('id_registro', $request->volunteer_id)
            ->whereDate('fecha', $request->fecha)
            ->whereNotNull('hora_entrada')
            ->exists();

        if (!$trabajoHoy) {
            return redirect()
                ->route('entregadespensas.create')
                ->with('error', '❌ Este voluntario no trabajó hoy. No puede recibir despensa.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
        }

        // Verificar que no haya recibido despensa hoy
        $yaRecibio = Entregadespensa::where('volunteer_id', $request->volunteer_id)
            ->whereDate('fecha', $request->fecha)
            ->exists();

        if ($yaRecibio) {
            return redirect()
                ->route('entregadespensas.create')
                ->with('warning', '⚠️ Este voluntario ya recibió despensa hoy.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
        }

        // Guardar entrega
        Entregadespensa::create([
            'volunteer_id' => $request->volunteer_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'cantidad' => 1,
            'responsable' => $request->responsable,
        ]);

        return redirect()
            ->route('entregadespensas.create')
            ->with('success', '✅ Entrega registrada correctamente.')
            ->with('nombre', $volunteer->nombre_completo)
            ->with('area', $volunteer->area->nombre ?? 'Sin área')
            ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
    }

    public function edit(Entregadespensa $entregadespensa)
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('entregadespensas.edit', compact('entregadespensa', 'volunteers'));
    }

    public function update(Request $request, Entregadespensa $entregadespensa)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'responsable' => ['required', 'string'],
        ]);

        $entregadespensa->update([
            'volunteer_id' => $request->volunteer_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'cantidad' => 1,
            'responsable' => $request->responsable,
        ]);

        return redirect()
            ->route('entregadespensas.index')
            ->with('success', 'Entrega actualizada correctamente.');
    }

    public function destroy(Entregadespensa $entregadespensa)
    {
        $entregadespensa->delete();

        return redirect()
            ->route('entregadespensas.index')
            ->with('success', 'Entrega eliminada correctamente.');
    }
}

