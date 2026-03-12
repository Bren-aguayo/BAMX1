<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();

        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('areas.create', ['area' => new area() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
      $request -> validate([
       'nombre'=>['required','min:2'],
        'cantidad_minima'=>['required','min:1'],
        'cantidad_maxima'=>['required','min:1'],
        'gerente'=>['required','min:1'],
        'encargado'=>['required','min:1'],
      ]);

      area::create($request->all());

      return to_route('areas.index')->with('success','area agregada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(area $area)
    {
        return view('areas.edit',compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, area $area)
    {
        $request->validate([
           'nombre'=>['required','min:2'],
        'cantidad_minima'=>['required','min:1'],
        'cantidad_maxima'=>['required','min:1'],
        'gerente'=>['required','min:1'],
        'encargado'=>['required','min:1'],
      ]);

      $area->update($request->all());

      return to_route('areas.index')->with('success','actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(area $area)
    {
        $area->delete();
        return to_route('areas.index');
    }
}
