<x-app-layout>
    <br>
    <div class="major container">

        <h2>Lista de restricciones de acceso</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-warning">
                {{ session('info') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Voluntario</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Tipo</th>
                        <th>Motivo</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Estatus</th>
                        @auth
                            @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                                <th>Editar</th>
                                <th>Eliminar</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bajas as $baja)
                        <tr>
                            <td>{{ $baja->id }}</td>

                            <td>{{ $baja->volunteer_id }}</td>

                            <td>{{ optional($baja->volunteer)->nombre_completo ?? 'Sin nombre' }}</td>

                            <td>{{ optional(optional($baja->volunteer)->area)->nombre ?? 'Sin área' }}</td>

                            <td>
                                @if($baja->tipo === 'definitiva')
                                    <span class="badge bg-danger">Baja definitiva</span>
                                @elseif($baja->tipo === 'temporal')
                                    <span class="badge bg-warning text-dark">Suspensión temporal</span>
                                @else
                                    <span class="badge bg-secondary">Sin definir</span>
                                @endif
                            </td>

                            <td>{{ $baja->motivo }}</td>

                            <td>
                                {{ $baja->fecha_inicio ? $baja->fecha_inicio->format('d/m/Y') : 'N/A' }}
                            </td>

                            <td>
                                {{ $baja->fecha_fin ? $baja->fecha_fin->format('d/m/Y') : 'Indefinida' }}
                            </td>

                            <td>
                                @if($baja->estaActiva())
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-secondary">Vencida</span>
                                @endif
                            </td>

                            @auth
                                @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                                    <td>
                                        <a href="{{ route('bajas.edit', $baja) }}" class="btn btn-outline-primary btn-sm">
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('bajas.destroy', $baja) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta restricción?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No hay restricciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @auth
            @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                <a href="{{ route('bajas.create') }}" class="btn btn-danger mt-3">
                    Registrar nueva restricción
                </a>
            @endif
        @endauth

    </div>
</x-app-layout>

