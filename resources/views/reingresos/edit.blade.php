<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar reingresos</h2>
        <form action="{{ route('reingresos.update', $reingreso) }}" method="post">
            @csrf @method('PATCH')
            @include('reingresos.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('reingresos.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>