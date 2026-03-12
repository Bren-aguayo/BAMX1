<x-app-layout>
    <br>
    <div class="major container">
        <h2>Editar Voluntario</h2>

        <form action="{{ route('volunteers.update', $volunteer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('volunteers.form-fields')

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('volunteers.index') }}" class="btn btn-outline-secondary">
                    Regresar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>