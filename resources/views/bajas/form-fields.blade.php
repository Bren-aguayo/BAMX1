{{-- ID real que se enviará --}}
<input type="hidden" name="volunteer_id" id="volunteer_id"
       value="{{ old('volunteer_id', $baja->volunteer_id ?? '') }}">

<div class="mb-3">
    <label class="form-label">Escanear gafete o ingresar ID</label>
    <input type="text"
           id="codigo_voluntario"
           class="form-control"
           value="{{ old('volunteer_id', $baja->volunteer_id ?? '') }}"
           autofocus>
</div>

<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text"
           id="nombre_voluntario"
           class="form-control"
           value="{{ old('nombre_voluntario', optional($baja->volunteer)->nombre_completo ?? '') }}"
           readonly>
</div>

<div class="mb-3">
    <label class="form-label">Área</label>
    <input type="text"
           id="area_voluntario"
           class="form-control"
           value="{{ old('area_voluntario', optional(optional($baja->volunteer)->area)->nombre ?? 'Sin área') }}"
           readonly>
</div>

<div class="mb-3">
    <label class="form-label">Tipo de restricción</label>
    <select name="tipo" id="tipo" class="form-select" required>
        <option value="">Selecciona una opción</option>
        <option value="definitiva"
            {{ old('tipo', $baja->tipo ?? '') == 'definitiva' ? 'selected' : '' }}>
            Baja definitiva
        </option>
        <option value="temporal"
            {{ old('tipo', $baja->tipo ?? '') == 'temporal' ? 'selected' : '' }}>
            Suspensión temporal
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Motivo</label>
    <textarea name="motivo"
              class="form-control"
              rows="3"
              required>{{ old('motivo', $baja->motivo ?? '') }}</textarea>
</div>

<div class="row" id="fechas_restriccion" style="display: none;">
    <div class="col-md-6 mb-3">
        <label class="form-label">Fecha de inicio</label>
        <input type="date"
               name="fecha_inicio"
               id="fecha_inicio"
               class="form-control"
               value="{{ old('fecha_inicio', isset($baja->fecha_inicio) && $baja->fecha_inicio ? $baja->fecha_inicio->format('Y-m-d') : date('Y-m-d')) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Fecha de fin</label>
        <input type="date"
               name="fecha_fin"
               id="fecha_fin"
               class="form-control"
               value="{{ old('fecha_fin', isset($baja->fecha_fin) && $baja->fecha_fin ? $baja->fecha_fin->format('Y-m-d') : '') }}">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputCodigo = document.getElementById('codigo_voluntario');
        const inputVolunteerId = document.getElementById('volunteer_id');
        const inputNombre = document.getElementById('nombre_voluntario');
        const inputArea = document.getElementById('area_voluntario');
        const selectTipo = document.getElementById('tipo');
        const contenedorFechas = document.getElementById('fechas_restriccion');
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');

        function toggleFechas() {
            if (selectTipo.value === 'temporal') {
                contenedorFechas.style.display = 'flex';
                fechaInicio.setAttribute('required', 'required');
                fechaFin.setAttribute('required', 'required');
            } else {
                contenedorFechas.style.display = 'none';
                fechaInicio.removeAttribute('required');
                fechaFin.removeAttribute('required');
                fechaFin.value = '';
            }
        }

        function limpiarCamposVoluntario() {
            inputVolunteerId.value = '';
            inputNombre.value = '';
            inputArea.value = '';
        }

        function buscarVoluntario(codigo) {
            fetch(`/buscar-voluntario/${codigo}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        inputVolunteerId.value = data.volunteer.id;
                        inputNombre.value = data.volunteer.nombre_completo;
                        inputArea.value = data.volunteer.area ? data.volunteer.area.nombre : 'Sin área';
                    } else {
                        limpiarCamposVoluntario();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    limpiarCamposVoluntario();
                });
        }

        if (selectTipo) {
            selectTipo.addEventListener('change', toggleFechas);
            toggleFechas();
        }

        if (inputCodigo) {
            inputCodigo.addEventListener('input', function () {
                let codigo = this.value.trim();

                if (codigo.length < 1) {
                    limpiarCamposVoluntario();
                    return;
                }

                buscarVoluntario(codigo);
            });
        }
    });
</script>

