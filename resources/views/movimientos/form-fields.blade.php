
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


{{-- ÁREA SALIDA --}}
<div class="form-floating mb-3">
    <select class="form-select" id="id_area_salida" name="id_area_salida" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona área de salida</option>
        @foreach ($areas as $area)
            <option value="{{ $area->id }}" 
                {{ old('id_area_salida', $movimiento->id_area_salida ?? '') == $area->id ? 'selected' : '' }}>
                {{ $area->nombre }}
            </option>
        @endforeach
    </select>
    <label for="id_area_salida">Área de salida</label>
</div>

{{-- ÁREA ENTRADA --}}
<div class="form-floating mb-3">
    <select class="form-select" id="id_area_entrada" name="id_area_entrada" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona área de entrada</option>
        @foreach ($areas as $area)
            <option value="{{ $area->id }}" 
                {{ old('id_area_entrada', $movimiento->id_area_entrada ?? '') == $area->id ? 'selected' : '' }}>
                {{ $area->nombre }}
            </option>
        @endforeach
    </select>
    <label for="id_area_entrada">Área de entrada</label>
</div>

{{-- HORA --}}
<div class="form-floating mb-3">
    <input type="time" class="form-control" id="hora" name="hora"
        value="{{ old('hora', $movimiento->hora ?? '') }}"
        style="background-color: #E6E6FA;" required>
    <label for="hora">Hora</label>
</div>

{{-- MOTIVO --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="motivo" name="motivo" placeholder="Motivo"
        value="{{ old('motivo', $movimiento->motivo ?? '') }}"
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