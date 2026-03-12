<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar voluntarios</h2>
        <br>
        <form action="{{ route('volunteers.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('volunteers.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('volunteers.index') }}" class="btn btn-secondary">Mostrar voluntarios</a>
            </div>
        </form>
    </div>
</x-app-layout>