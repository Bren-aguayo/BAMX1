<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('movimientos.update', $movimiento) }}" method="post">
            @csrf @method('PATCH')
            @include('movimientos.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('movimientos.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>