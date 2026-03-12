<!-- ESCÁNER QR -->
<div class="mb-3 text-center">
    <label class="form-label fw-bold">Escanear QR</label>
    <div id="reader"></div>
</div>

<!-- ID MANUAL -->
<div class="form-floating mb-3">
    <input type="number"
        class="form-control"
        id="id_manual"
        placeholder="ID del voluntario">
    <label for="id_manual">ID del voluntario</label>
</div>

<!-- TARJETA DE VALIDACIÓN -->
<div id="resultado_qr" class="card shadow-sm border-0 mb-4" style="display: none; max-width: 420px; margin:auto;">
    <div class="card-body text-center">
        <img id="foto_qr"
             src=""
             alt="Foto del voluntario"
             style="width: 160px; height: 160px; object-fit: cover; border-radius: 12px; border: 4px solid #f59e0b; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">

        <h4 class="mt-3 mb-1" id="nombre_qr"></h4>
        <p class="text-muted mb-0" id="area_qr"></p>
    </div>
</div>

<!-- CAMPO OCULTO CORRECTO -->
<input type="hidden" id="id_registro" name="id_registro" value="{{ old('id_registro', $incidente->id_registro ?? '') }}" required>

<!-- MOTIVO -->
<div class="form-floating mb-3">
    <input type="text"
           class="form-control"
           id="motivo"
           name="motivo"
           placeholder="Motivo"
           value="{{ old('motivo', $incidente->motivo ?? '') }}"
           required>
    <label for="motivo">Motivo</label>
</div>

<!-- RESPONSABLE -->
<div class="form-floating mb-3">
    <select class="form-select" name="encargado" required>
        <option value="" disabled {{ old('encargado', $incidente->encargado ?? '') == '' ? 'selected' : '' }}>
            Selecciona un encargado
        </option>
        @foreach([
            'Claudia González',
            'Brenda González',
            'Jazmin Rios',
            'Montserrat',
            'Guardia',
            'Apoyo'
        ] as $responsable)
            <option value="{{ $responsable }}"
                {{ old('encargado', $incidente->encargado ?? '') == $responsable ? 'selected' : '' }}>
                {{ $responsable }}
            </option>
        @endforeach
    </select>
    <label>Responsable</label>
</div>

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
            document.getElementById('id_registro').value = voluntario.id;
        } else if (id) {
            document.getElementById('resultado_qr').style.display = 'none';
            document.getElementById('id_registro').value = '';
        } else {
            document.getElementById('resultado_qr').style.display = 'none';
            document.getElementById('id_registro').value = '';
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

    const idActual = document.getElementById('id_registro').value;
    if (idActual) {
        document.getElementById('id_manual').value = idActual;
        buscarVoluntario(idActual);
    }
});
</script>

