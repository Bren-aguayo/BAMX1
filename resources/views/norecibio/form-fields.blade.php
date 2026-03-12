{{-- ID REGISTRO --}}
<div class="form-floating mb-3">
    <select class="form-select" id="id_registro" name="id_registro" style="background-color: #E6E6FA;" >
        <option value="" disabled selected>Selecciona registro</option>
        @foreach ($registros as $registro)
            <option value="{{ $registro->id }}" 
                {{ old('id_registro', $norecibio->id_registro ?? '') == $registro->id ? 'selected' : '' }}>
                {{ $registro->nombre ?? 'Registro #' . $registro->id }}
            </option>
        @endforeach
    </select>
    <label for="id_registro">Registro</label>
</div>  <div> o utilice el QR </div>

<!-- Escáner QR -->
<div class="mb-3">
    <label for="qr">Escanear QR</label>
    <div id="reader" style="width: 300px;"></div>
</div>

<!-- Mostrar el nombre del voluntario -->
<div id="resultado_qr" class="alert alert-info" style="display: none;">
    <strong>Voluntario detectado:</strong> <span id="nombre_qr"></span>
</div>

<!-- Campo oculto para usar en el formulario -->
<input type="hidden" id="id_registro_qr" name="id_registro">



{{-- FECHA --}}
<div class="form-floating mb-3">
    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha"
        value="{{ old('fecha', $norecibio->fecha ?? date('Y-m-d')) }}"
        style="background-color: #E6E6FA;" required>
    <label for="fecha">Fecha</label>
</div>

<div class="form-floating mb-3">
    <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Motivo"
        value="{{ old('concepto', $norecibio->concepto ?? '') }}"
        style="background-color: #E6E6FA;" required>
    <label for="motivo">Motivo</label>
</div>



<script>
    // Asegúrate de que esta variable tiene los registros que vienen del backend
    const registros = @json($registros);

    function onScanSuccess(decodedText, decodedResult) {
        const id = parseInt(decodedText);
        const registro = registros.find(r => r.id === id);

        if (registro) {
            document.getElementById('nombre_qr').innerText = registro.nombre + " (ID: " + registro.id + ")";
            document.getElementById('resultado_qr').style.display = 'block';
            document.getElementById('id_registro_qr').value = registro.id;
        } else {
            document.getElementById('nombre_qr').innerText = 'Voluntario no encontrado.';
            document.getElementById('resultado_qr').style.display = 'block';
            document.getElementById('id_registro_qr').value = '';
        }
    }

    function onScanError(errorMessage) {
        // Puedes mostrar errores en consola si lo deseas
        console.warn(errorMessage);
    }

    // Iniciar el escáner QR
    const html5QrCodeScanner = new Html5QrcodeScanner(
        "reader", 
        { fps: 10, qrbox: 250 }, 
        false
    );
    html5QrCodeScanner.render(onScanSuccess, onScanError);
</script>

  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>