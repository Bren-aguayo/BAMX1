<x-app-layout>
    <br>
    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar Reingresos</h2>
        <br>
        <form action="{{ route('reingresos.store') }}" method="post">
            @csrf
            @include('reingresos.form-fields')
            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('reingresos.index') }}" class="btn btn-secondary">Mostrar Reingresos</a>
            </div>
        </form>
    </div>
</x-app-layout>