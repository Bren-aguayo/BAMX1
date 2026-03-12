<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar salidas anticipadas</h2>
        <br>
        <form action="{{ route('anticipadas.store') }}" method="post">
            @csrf
            @include('anticipadas.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('anticipadas.index') }}" class="btn btn-secondary">Mostrar salidas anticipadas</a>
            </div>
        </form>
    </div>
</x-app-layout>