<x-app-layout>
    <br>
    <div class="major container">

        <h2>Lista de Guardias</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Área</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guardias as $guardia)
                        <tr>
                            <td>{{ $guardia->id }}</td>
                            <td>{{ $guardia->nombre }}</td>
                            <td>{{ $guardia->apellido }}</td>
                            <td>{{ $guardia->area }}</td>
                            <td>
                                <a href="{{ route('guardias.edit', $guardia) }}"
                                   class="btn btn-outline-primary">
                                   Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('guardias.destroy', $guardia) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('¿Seguro que deseas eliminar este guardia?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No hay guardias registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('guardias.create') }}" class="btn btn-secondary">Registrar Guardia</a>
    </div>
</x-app-layout>

