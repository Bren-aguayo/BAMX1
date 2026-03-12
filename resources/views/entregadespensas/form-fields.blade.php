<!-- ESCÁNER QR -->
<div class="mb-3">
    <label class="form-label fw-bold">Escanear QR</label>
    <div id="reader" style="width: 300px; margin: 0 auto;"></div>
</div>

<!-- ID MANUAL -->
<div class="form-floating mb-3">
    <input type="number"
        class="form-control"
        id="id_manual"
        placeholder="ID del voluntario">
    <label for="id_manual">ID del voluntario</label>
</div>

<!-- TARJETA DE VERIFICACIÓN -->
<div id="resultado_qr" class="card shadow-sm border-0 mb-4" style="display: none;">
    <div class="card-body text-center">
        <img id="foto_qr"
             src=""
             alt="Foto del voluntario"
             style="width: 160px; height: 160px; object-fit: cover; border-radius: 12px; border: 4px solid #f59e0b; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">

        <h4 class="mt-3 mb-1" id="nombre_qr"></h4>
        <p class="text-muted mb-0" id="area_qr"></p>
    </div>
</div>

<input type="hidden" id="volunteer_id" name="volunteer_id" required>

<!-- FECHA -->
<div class="form-floating mb-3">
    <input type="date" class="form-control" id="fecha" name="fecha" readonly required>
    <label>Fecha</label>
</div>

<!-- HORA -->
<div class="form-floating mb-3">
    <input type="time" class="form-control" id="hora" name="hora" readonly required>
    <label>Hora</label>
</div>

<!-- TIPO -->
<div class="form-floating mb-3">
    <input type="text" class="form-control" value="Despensa del día" readonly>
    <label>Tipo de entrega</label>
</div>

<input type="hidden" name="cantidad" value="1">

<!-- RESPONSABLE -->
<div class="form-floating mb-3">
    <select class="form-select" name="responsable" required>
        <option value="" disabled selected>Selecciona un encargado</option>
        <option value="Claudia Gonzalez">Claudia González</option>
        <option value="Brenda Gonzalez">Brenda González</option>
        <option value="Jazmin Rios">Jazmin Rios</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Guardia">Guardia</option>
        <option value="Apoyo">Apoyo</option>
    </select>
    <label>Responsable</label>
</div>

<!-- LIBRERÍA QR -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const voluntarios = window.voluntarios || [];

    function buscarVoluntario(id) {
        const voluntario = voluntarios.find(v => v.id === parseInt(id));

        if (voluntario) {
            document.getElementById('nombre_qr').innerText =
                voluntario.nombre_completo + " (ID: " + voluntario.id + ")";

            document.getElementById('area_qr').innerText =
                voluntario.area && voluntario.area.nombre
                    ? "Área: " + voluntario.area.nombre
                    : "Área: Sin área";

            document.getElementById('foto_qr').src =
                voluntario.foto
                    ? "/storage/" + voluntario.foto
                    : "https://via.placeholder.com/160x160?text=Sin+foto";

            document.getElementById('resultado_qr').style.display = 'block';
            document.getElementById('volunteer_id').value = voluntario.id;
        } else {
            document.getElementById('resultado_qr').style.display = 'none';
            document.getElementById('volunteer_id').value = '';
        }
    }

    document.getElementById("id_manual").addEventListener("input", function() {
        buscarVoluntario(this.value);
    });

    function onScanSuccess(decodedText) {
        document.getElementById("id_manual").value = decodedText;
        buscarVoluntario(decodedText);
    }

    const html5QrCodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: 250 }
    );

    html5QrCodeScanner.render(onScanSuccess);

    // FECHA Y HORA AUTOMÁTICAS
    const ahora = new Date();
    const year = ahora.getFullYear();
    const month = String(ahora.getMonth() + 1).padStart(2, '0');
    const day = String(ahora.getDate()).padStart(2, '0');
    const hours = String(ahora.getHours()).padStart(2, '0');
    const minutes = String(ahora.getMinutes()).padStart(2, '0');

    document.getElementById('fecha').value = `${year}-${month}-${day}`;
    document.getElementById('hora').value = `${hours}:${minutes}`;
});
</script>

