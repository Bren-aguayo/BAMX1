<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar personas que no recibieron </h2>
        <br>
        <form action="{{ route('norecibio.store') }}" method="post">
            @csrf
            @include('norecibio.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('norecibio.index') }}" class="btn btn-secondary">Mostrar personas que no recibieron</a>
            </div>
        </form>
    </div>
</x-app-layout>