<x-app-layout>

<div class="container mt-4">
    <h2 class="mb-4">Historial de salidas permitidas y reingresos</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">

            <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Voluntario</th>
                    <th>Área</th>
                    <th>Fecha</th>
                    <th>Hora de salida</th>
                    <th>Motivo</th>
                    <th>Encargado salida</th>
                    <th>Hora de reingreso</th>
                    <th>Encargado reingreso</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($permitidas as $registro)
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
                                (#{{ $registro->volunteer_id }})
                            </small>
                        </td>

                        <td>
                            {{ $registro->volunteer->area->nombre ?? 'Sin área' }}
                        </td>

                        <td>{{ $registro->fecha }}</td>
                        <td>{{ $registro->hora_salida }}</td>
                        <td>{{ $registro->motivo }}</td>
                        <td>{{ $registro->encargado_salida }}</td>
                        <td>{{ $registro->hora_reingreso ?? 'No registrado' }}</td>
                        <td>{{ $registro->encargado_reingreso ?? 'No registrado' }}</td>
                        <td>
                            @if($registro->estado == 'fuera')
                                <span class="badge bg-warning text-dark">Fuera</span>
                            @else
                                <span class="badge bg-success">Reingresó</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">
                            No hay registros disponibles
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

</x-app-layout>

