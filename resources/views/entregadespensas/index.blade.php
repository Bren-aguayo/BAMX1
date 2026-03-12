<x-app-layout>
    <br>
    <div class="container">

        <h2 class="mb-4">Lista de entrega de despensa</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Responsable</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entregadespensas as $entregadespensa)
                        <tr>
                            <td>{{ $entregadespensa->id }}</td>

                            <td>
                                @if(optional($entregadespensa->volunteer)->foto)
                                    <img 
                                        src="{{ asset('storage/' . $entregadespensa->volunteer->foto) }}"
                                        alt="Foto de {{ optional($entregadespensa->volunteer)->nombre_completo }}"
                                        style="width: 65px; height: 65px; object-fit: cover; border-radius: 10px; border: 2px solid orange;"
                                    >
                                @else
                                    <span class="text-muted">Sin foto</span>
                                @endif
                            </td>

                            <td>
                                {{ optional($entregadespensa->volunteer)->nombre_completo ?? 'Sin nombre' }}
                                (#{{ $entregadespensa->volunteer_id }})
                            </td>

                            <td>
                                {{ optional(optional($entregadespensa->volunteer)->area)->nombre ?? 'Sin área' }}
                            </td>

                            <td>{{ \Carbon\Carbon::parse($entregadespensa->fecha)->format('d/m/Y') }}</td>
                            <td>Despensa del día</td>
                            <td>{{ $entregadespensa->responsable }}</td>

                            <td>
                                <a href="{{ route('entregadespensas.edit', $entregadespensa) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('entregadespensas.destroy', $entregadespensa) }}"
                                      method="post"
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta entrega?')">
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
                            <td colspan="9" class="text-center">No hay entregas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-end">
            <a href="{{ route('entregadespensas.create') }}" class="btn btn-success">
                + Registrar nueva entrega
            </a>
        </div>

    </div>
</x-app-layout>

