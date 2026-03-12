<?php

namespace App\Http\Controllers;

use App\Models\guardia;
use App\Http\Requests\StoreguardiaRequest;
use App\Http\Requests\UpdateguardiaRequest;

class GuardiaController extends Controller
{
    public function index()
    {
        $guardias = guardia::all();
        return view('guardias.index', compact('guardias'));
    }

    public function create()
    {
        return view('guardias.create', ['guardia' => new guardia()]);
    }

    public function store(StoreguardiaRequest $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'area' => 'required'
        ]);

        guardia::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'area' => $request->area,
        ]);

        return to_route('guardias.index')->with('success', 'Registrado con éxito');
    }

    public function show(guardia $guardia)
    {
        //
    }

    public function edit(guardia $guardia)
    {
        return view('guardias.edit', compact('guardia'));
    }

    public function update(UpdateguardiaRequest $request, guardia $guardia)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'area' => 'required'
        ]);

        $guardia->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'area' => $request->area,
        ]);

        return to_route('guardias.index')->with('success', 'Actualizado con éxito');
    }

    public function destroy(guardia $guardia)
    {
        $guardia->delete();
        return to_route('guardias.index');
    }
}

