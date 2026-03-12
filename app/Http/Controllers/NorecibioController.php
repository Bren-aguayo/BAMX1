<?php

namespace App\Http\Controllers;

use App\Models\norecibio;
use App\Models\registro;
use App\Http\Requests\StorenorecibioRequest;
use App\Http\Requests\UpdatenorecibioRequest;
use Illuminate\Http\Request;
class NorecibioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $norecibios=norecibio::with('registros')->get();

        return view('norecibio.index', compact('norecibios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registros= registro::all();
        return view ('norecibio.create', compact('registros') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenorecibioRequest $request)
    {
        $request ->validate([
                'id_registro'=>['required','exists:registros,id'],
                'fecha'=>['required'],
                'concepto'=>['required'],
        ]);

        norecibio::create($request->all());

        return to_route('norecibio.index')->with('success','registrado con exito');


    }

    /**
     * Display the specified resource.
     */
    public function show(norecibio $norecibio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(norecibio $norecibios)
    {
        return view('norecibio.edit', compact('norecibios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenorecibioRequest $request, norecibio $norecibios)
    {
            $request ->validate([
                'id_registro'=>['required','exists:registros,id'],
                'fecha'=>['required'],
                'concepto'=>['required'],
        ]);

        $norecibios->update($request->all());

        return to_route('norecibio.index')->with('success','registrado con exito');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(norecibio $norecibios)
    {
        $norecibios->delete();
        return to_route('norecibio.index');
    }
}
