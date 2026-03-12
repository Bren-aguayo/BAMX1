<x-app-layout>
    <br>
    <div class="major container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h2>Lista de horas extras</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Horas Extras</th>
                        <th>Pago Extra</th>
                        <th>Motivo</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Fecha entrega</th>
                        <th>Hora entrega</th>
                        <th>Resp. entrega</th>
                        <th>Entregar</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($extras as $extra)
                        <tr class="{{ $extra->estado_entrega === 'entregado' ? 'table-success' : '' }}">
                            <td>{{ $extra->id }}</td>

                            <td>
                                @if(optional($extra->volunteer)->foto)
                                    <img
                                        src="{{ asset('storage/' . $extra->volunteer->foto) }}"
                                        alt="Foto de {{ optional($extra->volunteer)->nombre_completo }}"
                                        style="width: 65px; height: 65px; object-fit: cover; border-radius: 10px; border: 2px solid orange;"
                                    >
                                @else
                                    <span class="text-muted">Sin foto</span>
                                @endif
                            </td>

                            <td>
                                {{ optional($extra->volunteer)->nombre_completo ?? 'Sin nombre' }}
                                <br>
                                <small class="text-muted">(#{{ $extra->id_registro }})</small>
                            </td>

                            <td>
                                {{ optional(optional($extra->volunteer)->area)->nombre ?? 'Sin área' }}
                            </td>

                            <td>{{ $extra->entrada }}</td>
                            <td>{{ $extra->salida ?? 'Pendiente' }}</td>
                            <td>{{ $extra->horas_extra }}</td>
                            <td>${{ number_format($extra->pago_extra, 2) }}</td>
                            <td>{{ $extra->motivo }}</td>
                            <td>{{ $extra->encargado }}</td>

                            <td>
                                @if($extra->estado_entrega === 'entregado')
                                    <span class="badge bg-success">Entregado</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @endif
                            </td>

                            <td>{{ $extra->fecha_entrega ?? '—' }}</td>
                            <td>{{ $extra->hora_entrega ?? '—' }}</td>
                            <td>{{ $extra->responsable_entrega ?? '—' }}</td>

                            <td>
                                @if($extra->estado_entrega !== 'entregado')
                                    <form action="{{ route('extras.entregar', $extra) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <select name="responsable_entrega" class="form-select form-select-sm mb-2" required>
                                            <option value="" disabled selected>Responsable</option>
                                            <option value="Claudia González">Claudia González</option>
                                            <option value="Brenda González">Brenda González</option>
                                            <option value="Jazmin Rios">Jazmin Rios</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Guardia">Guardia</option>
                                            <option value="Apoyo">Apoyo</option>
                                        </select>

                                        <button type="submit" class="btn btn-success btn-sm">
                                            Marcar entregado
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success fw-bold">✔ Entregado</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('extras.edit', $extra) }}" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('extras.destroy', $extra) }}" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="17" class="text-center text-muted">
                                No hay horas extras registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="6" class="text-end">Totales:</th>
                        <th>{{ $totalHoras }}</th>
                        <th>${{ number_format($totalPago, 2) }}</th>
                        <th colspan="9"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4">
            <h4>Resumen de despensas del día</h4>

            @php
                $valoresDespensas = range(25, 400, 25);

                $resumenDespensas = [];
                foreach ($valoresDespensas as $valor) {
                    $resumenDespensas[$valor] = 0;
                }

                foreach ($extras as $extra) {
                    $monto = $extra->horas_extra * 25;

                    if (in_array($monto, $valoresDespensas)) {
                        $resumenDespensas[$monto]++;
                    }
                }

                $totalGeneral = array_sum($resumenDespensas);
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead>
                        <tr>
                            @foreach($valoresDespensas as $valor)
                                <th>${{ $valor }}</th>
                            @endforeach
                            <th>Total general</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($valoresDespensas as $valor)
                                <td>{{ $resumenDespensas[$valor] }}</td>
                            @endforeach
                            <td><strong>{{ $totalGeneral }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('extras.create') }}" class="btn btn-secondary mt-3">
            Registrar horas extras
        </a>
    </div>
</x-app-layout>

