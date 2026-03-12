<x-app-layout>

<style>
    #reader {
        width: 300px;
        height: 300px;
        border: 3px solid orange;
        border-radius: 10px;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
        background-color: #fff;
    }

    .qr-container {
        text-align: center;
        padding: 20px;
    }

    h2 {
        color: #ff8c00;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .foto-verificacion {
        max-width: 220px;
        max-height: 220px;
        object-fit: cover;
        border-radius: 12px;
        border: 4px solid #ffc107;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .card-identidad {
        max-width: 400px;
        margin: 20px auto;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>

<div class="container mt-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ALERTAS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TARJETA DE VERIFICACIÓN --}}
    @if (session('nombre'))
        <div class="card card-identidad text-center p-3">
            @if (session('foto'))
                <div class="mb-3">
                    <img src="{{ session('foto') }}" alt="Foto del voluntario" class="foto-verificacion">
                </div>
            @endif

            <h4 class="mb-1">{{ session('nombre') }}</h4>
            <p class="text-muted mb-0">
                <strong>Área:</strong> {{ session('area') ?? 'Sin área' }}
            </p>
        </div>
    @endif

    <div class="qr-container">
        <h2>Registro automático con QR</h2>

        {{-- LECTOR QR --}}
        <div id="reader"></div>

        {{-- FORM OCULTO PARA QR --}}
        <form id="registroForm" action="{{ route('ingreso_salidas.entrada') }}" method="POST">
            @csrf
            <input type="hidden" name="id_registro" id="id_registro">
        </form>

        <p class="mt-3 fw-semibold text-muted">— o —</p>

        {{-- FORM MANUAL --}}
        <form action="{{ route('ingreso_salidas.entrada') }}" method="POST" class="mt-3">
            @csrf

            <label class="form-label">Ingresar matrícula manual</label>
            <input
                type="text"
                name="id_registro"
                class="form-control text-center"
                placeholder="Ej. 123"
                required
            >

            <button type="submit" class="btn btn-warning mt-3 w-100">
                Registrar
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(qrCodeMessage) {
        document.getElementById('id_registro').value = qrCodeMessage;
        document.getElementById('registroForm').submit();
    }

    const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250
    });

    html5QrcodeScanner.render(onScanSuccess);
</script>
@endpush

</x-app-layout>

