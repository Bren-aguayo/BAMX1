<x-app-layout>
    <br>
    <div class="container">
        <h2>Historial de ingresos y salidas de guardias</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>ID Guardia</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Área</th>
                        <th>Fecha</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entradasguardias as $registro)
                        <tr>
                            <td>{{ $registro->id_guardia }}</td>
                            <td>{{ $registro->guardia->nombre ?? '' }}</td>
                            <td>{{ $registro->guardia->apellido ?? '' }}</td>
                            <td>{{ $registro->guardia->area ?? '' }}</td>
                            <td>{{ $registro->fecha }}</td>
                            <td>{{ $registro->hora_entrada }}</td>
                            <td>{{ $registro->hora_salida ?? 'No registrada' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No hay registros de ingresos y salidas de guardias.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('entradaguardia.create') }}" class="btn btn-primary">
            Registrar entrada / salida
        </a>
    </div>
</x-app-layout>

