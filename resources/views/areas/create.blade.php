<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar areas</h2>
        <br>
        <form action="{{ route('areas.store') }}" method="post">
            @csrf
            @include('areas.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('areas.index') }}" class="btn btn-secondary">Mostrar areas</a>
            </div>
        </form>
    </div>
</x-app-layout>