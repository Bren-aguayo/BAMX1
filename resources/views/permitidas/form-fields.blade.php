<div class="row">
    {{-- Volunteer --}}
    <div class="col-md-6 mb-3">
        <label for="volunteer_id" class="form-label">Voluntario</label>
        <select name="volunteer_id" id="volunteer_id" class="form-select" required>
            <option value="">Selecciona un voluntario</option>
            @foreach($volunteers as $volunteer)
                <option value="{{ $volunteer->id }}"
                    {{ old('volunteer_id', $permitida->volunteer_id ?? '') == $volunteer->id ? 'selected' : '' }}>
                    {{ $volunteer->nombre_completo }} (#{{ $volunteer->id }})
                </option>
            @endforeach
        </select>
        @error('volunteer_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Fecha --}}
    <div class="col-md-6 mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            class="form-control"
            value="{{ old('fecha', $permitida->fecha ?? date('Y-m-d')) }}"
            required
        >
        @error('fecha')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Hora salida --}}
    <div class="col-md-6 mb-3">
        <label for="hora_salida" class="form-label">Hora de salida</label>
        <input
            type="time"
            name="hora_salida"
            id="hora_salida"
            class="form-control"
            value="{{ old('hora_salida', $permitida->hora_salida ?? '') }}"
            required
        >
        @error('hora_salida')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Encargado salida --}}
    <div class="col-md-6 mb-3">
        <label for="encargado_salida" class="form-label">Encargado que autoriza salida</label>
        <input
            type="text"
            name="encargado_salida"
            id="encargado_salida"
            class="form-control"
            value="{{ old('encargado_salida', $permitida->encargado_salida ?? '') }}"
            required
        >
        @error('encargado_salida')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Motivo --}}
    <div class="col-12 mb-3">
        <label for="motivo" class="form-label">Motivo de salida</label>
        <input
            type="text"
            name="motivo"
            id="motivo"
            class="form-control"
            value="{{ old('motivo', $permitida->motivo ?? '') }}"
            required
        >
        @error('motivo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<hr>

<h5>Datos de reingreso</h5>
<p class="text-muted">Estos campos se llenan cuando el voluntario regresa.</p>

<div class="row">
    {{-- Hora reingreso --}}
    <div class="col-md-4 mb-3">
        <label for="hora_reingreso" class="form-label">Hora de reingreso</label>
        <input
            type="time"
            name="hora_reingreso"
            id="hora_reingreso"
            class="form-control"
            value="{{ old('hora_reingreso', $permitida->hora_reingreso ?? '') }}"
        >
        @error('hora_reingreso')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Encargado reingreso --}}
    <div class="col-md-4 mb-3">
        <label for="encargado_reingreso" class="form-label">Encargado que registra reingreso</label>
        <input
            type="text"
            name="encargado_reingreso"
            id="encargado_reingreso"
            class="form-control"
            value="{{ old('encargado_reingreso', $permitida->encargado_reingreso ?? '') }}"
        >
        @error('encargado_reingreso')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Estado --}}
    <div class="col-md-4 mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select">
            <option value="fuera" {{ old('estado', $permitida->estado ?? 'fuera') == 'fuera' ? 'selected' : '' }}>
                Fuera
            </option>
            <option value="reingreso" {{ old('estado', $permitida->estado ?? '') == 'reingreso' ? 'selected' : '' }}>
                Reingresó
            </option>
        </select>
        @error('estado')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Concepto reingreso --}}
    <div class="col-12 mb-3">
        <label for="concepto_reingreso" class="form-label">Concepto / observación de reingreso</label>
        <input
            type="text"
            name="concepto_reingreso"
            id="concepto_reingreso"
            class="form-control"
            value="{{ old('concepto_reingreso', $permitida->concepto_reingreso ?? '') }}"
        >
        @error('concepto_reingreso')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

