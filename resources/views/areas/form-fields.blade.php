
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del área"  value="{{old('nombre',$area->nombre ?? '')}}" style="background-color: #E6E6FA;" required>
    <label for="nombre">Nombre del área</label>
</div>

<div class="form-floating mb-3">
    <input type="text" class="form-control" id="cantidad_minima" name="cantidad_minima" placeholder="Cantidad minima de espacios"  value="{{old('cantidad_minima',$area->cantidad_minima ?? '')}}" style="background-color: #E6E6FA;" required>
    <label for="cantidad">Espacios minimos</label>
</div>

<div class="form-floating mb-3">
    <input type="text" class="form-control" id="cantidad_maxima" name="cantidad_maxima" placeholder="Cantidad maxima de espacios"  value="{{old('cantidad_maxima',$area->cantidad_maxima ?? '')}}" style="background-color: #E6E6FA;" required>
    <label for="cantidad">Espacios maximos</label>
</div>

<div class="form-floating mb-3">
    <select class="form-control" id="encargado" name="encargado" style="background-color: #E6E6FA;" required>
        <option value="">Seleccione un encargado</option>
        @php
            $encargados = [
                'ANA SOTO',
                'BLANCA',
                'CARLOS',
                'ADRIAN',
                'DIANA',
                'SEBASTIAN',
                'MONTSE',
                'LUPITA',
                'GUILLERMO',
                'BERNABE',
                'JORGE',
                'RAFAEL',
                'JOCELYN',
                'BRENDA',
                'CLAUDIA',
            ];
        @endphp

        @foreach ($encargados as $nombre)
            <option value="{{ $nombre }}" {{ old('encargado', $area->encargado ?? '') == $nombre ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    <label for="responsable">Encargado</label>
</div>

<div class="form-floating mb-3">
    <select class="form-control" id="gerente" name="gerente" style="background-color: #E6E6FA;" required>
        <option value="">Seleccione un gerente</option>
        @php
            $gerentes = [
                'ESMERALDA',
                'MARCOS',
                'NANCY',
                'JHONY',
                'PAULA',
                'JESSICA',
                'BRENDA GONZALEZ',
                'PAULA GONZALEZ',
                
            ];
        @endphp

        @foreach ($gerentes as $nombre)
            <option value="{{ $nombre }}" {{ old('gerente', $area->gerente ?? '') == $nombre ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    <label for="responsable">Gerente</label>
</div>