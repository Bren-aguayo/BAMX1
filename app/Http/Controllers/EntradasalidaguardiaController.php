<?php

namespace App\Http\Controllers;

use App\Models\entradasalidaguardia;
use App\Http\Requests\StoreentradasalidaguardiaRequest;
use App\Http\Requests\UpdateentradasalidaguardiaRequest;
use Illuminate\Http\Request;

class EntradasalidaguardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradasguardias = entradasalidaguardia::with('guardia')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->get();

        return view('entradaguardia.index', compact('entradasguardias'));
    }

    /**
     * Muestra el formulario para registrar entrada o salida.
     */
    public function create()
    {
        return view('entradaguardia.create', ['entradasguardia' => new entradasalidaguardia()]);
    }

    /**
     * Registra la hora de entrada o salida.
     */
    public function registrarEntrada(Request $request)
    {
        $request->validate([
            'id_guardia' => 'required|exists:guardias,id',
        ]);

        $fechaHoy = now('America/Mexico_City')->toDateString();

        $registro = entradasalidaguardia::where('id_guardia', $request->id_guardia)
            ->where('fecha', $fechaHoy)
            ->first();

        if (!$registro) {
            entradasalidaguardia::create([
                'id_guardia' => $request->id_guardia,
                'hora_entrada' => now('America/Mexico_City')->format('H:i:s'),
                'fecha' => $fechaHoy,
            ]);

            return redirect()->back()->with('success', 'Entrada registrada.');
        }

        if (!$registro->hora_salida) {
            $registro->update([
                'hora_salida' => now('America/Mexico_City')->format('H:i:s'),
            ]);

            return redirect()->back()->with('success', 'Salida registrada.');
        }

        return redirect()->back()->with('info', 'Ya registraste entrada y salida hoy.');
    }

    /**
     * Elimina un registro.
     */
    public function destroy(entradasalidaguardia $entradasalidaguardia)
    {
        $entradasalidaguardia->delete();
        return redirect()->route('entradaguardia.index')->with('success', 'Registro eliminado.');
    }
}

