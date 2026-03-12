{{-- Nombre --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
        value="{{ old('nombre', $guardia->nombre ?? '') }}" style="background-color: #E6E6FA;" required>
    <label for="nombre">Nombre</label>
</div>

{{-- Apellido --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido"
        value="{{ old('apellido', $guardia->apellido ?? '') }}" style="background-color: #E6E6FA;" required>
    <label for="apellido">Apellidos</label>
</div>

{{-- Área --}}
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="area" name="area" placeholder="Área"
        value="{{ old('area', $guardia->area ?? '') }}" style="background-color: #E6E6FA;" required>
    <label for="area">Área</label>
</div>

