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
<input type="hidden" id="id_registro_qr" name="id_registro" value="{{ old('id_registro', $extra->id_registro ?? '') }}">

<!-- ID Manual -->
<div class="form-floating mb-3">
    <input type="number" 
           class="form-control" 
           id="id_manual" 
           name="id_manual" 
           placeholder="Ingresa ID manualmente" 
           value="{{ old('id_manual', $extra->id_registro ?? '') }}">
    <label for="id_manual">ID Manual (si no hay QR)</label>
</div>

{{-- ENTRADA --}}
<div class="form-floating mb-3">
    <select class="form-select" id="entrada" name="entrada" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona horario de entrada</option>
        <option value="16:00" {{ old('entrada', $extra->entrada ?? '') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
        <option value="16:30" {{ old('entrada', $extra->entrada ?? '') == '16:30' ? 'selected' : '' }}>4:30 PM</option>
    </select>
    <label for="entrada">Entrada</label>
</div>

{{-- SALIDA --}}
<div class="form-floating mb-3">
    <select class="form-select" id="salida" name="salida" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona horario de salida</option>
        @php
            $hora = strtotime('18:00');
            while ($hora <= strtotime('21:30')) {
                $horaFormato = date('H:i', $hora);
                $selected = old('salida', $extra->salida ?? '') == $horaFormato ? 'selected' : '';
                echo "<option value=\"$horaFormato\" $selected>$horaFormato</option>";
                $hora = strtotime('+30 minutes', $hora);
            }
        @endphp
    </select>
    <label for="salida">Salida</label>
</div>

{{-- MOTIVO --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="motivo" name="motivo" placeholder="Motivo"
        value="{{ old('motivo', $extra->motivo ?? '') }}" 
        style="background-color: #E6E6FA;" required>
    <label for="motivo">Motivo</label>
</div>

{{-- ENCARGADO --}}
<div class="form-floating mb-3">
    <select class="form-select" id="encargado" name="encargado" style="background-color: #E6E6FA;" required>
        <option value="" disabled selected>Selecciona un encargado</option>
        <option value="Ana Soto (Traspaleo F&V)" {{ old('encargado', $extra->encargado ?? '') == 'Ana Soto (Traspaleo F&V)' ? 'selected' : '' }}>Ana Soto (Traspaleo F&V)</option>
        <option value="Sebastian (Cámara refrigerados)" {{ old('encargado', $extra->encargado ?? '') == 'Sebastian (Cámara refrigerados)' ? 'selected' : '' }}>Sebastian (Cámara refrigerados)</option>
        <option value="Carlos Pérez (Salidas)" {{ old('encargado', $extra->encargado ?? '') == 'Carlos Pérez (Salidas)' ? 'selected' : '' }}>Carlos Pérez (Salidas)</option>
        <option value="Diana (Panadería)" {{ old('encargado', $extra->encargado ?? '') == 'Diana (Panadería)' ? 'selected' : '' }}>Diana (Panadería)</option>
        <option value="Blanca (Recibo)" {{ old('encargado', $extra->encargado ?? '') == 'Blanca (Recibo)' ? 'selected' : '' }}>Blanca (Recibo)</option>
        <option value="Guillermo (Mantenimiento)" {{ old('encargado', $extra->encargado ?? '') == 'Guillermo (Mantenimiento)' ? 'selected' : '' }}>Guillermo (Mantenimiento)</option>
        <option value="Esmeralda (Gte Almacén)" {{ old('encargado', $extra->encargado ?? '') == 'Esmeralda (Gte Almacén)' ? 'selected' : '' }}>Esmeralda (Gte Almacén)</option>
        <option value="Jessica (X)" {{ old('encargado', $extra->encargado ?? '') == 'Jessica (X)' ? 'selected' : '' }}>Jessica (X)</option>
        <option value="Jhonny (Tráfico)" {{ old('encargado', $extra->encargado ?? '') == 'Jhonny (Tráfico)' ? 'selected' : '' }}>Jhonny (Tráfico)</option>
        <option value="Brenda González (R.R.H.H)" {{ old('encargado', $extra->encargado ?? '') == 'Brenda González (R.R.H.H)' ? 'selected' : '' }}>Brenda González (R.R.H.H)</option>
        <option value="Claudia González (S.P)" {{ old('encargado', $extra->encargado ?? '') == 'Claudia González (S.P)' ? 'selected' : '' }}>Claudia González (S.P)</option>
    </select>
    <label for="encargado">Responsable</label>
</div>

{{-- SCRIPTS --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // Protegemos registros si no está definido
    
    function mostrarRegistro(registro) {
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

    // Escáner QR
    function onScanSuccess(decodedText, decodedResult) {
        const id = parseInt(decodedText);
        const registro = registros.find(r => r.id === id);
        mostrarRegistro(registro);
    }

    function onScanError(errorMessage) {
        console.warn(errorMessage);
    }

    const html5QrCodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: 250 },
        false
    );
    html5QrCodeScanner.render(onScanSuccess, onScanError);

    // Input manual
    document.getElementById('id_manual').addEventListener('input', function() {
        const id = parseInt(this.value);
        const registro = registros.find(r => r.id === id);
        mostrarRegistro(registro);
    });
</script>
