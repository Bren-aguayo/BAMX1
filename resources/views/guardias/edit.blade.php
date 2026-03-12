<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('guardias.update', $guardia) }}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            @include('guardias.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('guardias.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>