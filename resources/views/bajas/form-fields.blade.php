{{-- Campo para QR o Código --}}
<div class="form-floating mb-3">
    <input type="text"
        class="form-control"
        id="codigo_voluntario"
        placeholder="Escanea o escribe el código"
        style="background-color: #E6E6FA;">
    <label for="codigo_voluntario">Escanea o escribe el código</label>
</div>

{{-- ID oculto que sí se guarda --}}
<input type="hidden" name="id_registro" id="id_registro">

{{-- Datos que se autocompletan --}}
<div class="mb-3">
    <input type="text" class="form-control mb-2"
        id="nombre_voluntario"
        placeholder="Nombre"
        readonly>

    <input type="text" class="form-control"
        id="area_voluntario"
        placeholder="Área"
        readonly>
</div>

{{-- Motivo --}}
<div class="form-floating mb-3">
    <input type="text"
        class="form-control"
        id="concepto"
        name="concepto"
        placeholder="Motivo"
        style="background-color: #E6E6FA;"
        required>
    <label for="concepto">Motivo</label>
</div>