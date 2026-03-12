<?php

namespace App\Http\Controllers;

use App\Models\Anticipada;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class AnticipadaController extends Controller
{
    public function index()
    {
        $anticipadas = Anticipada::with('volunteer')->get();
        return view('anticipadas.index', compact('anticipadas'));
    }

    public function create()
    {
        $volunteers = Volunteer::all();
        return view('anticipadas.create', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_registro' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required'],
            'encargado' => ['required'],
        ]);

        Anticipada::create([
            'id_registro' => $request->id_registro,
            'hora' => now('America/Mexico_City')->format('H:i:s'),
            'fecha' => now('America/Mexico_City')->toDateString(),
            'motivo' => $request->motivo,
            'encargado' => $request->encargado,
        ]);

        return redirect()
            ->route('anticipadas.create')
            ->with('success', 'Salida anticipada registrada correctamente');
    }

    public function edit(Anticipada $anticipada)
    {
        $volunteers = Volunteer::all();
        return view('anticipadas.edit', compact('anticipada', 'volunteers'));
    }

    public function update(Request $request, Anticipada $anticipada)
    {
        $request->validate([
            'id_registro' => ['required', 'exists:volunteers,id'],
            'motivo' => ['required'],
            'encargado' => ['required'],
        ]);

        $anticipada->update([
            'id_registro' => $request->id_registro,
            'motivo' => $request->motivo,
            'encargado' => $request->encargado,
        ]);

        return redirect()
            ->route('anticipadas.index')
            ->with('success', 'Salida anticipada editada con éxito');
    }

    public function destroy(Anticipada $anticipada)
    {
        $anticipada->delete();
        return redirect()->route('anticipadas.index');
    }
}

