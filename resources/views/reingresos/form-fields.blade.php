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


{{-- MOTIVO --}}
<div class="form-floating mb-3">
    <select class="form-select" id="concepto" name="concepto" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona motivo</option>
        <option value="fumar" {{ old('concepto', $reingreso->motivo ?? '') == 'Fumar' ? 'selected' : '' }}>Sale a fumar</option>
        <option value="Sanitario" {{ old('concepto', $reingreso->motivo ?? '') == 'Sanitario' ? 'selected' : '' }}>Sanitario</option>
          <option value="Despensa" {{ old('concepto', $reingreso->motivo ?? '') == 'recoger despensa' ? 'selected' : '' }}>Recoger Despensa</option>
       
    </select>
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