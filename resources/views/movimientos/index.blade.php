<x-app-layout>
    <br>
    <div class="major container">
  <h2>Lista de movimiento de personal</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                        Id</th>
                        <th>Nombre</th>
                        <th>Área de salida</th>
                        <th>Área de entrada</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
              
                    @foreach ($movimientos as $movimiento)
                        <tr>
                             <td>{{ $movimiento->id }}</td>
                            <td>{{ $movimiento->registros->nombre }} (#{{ $movimiento->id_registro }})</td>
                            <td>{{ $movimiento->id_area_salidas->nombre }}</td>
                            <td>{{ $movimiento->id_area_entradas->nombre }}</td>
                            <td>{{ $movimiento->hora }}</td>
                            <td>{{ $movimiento->motivo }}</td>
                            <td>
                                <a href="{{ route('movimientos.edit', $movimiento) }}"
                                class="btn btn-outline-primary">Editar</a>
                            </td>
                            <td>


                                <form action="{{ route('movimientos.destroy', $movimiento) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('movimientos.create') }}" class="btn btn-secondary">Registrar movimeintos</a>
    </div>
</x-app-layout>