<?php

namespace App\Http\Controllers;

use App\Models\movimiento;
use App\Models\registro;
use App\Models\area;
use App\Http\Requests\StoremovimientoRequest;
use App\Http\Requests\UpdatemovimientoRequest;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Http\Request;
class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movimientos= movimiento::with('registros', 'id_area_salidas', 'id_area_entradas')->get();
        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registros= registro::all();
        $areas= area::all();
        return view('movimientos.create', compact('registros','areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremovimientoRequest $request)
    {
        $request->validate([
            'id_registro'=>['required', 'exists:registros,id'],
            'hora'=>['required'],
            'id_area_salida'=>['required','exists:areas,id'],
            'id_area_entrada'=>['required','exists:areas,id'],
            'motivo'=>['required'],
        ]);

        movimiento::create($request->all());

        return to_route('movimientos.index')->with('success','registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(movimiento $movimiento)
    {
        $registros= registro::all();
        $areas= area::all();
        return view('movimientos.edit', compact('movimiento', 'registros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemovimientoRequest $request, movimiento $movimiento)
    {
        $request->validate([
            'id_registro'=>['required', 'exists:registros,id'],
            'hora'=>['required'],
            'id_area_salida'=>['required','exists:areas,id'],
            'id_area_entrada'=>['required','exists:areas,id'],
            'motivo'=>['required'],
        ]);

        $movimiento->update($request->all());

        return to_route('movimientos.index')->with('success','registrado con exito');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(movimiento $movimiento)
    {
        $movimiento->delete();
        return to_route('movimientos.index');
    }
}
