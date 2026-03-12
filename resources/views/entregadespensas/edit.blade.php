<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar entrega</h2>
        <form action="{{ route('entregadespensas.update', $entregadespensa) }}" method="post">
            @csrf
             @method('PATCH')
            @include('entregadespensas.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('entregadespensas.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>