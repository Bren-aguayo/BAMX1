<x-app-layout>
    <br>

    <style>
        #reader {
            width: 300px;
            margin: 0 auto;
            border: 3px solid orange;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }

        .card-validacion {
            max-width: 420px;
            margin: 20px auto;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.10);
            border: none;
        }

        .foto-voluntario {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            border: 4px solid #f59e0b;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
    </style>

    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar incidente</h2>
        <br>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('nombre'))
            <div class="card card-validacion text-center p-3 mb-4">
                @if(session('foto'))
                    <div class="mb-3">
                        <img src="{{ session('foto') }}" alt="Foto del voluntario" class="foto-voluntario">
                    </div>
                @endif

                <h4 class="mb-1">{{ session('nombre') }}</h4>
                <p class="text-muted mb-0">
                    <strong>Área:</strong> {{ session('area') ?? 'Sin área' }}
                </p>
            </div>
        @endif

        <form action="{{ route('incidentes.store') }}" method="post">
            @csrf
            @include('incidentes.form-fields')

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('incidentes.index') }}" class="btn btn-secondary">Mostrar incidentes</a>
            </div>
        </form>
    </div>

    <script>
        window.voluntarios = @json($volunteers);
    </script>
</x-app-layout>

