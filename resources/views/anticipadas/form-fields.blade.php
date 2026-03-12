<!-- Escáner QR -->
<div class="mb-3">
    <label>Escanear QR</label>
    <div id="reader" style="width: 300px;"></div>
</div>

<!-- ID del voluntario (se llena manual o con QR) -->
<div class="form-floating mb-3">
    <input type="number" 
        class="form-control" 
        id="id_registro" 
        name="id_registro"
        placeholder="ID del voluntario"
        style="background-color: #E6E6FA;"
        required>
    <label for="id_registro">ID del voluntario</label>
</div>

<!-- Mostrar el nombre del voluntario -->
<div id="resultado_qr" class="alert alert-info" style="display: none;">
    <strong>Voluntario detectado:</strong> 
    <span id="nombre_qr"></span>
</div>

<!-- MOTIVO -->
<div class="form-floating mb-3">
    <select class="form-select" id="motivo" name="motivo" required>
        <option value="" disabled selected>Selecciona un motivo</option>
        <option value="Se retira problema personal">Se retira problema personal</option>
        <option value="Se retira problema de salud">Se retira problema de salud</option>
    </select>
    <label for="motivo">Motivo</label>
</div>

<!-- ENCARGADO -->
<div class="form-floating mb-3">
    <select class="form-select" name="encargado" required>
        <option value="" disabled selected>Selecciona un encargado</option>
        <option value="Ana Soto (Traspaleo F&V)">Ana Soto (Traspaleo F&V)</option>
        <option value="Sebastian (Cámara refrigerados)">Sebastian (Cámara refrigerados)</option>
        <option value="Carlos Pérez (Salidas)">Carlos Pérez (Salidas)</option>
        <option value="Diana (Panadería)">Diana (Panadería)</option>
        <option value="Blanca (Recibo)">Blanca (Recibo)</option>
        <option value="Guillermo (Mantenimiento)">Guillermo (Mantenimiento)</option>
        <option value="Esmeralda (Gte Almacén)">Esmeralda (Gte Almacén)</option>
        <option value="Jessica (X)">Jessica (X)</option>
        <option value="Jhonny (Tráfico)">Jhonny (Tráfico)</option>
        <option value="Brenda González (R.R.H.H)">Brenda González (R.R.H.H)</option>
        <option value="Claudia González (S.P)">Claudia González (S.P)</option>
    </select>
    <label>Encargado</label>
</div>

<!-- HORA -->
<div class="form-floating mb-3">
    <input type="time" 
        class="form-control" 
        id="hora" 
        name="hora"
        style="background-color: #E6E6FA;" 
        required>
    <label for="hora">Hora</label>
</div>

<!-- FECHA -->
<div class="form-floating mb-3">
    <input type="date" 
        class="form-control" 
        id="fecha" 
        name="fecha"
        style="background-color: #E6E6FA;" 
        required>
    <label for="fecha">Fecha</label>
</div>

<!-- Librería QR -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function onScanSuccess(decodedText) {
        const id = parseInt(decodedText);

        // Aquí debes asegurarte que "registros" venga desde tu backend
        const registro = registros.find(r => r.id === id);

        if (registro) {
            document.getElementById('nombre_qr').innerText =
                registro.nombre + " (ID: " + registro.id + ")";
            document.getElementById('resultado_qr').style.display = 'block';

            // 🔥 Ahora sí llenamos el input correcto
            document.getElementById('id_registro').value = registro.id;
        } else {
            document.getElementById('nombre_qr').innerText =
                'Voluntario no encontrado.';
            document.getElementById('resultado_qr').style.display = 'block';
            document.getElementById('id_registro').value = '';
        }
    }

    function onScanError(errorMessage) {
        console.warn(errorMessage);
    }

    const html5QrCodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: 250 }
    );

    html5QrCodeScanner.render(onScanSuccess, onScanError);

    // Fecha y hora automática
    function setFechaHoraActual() {
        const ahora = new Date();

        const year = ahora.getFullYear();
        const month = String(ahora.getMonth() + 1).padStart(2, '0');
        const day = String(ahora.getDate()).padStart(2, '0');

        const hours = String(ahora.getHours()).padStart(2, '0');
        const minutes = String(ahora.getMinutes()).padStart(2, '0');

        document.getElementById('fecha').value = `${year}-${month}-${day}`;
        document.getElementById('hora').value = `${hours}:${minutes}`;
    }

    window.onload = setFechaHoraActual;
</script>