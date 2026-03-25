<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Editar restricción</h2>
        <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bajas.update', $baja) }}" method="POST">
            @csrf
            @method('PATCH')

            @include('bajas.form-fields')

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('bajas.index') }}" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>

