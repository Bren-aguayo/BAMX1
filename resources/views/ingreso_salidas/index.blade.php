<x-app-layout>

<div class="container mt-4">
    <h2 class="mb-4">Historial de ingresos y salidas</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            
            <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Empleado</th>
                    <th>Área</th>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($ingreso_salidas as $registro)
                    <tr>
                        <td>{{ $registro->id }}</td>

                        <td class="text-center">
                            @if($registro->volunteer && $registro->volunteer->foto)
                                <img src="{{ asset('storage/' . $registro->volunteer->foto) }}"
                                     alt="Foto"
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                                <span class="text-muted">Sin foto</span>
                            @endif
                        </td>

                        <td>
                            {{ $registro->volunteer->nombre_completo ?? 'Sin nombre' }}
                            <small class="text-muted">
                                (#{{ $registro->id_registro }})
                            </small>
                        </td>

                        <td>
                            {{ $registro->volunteer->area->nombre ?? 'Sin área' }}
                        </td>

                        <td>{{ $registro->fecha }}</td>
                        <td>{{ $registro->hora_entrada }}</td>
                        <td>{{ $registro->hora_salida ?? 'No registrada' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No hay registros disponibles
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

</x-app-layout>

