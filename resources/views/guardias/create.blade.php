<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar Guardias</h2>
        <br>
        <form action="{{ route('guardias.store') }}" method="post">
            @csrf
            @include('guardias.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('guardias.index') }}" class="btn btn-secondary">Mostrar Guardias</a>
            </div>
        </form>
    </div>
</x-app-layout>

