<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class IncidenteController extends Controller
{
    public function index()
    {
        $incidentes = Incidente::with('volunteer.area')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        return view('incidentes.index', compact('incidentes'));
    }

    public function create()
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('incidentes.create', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required', 'string'],
            'encargado' => ['required', 'string'],
        ]);

        $volunteer = Volunteer::with('area')->find($request->volunteer_id);

        Incidente::create([
            'volunteer_id' => $request->volunteer_id,
            'motivo' => $request->motivo,
            'fecha' => now('America/Mexico_City')->format('Y-m-d'),
            'hora' => now('America/Mexico_City')->format('H:i:s'),
            'encargado' => $request->encargado,
        ]);

        return redirect()
            ->route('incidentes.create')
            ->with('success', 'Incidente registrado con éxito.')
            ->with('nombre', $volunteer->nombre_completo)
            ->with('area', $volunteer->area->nombre ?? 'Sin área')
            ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
    }

    public function edit(Incidente $incidente)
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('incidentes.edit', compact('incidente', 'volunteers'));
    }

    public function update(Request $request, Incidente $incidente)
    {
        $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required', 'string'],
            'encargado' => ['required', 'string'],
        ]);

        $incidente->update([
            'volunteer_id' => $request->volunteer_id,
            'motivo' => $request->motivo,
            'encargado' => $request->encargado,
        ]);

        return to_route('incidentes.index')
            ->with('success', 'Incidente editado con éxito.');
    }

    public function destroy(Incidente $incidente)
    {
        $incidente->delete();

        return to_route('incidentes.index')->with('success', 'Incidente eliminado.');
    }
}

