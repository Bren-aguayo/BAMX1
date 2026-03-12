<x-app-layout>

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning mt-3">
        {{ session('warning') }}
    </div>
@endif

<div class="major container mt-4" style="background-color:white;">
    <h2 class="text-center">Registrar entrega de despensas</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('entregadespensas.store') }}" method="post">
        @csrf
        @include('entregadespensas.form-fields')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a href="{{ route('entregadespensas.index') }}" class="btn btn-secondary">
                Mostrar entregas
            </a>
        </div>
    </form>
</div>

<!-- PASAMOS VOLUNTARIOS A JS -->
<script>
    window.voluntarios = @json($volunteers);
</script>

</x-app-layout>