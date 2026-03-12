<?php

namespace App\Http\Controllers;

use App\Models\reingreso;
use App\Models\registro;
use App\Http\Requests\StorereingresoRequest;
use App\Http\Requests\UpdatereingresoRequest;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Http\Request;
class ReingresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reingresos=reingreso::with('registros')->get();
        return view ('reingresos.index', compact('reingresos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registros = registro::all();
        return view('reingresos.create',compact('registros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorereingresoRequest $request)
    {
        $request->validate([
            'id_registro'=>['required','exists:registros,id'],
            'concepto'=>['required'],
        ]);

        reingreso::create($request->all());

        return to_route('reingresos.index')->with('success','registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(reingreso $reingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reingreso $reingreso)
    {
        $registros = registro::all();
        return view('reingresos.edit', compact('reingreso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereingresoRequest $request, reingreso $reingreso)
    {
       $request->validate([
            'id_registro'=>['required','exists:registros,id'],
            'concepto'=>['required'],
        ]);

        $reingreso->update($request->all());

        return to_route('reingresos.index')->with('success','editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reingreso $reingreso)
    {
        $reingreso->delete();
        return to_route('reingreso.index');
    }
}
