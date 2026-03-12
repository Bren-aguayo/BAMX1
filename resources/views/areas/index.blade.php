<x-app-layout>
    <br>
    <div class="major container">

        <h2>Lista de Áreas</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Cantidad mínima</th>
                        <th>Cantidad máxima</th>
                        <th>Gerente</th>
                        <th>Encargado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->id }}</td>
                            <td>{{ $area->nombre }}</td>
                            <td>{{ $area->cantidad_minima }}</td>
                            <td>{{ $area->cantidad_maxima }}</td>
                            <td>{{ $area->gerente }}</td>
                            <td>{{ $area->encargado }}</td>
                            <td>
                                <a href="{{ route('areas.edit', $area) }}" class="btn btn-outline-primary">
                                    Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('areas.destroy', $area) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta área?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('areas.create') }}" class="btn btn-secondary">Registrar área</a>
    </div>
</x-app-layout>