@php
    $volunteer = $volunteer ?? null;
@endphp

{{-- Nombre completo --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="nombre_completo"
        value="{{ old('nombre_completo', optional($volunteer)->nombre_completo) }}" required>
    <label>Nombre completo</label>
</div>
{{-- Foto del voluntario --}}
<div class="mb-4">
    <label class="form-label fw-bold d-block mb-3">Foto del voluntario</label>

    {{-- Inputs ocultos --}}
    <input 
        type="file"
        name="foto_upload"
        id="foto_upload"
        accept="image/*"
        class="d-none"
    >

    <input 
        type="file"
        name="foto_camera"
        id="foto_camera"
        accept="image/*"
        capture="user"
        class="d-none"
    >

    {{-- Botones visibles --}}
    <div class="d-flex flex-wrap gap-2 mb-3">
        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('foto_upload').click()">
            Subir foto
        </button>

        <button type="button" class="btn btn-outline-warning" onclick="document.getElementById('foto_camera').click()">
            Tomar foto
        </button>
    </div>

    <small class="text-muted d-block mb-3">
        Puedes seleccionar una imagen guardada o tomar una foto al momento desde el celular.
    </small>

    {{-- Vista previa --}}
    <div id="contenedor_preview_foto" class="text-center" style="{{ !empty(optional($volunteer)->foto) ? '' : 'display:none;' }}">
        <img 
            id="preview_foto"
            src="{{ !empty(optional($volunteer)->foto) ? asset('storage/' . $volunteer->foto) : '' }}"
            alt="Vista previa de la foto"
            style="width: 180px; height: 180px; object-fit: cover; border-radius: 12px; border: 3px solid #f59e0b; box-shadow: 0 4px 12px rgba(0,0,0,0.15);"
        >

        <div class="mt-2">
            <button type="button" class="btn btn-sm btn-outline-danger" id="btn_quitar_foto">
                Quitar selección
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputUpload = document.getElementById('foto_upload');
    const inputCamera = document.getElementById('foto_camera');
    const preview = document.getElementById('preview_foto');
    const contenedorPreview = document.getElementById('contenedor_preview_foto');
    const btnQuitar = document.getElementById('btn_quitar_foto');

    function mostrarPreview(input, otroInput) {
        if (input.files && input.files[0]) {
            if (otroInput) {
                otroInput.value = '';
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                contenedorPreview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    if (inputUpload) {
        inputUpload.addEventListener('change', function () {
            mostrarPreview(this, inputCamera);
        });
    }

    if (inputCamera) {
        inputCamera.addEventListener('change', function () {
            mostrarPreview(this, inputUpload);
        });
    }

    if (btnQuitar) {
        btnQuitar.addEventListener('click', function () {
            inputUpload.value = '';
            inputCamera.value = '';
            preview.src = '';
            contenedorPreview.style.display = 'none';
        });
    }
});
</script>

{{-- Género --}}
<div class="form-floating mb-3">
    <select class="form-select" name="genero" required>
        <option value="" disabled {{ old('genero', optional($volunteer)->genero) == '' ? 'selected' : '' }}>
            Selecciona género
        </option>
        <option value="masculino" {{ old('genero', optional($volunteer)->genero) == 'masculino' ? 'selected' : '' }}>
            Masculino
        </option>
        <option value="femenino" {{ old('genero', optional($volunteer)->genero) == 'femenino' ? 'selected' : '' }}>
            Femenino
        </option>
        <option value="no desea decirlo" {{ old('genero', optional($volunteer)->genero) == 'no desea decirlo' ? 'selected' : '' }}>
            No desea decirlo
        </option>
    </select>
    <label>Género</label>
</div>

{{-- Área --}}
<div class="form-floating mb-3">
    <select name="area_id" class="form-select" required>
        <option value="">Selecciona un área</option>

        @foreach ($areas as $area)
            <option value="{{ $area->id }}"
                {{ old('area_id', optional($volunteer)->area_id) == $area->id ? 'selected' : '' }}>
                {{ $area->nombre }}
            </option>
        @endforeach
    </select>
    <label>Área</label>
</div>

{{-- Fecha de nacimiento --}}
<div class="form-floating mb-3">
    <input type="date" class="form-control" name="fecha_nacimiento"
        value="{{ old('fecha_nacimiento', optional($volunteer)->fecha_nacimiento) }}">
    <label>Fecha de nacimiento</label>
</div>

{{-- Documento de identidad --}}
<div class="mb-3">
    <label class="form-label">Documento de identidad (INE)</label>
    <input type="file" class="form-control" name="documento_identidad">
</div>

{{-- Comprobante de domicilio --}}
<div class="mb-3">
    <label class="form-label">Comprobante de domicilio</label>
    <input type="file" class="form-control" name="comprobante_domicilio">
</div>

{{-- Calle --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="calle"
        value="{{ old('calle', optional($volunteer)->calle) }}">
    <label>Calle</label>
</div>

{{-- Colonia --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="colonia"
        value="{{ old('colonia', optional($volunteer)->colonia) }}">
    <label>Colonia</label>
</div>

{{-- Municipio --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="municipio"
        value="{{ old('municipio', optional($volunteer)->municipio) }}">
    <label>Municipio</label>
</div>

{{-- Código Postal --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="cp"
        value="{{ old('cp', optional($volunteer)->cp) }}">
    <label>Código Postal</label>
</div>

{{-- Certificado médico --}}
<div class="mb-3">
    <label class="form-label">Certificado médico</label>
    <input type="file" class="form-control" name="certificado_medico">
</div>

{{-- Acuerdo firmado --}}
<div class="mb-3">
    <label class="form-label">Acuerdo firmado</label>
    <input type="file" class="form-control" name="acuerdo">
</div>

{{-- Autorización / Exclusión --}}
<div class="mb-3">
    <label class="form-label">Autorización / Exclusión</label>
    <input type="file" class="form-control" name="aut_exclusion_responsabilidad">
</div>

{{-- Reglamento de voluntarios --}}
<div class="mb-3">
    <label class="form-label">Reglamento de voluntarios</label>
    <input type="file" class="form-control" name="reglamento_voluntarios">
</div>

{{-- Contacto de emergencia --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="nombre_contacto"
        value="{{ old('nombre_contacto', optional($volunteer)->nombre_contacto) }}" required>
    <label>Contacto de emergencia</label>
</div>

{{-- Teléfono de emergencia --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="tel_emergencias"
        value="{{ old('tel_emergencias', optional($volunteer)->tel_emergencias) }}" required>
    <label>Teléfono de emergencia</label>
</div>

{{-- Fecha de ingreso --}}
<div class="form-floating mb-3">
    <input type="date" class="form-control" name="fecha_ingreso"
        value="{{ old('fecha_ingreso', optional($volunteer)->fecha_ingreso) }}" required>
    <label>Fecha de ingreso</label>
</div>