<x-app-layout>
    <br>

    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar restricción</h2>
        <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-warning">
                {{ session('info') }}
            </div>
        @endif

        <form action="{{ route('bajas.store') }}" method="POST">
            @csrf

            {{-- Escanear código --}}
            <div class="mb-3">
                <label class="form-label">Escanear gafete o ingresar ID</label>
                <input type="text"
                       id="codigo_voluntario"
                       class="form-control"
                       autofocus
                       value="{{ old('volunteer_id') }}">
            </div>

            {{-- ID real que se enviará --}}
            <input type="hidden" name="volunteer_id" id="volunteer_id" value="{{ old('volunteer_id') }}">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       id="nombre_voluntario"
                       class="form-control"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Área</label>
                <input type="text"
                       id="area_voluntario"
                       class="form-control"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de restricción</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">Selecciona una opción</option>
                    <option value="definitiva" {{ old('tipo') == 'definitiva' ? 'selected' : '' }}>
                        Baja definitiva
                    </option>
                    <option value="temporal" {{ old('tipo') == 'temporal' ? 'selected' : '' }}>
                        Suspensión temporal
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Motivo</label>
                <textarea name="motivo"
                          class="form-control"
                          rows="3"
                          required>{{ old('motivo') }}</textarea>
            </div>

            <div class="row" id="fechas_restriccion" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date"
                           name="fecha_inicio"
                           id="fecha_inicio"
                           class="form-control"
                           value="{{ old('fecha_inicio', date('Y-m-d')) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date"
                           name="fecha_fin"
                           id="fecha_fin"
                           class="form-control"
                           value="{{ old('fecha_fin') }}">
                </div>
            </div>

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-danger">Registrar restricción</button>
                <a href="{{ route('bajas.index') }}" class="btn btn-secondary">
                    Mostrar restricciones
                </a>
            </div>
        </form>
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

            selectTipo.addEventListener('change', toggleFechas);
            toggleFechas();

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

            @if(old('volunteer_id'))
                inputCodigo.value = "{{ old('volunteer_id') }}";
                buscarVoluntario("{{ old('volunteer_id') }}");
            @endif
        });
    </script>
</x-app-layout>

