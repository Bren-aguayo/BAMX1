<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('anticipadas.update', $anticipada) }}" method="post">
            @csrf 
            @method('PATCH')
            @include('anticipadas.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('anticipadas.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>