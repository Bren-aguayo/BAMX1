<x-app-layout>
    <br>
    <div class="major container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h2>Lista de incidentes</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Encargado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidentes as $incidente)
                        <tr>
                            <td>{{ $incidente->id }}</td>

                            <td>
                                @if(optional($incidente->volunteer)->foto)
                                    <img
                                        src="{{ asset('storage/' . $incidente->volunteer->foto) }}"
                                        alt="Foto de {{ optional($incidente->volunteer)->nombre_completo }}"
                                        style="width: 65px; height: 65px; object-fit: cover; border-radius: 10px; border: 2px solid orange;"
                                    >
                                @else
                                    <span class="text-muted">Sin foto</span>
                                @endif
                            </td>

                            <td>
                                {{ optional($incidente->volunteer)->nombre_completo ?? 'Sin nombre' }}
                                <br>
                                <small class="text-muted">(#{{ $incidente->id_registro }})</small>
                            </td>

                            <td>
                                {{ optional(optional($incidente->volunteer)->area)->nombre ?? 'Sin área' }}
                            </td>

                            <td>{{ $incidente->motivo }}</td>
                            <td>{{ $incidente->fecha }}</td>
                            <td>{{ $incidente->hora }}</td>
                            <td>{{ $incidente->encargado }}</td>

                            <td>
                                <a href="{{ route('incidentes.edit', $incidente) }}" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('incidentes.destroy', $incidente) }}" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este incidente?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                No hay incidentes registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('incidentes.create') }}" class="btn btn-secondary mt-3">
            Registrar incidente
        </a>
    </div>
</x-app-layout>

