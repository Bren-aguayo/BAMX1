<x-app-layout>
    <br>
    <div class="major container">

  <h2>Lista de reingresos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                        Id</th>
                        <th>Nombre</th>
                        <th>Concepto</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                
              
                    @foreach ($reingresos as $reingreso)
                        <tr>
                             <td>{{ $reingreso->id }}</td>
                            <td>{{ $reingreso->registros->nombre }}(#{{$reingreso->id_registro  }})</td>
                            <td>{{ $reingreso->concepto }}</td>
                            
                            <td>
                                  @auth
                @if (Auth::user()->rol === 'administracion' || Auth::user()->rol === 'gerente')
                                <a href="{{ route('reingresos.edit', $reingreso) }}"
                                class="btn btn-outline-primary">Editar</a>
                            </td>
                            <td>


                                <form action="{{ route('reingresos.destroy', $reingreso) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>

                            </td>
                            @endauth
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('reingresos.create') }}" class="btn btn-secondary">Registrar reingresos</a>
    </div>
</x-app-layout>