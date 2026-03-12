<x-app-layout>
    <br>
    <div class="major container" style="background-color: white; padding: 20px; border-radius: 10px;">
        <h2 style="text-align:center">Editar salida / registrar reingreso</h2>
        <br>

        <form action="{{ route('permitidas.update', $permitida) }}" method="POST">
            @csrf
            @method('PATCH')

            @include('permitidas.form-fields')

            <div style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('permitidas.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>

