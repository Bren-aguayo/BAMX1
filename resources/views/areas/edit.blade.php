<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar áreas</h2>
        <form action="{{ route('areas.update', $area) }}" method="post">
            @csrf 
            @method('PATCH')
            @include('areas.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('areas.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>