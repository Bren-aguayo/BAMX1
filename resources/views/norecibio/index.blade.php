<x-app-layout>
    <br>
    <div class="major container">
  <h2>Lista de personas que no recibieron depensa</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                        Id</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
              
                    @foreach ($norecibios as $norecibio)
                        <tr>
                             <td>{{ $norecibio->id }}</td>
                            <td>{{ $norecibio->registros->nombre }}(#{{ $norecibio->id_registro }})</td>
                            <td>{{ $norecibio->fecha }}</td>
                            <td>{{ $norecibio->concepto }}</td>
                        
                            <td>
                                <a href="{{ route('norecibio.edit', $norecibio) }}"
                                class="btn btn-outline-primary">Editar</a>
                            </td>
                            <td>


                                <form action="{{ route('norecibio.destroy', $norecibio) }}" method="post">
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
        <a href="{{ route('norecibio.create') }}" class="btn btn-secondary">Registrar personas que no recibieron</a>
    </div>
</x-app-layout>