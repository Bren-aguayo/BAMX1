<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use App\Models\ingreso_salida;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function index()
    {
        $extras = Extra::with('volunteer.area')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalHoras = $extras->sum('horas_extra');
        $totalPago  = $extras->sum('pago_extra');

        return view('extras.index', compact('extras', 'totalHoras', 'totalPago'));
    }

    public function create()
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('extras.create', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_registro' => ['required', 'exists:volunteers,id'],
            'motivo'      => ['required', 'string'],
            'encargado'   => ['required', 'string'],
        ]);

        $fechaHoy = now('America/Mexico_City')->toDateString();
        $horaActual = now('America/Mexico_City')->format('H:i:s');

        $volunteer = Volunteer::with('area')->find($request->id_registro);

        if (!$volunteer) {
            return back()->with('error', 'Voluntario no encontrado.');
        }

        // Verificar que trabajó hoy en ingreso/salida normal
        $registroTrabajo = ingreso_salida::where('id_registro', $request->id_registro)
            ->where('fecha', $fechaHoy)
            ->whereNotNull('hora_entrada')
            ->first();

        if (!$registroTrabajo) {
            return back()
                ->with('error', 'Este voluntario no trabajó hoy, no puede registrar horas extras.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
        }

        // Buscar registro de extras del día
        $extraHoy = Extra::where('id_registro', $request->id_registro)
            ->whereDate('created_at', $fechaHoy)
            ->first();

        // PRIMER ESCANEO -> registrar entrada automática
        if (!$extraHoy) {
            Extra::create([
                'id_registro'         => $request->id_registro,
                'entrada'             => $horaActual,
                'salida'              => null,
                'motivo'              => $request->motivo,
                'encargado'           => $request->encargado,
                'horas_extra'         => 0,
                'pago_extra'          => 0,
                'estado_entrega'      => 'pendiente',
                'fecha_entrega'       => null,
                'hora_entrega'        => null,
                'responsable_entrega' => null,
            ]);

            return redirect()
                ->route('extras.create')
                ->with('success', 'Entrada a horas extra registrada correctamente.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
        }

        // SEGUNDO ESCANEO -> registrar salida automática
        if (!$extraHoy->salida) {
            $horaEntrada = strtotime($extraHoy->entrada);
            $horaSalida  = strtotime($horaActual);

            $segundos = $horaSalida - $horaEntrada;
            $horasExtras = max(1, ceil($segundos / 3600));
            $pagoExtra = $horasExtras * 25;

            $extraHoy->update([
                'salida'      => $horaActual,
                'horas_extra' => $horasExtras,
                'pago_extra'  => $pagoExtra,
            ]);

            return redirect()
                ->route('extras.create')
                ->with('success', 'Salida de horas extra registrada correctamente.')
                ->with('nombre', $volunteer->nombre_completo)
                ->with('area', $volunteer->area->nombre ?? 'Sin área')
                ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
        }

        // Ya tiene entrada y salida
        return redirect()
            ->route('extras.create')
            ->with('info', 'Este voluntario ya registró entrada y salida de horas extra el día de hoy.')
            ->with('nombre', $volunteer->nombre_completo)
            ->with('area', $volunteer->area->nombre ?? 'Sin área')
            ->with('foto', $volunteer->foto ? asset('storage/' . $volunteer->foto) : null);
    }

    public function edit(Extra $extra)
    {
        $volunteers = Volunteer::with('area')
            ->select('id', 'nombre_completo', 'foto', 'area_id')
            ->orderBy('nombre_completo')
            ->get();

        return view('extras.edit', compact('extra', 'volunteers'));
    }

    public function update(Request $request, Extra $extra)
    {
        $request->validate([
            'id_registro' => ['required', 'exists:volunteers,id'],
            'motivo'      => ['required', 'string'],
            'encargado'   => ['required', 'string'],
        ]);

        $horaEntrada = $extra->entrada ? strtotime($extra->entrada) : null;
        $horaSalida  = $extra->salida ? strtotime($extra->salida) : null;

        $horasExtras = 0;
        $pagoExtra = 0;

        if ($horaEntrada && $horaSalida) {
            $horasExtras = max(1, ceil(($horaSalida - $horaEntrada) / 3600));
            $pagoExtra = $horasExtras * 25;
        }

        $extra->update([
            'id_registro' => $request->id_registro,
            'motivo'      => $request->motivo,
            'encargado'   => $request->encargado,
            'horas_extra' => $horasExtras,
            'pago_extra'  => $pagoExtra,
        ]);

        return to_route('extras.index')
            ->with('success', 'Registro de horas extra editado con éxito');
    }

    public function marcarEntregado(Request $request, Extra $extra)
    {
        $request->validate([
            'responsable_entrega' => ['required', 'string'],
        ]);

        if ($extra->estado_entrega === 'entregado') {
            return back()->with('info', 'Este registro ya estaba marcado como entregado.');
        }

        $extra->update([
            'estado_entrega'      => 'entregado',
            'fecha_entrega'       => now('America/Mexico_City')->toDateString(),
            'hora_entrega'        => now('America/Mexico_City')->format('H:i:s'),
            'responsable_entrega' => $request->responsable_entrega,
        ]);

        return back()->with('success', 'Extra marcado como entregado correctamente.');
    }

    public function destroy(Extra $extra)
    {
        $extra->delete();

        return to_route('extras.index')
            ->with('success', 'Registro eliminado con éxito');
    }
}

