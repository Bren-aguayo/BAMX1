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
</style>

<br>

<div class="container qr-container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <h2>Registro automático con QR</h2>

    <!-- ESCÁNER -->
    <div id="reader"></div>

    <br>

    <!-- INPUT MANUAL -->
    <div class="form-floating mb-3" style="max-width:300px; margin:auto;">
        <input type="number"
            class="form-control"
            id="id_manual"
            placeholder="ID del guardia">

        <label for="id_manual">Ingresar ID manual</label>
    </div>

    <form id="registroForm" action="{{ route('entradaguardia.registrar') }}" method="POST">
        @csrf
        <input type="hidden" name="id_guardia" id="id_guardia">
    </form>

</div>

@push('scripts')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

function registrar(id){
    document.getElementById('id_guardia').value = id;
    document.getElementById('registroForm').submit();
}

/* QR */
function onScanSuccess(qrCodeMessage){
    registrar(qrCodeMessage);
}

const html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps:10, qrbox:250 }
);

html5QrcodeScanner.render(onScanSuccess);


/* ID MANUAL */
document.getElementById('id_manual').addEventListener('change', function(){
    let id = this.value;

    if(id !== ''){
        registrar(id);
    }
});

</script>

@endpush

</x-app-layout>

