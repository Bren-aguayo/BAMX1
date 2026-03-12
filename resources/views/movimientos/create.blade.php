<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar Movimientos</h2>
        <br>
        <form action="{{ route('movimientos.store') }}" method="post">
            @csrf
            @include('movimientos.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Mostrar movimientos</a>
            </div>
        </form>
    </div>
</x-app-layout>