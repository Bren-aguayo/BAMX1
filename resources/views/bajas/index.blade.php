<x-app-layout>
    <br>
    <div class="major container">

        <h2>Lista de personas dadas de baja</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Baja</th>
                        <th>ID Voluntario</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Motivo</th>
                        @auth
                            @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                                <th>Editar</th>
                                <th>Eliminar</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bajas as $baja)
                        <tr>
                            <td>{{ $baja->id }}</td>

                            <td>
                                {{ $baja->volunteer_id }}
                            </td>

                            <td>
                                {{ optional($baja->volunteer)->nombre_completo ?? 'Sin nombre' }}
                            </td>

                            <td>
                                {{ optional($baja->volunteer->area)->nombre ?? 'Sin área' }}
                            </td>

                            <td>
                                {{ $baja->motivo }}
                            </td>

                            @auth
                                @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                                    <td>
                                        <a href="{{ route('bajas.edit', $baja) }}" class="btn btn-outline-primary btn-sm">
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('bajas.destroy', $baja) }}" method="POST">
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
                    @endforeach
                </tbody>
            </table>
        </div>

        @auth
            @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                <a href="{{ route('bajas.create') }}" class="btn btn-danger mt-3">
                    Registrar nueva baja
                </a>
            @endif
        @endauth

    </div>
</x-app-layout>

