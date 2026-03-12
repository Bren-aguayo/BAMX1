<x-app-layout>
    <br>

    <style>
        #reader {
            width: 300px;
            margin: 0 auto;
            border: 3px solid orange;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }

        .card-validacion {
            max-width: 420px;
            margin: 20px auto;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.10);
            border: none;
        }

        .foto-voluntario {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            border: 4px solid #f59e0b;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
    </style>

    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar horas extras</h2>
        <br>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- TARJETA DESPUÉS DE REGISTRAR --}}
        @if(session('nombre'))
            <div class="card card-validacion text-center p-3 mb-4">
                @if(session('foto'))
                    <div class="mb-3">
                        <img src="{{ session('foto') }}" alt="Foto del voluntario" class="foto-voluntario">
                    </div>
                @endif

                <h4 class="mb-1">{{ session('nombre') }}</h4>
                <p class="text-muted mb-0">
                    <strong>Área:</strong> {{ session('area') ?? 'Sin área' }}
                </p>
            </div>
        @endif

        <form action="{{ route('extras.store') }}" method="post">
            @csrf

            {{-- ESCÁNER QR --}}
            <div class="mb-3 text-center">
                <label class="form-label fw-bold">Escanear QR</label>
                <div id="reader"></div>
            </div>

            {{-- ID MANUAL --}}
            <div class="form-floating mb-3">
                <input type="number"
                       class="form-control"
                       id="id_manual"
                       placeholder="ID del voluntario">
                <label for="id_manual">ID del voluntario</label>
            </div>

            {{-- TARJETA DE VALIDACIÓN --}}
            <div id="resultado_qr" class="card card-validacion text-center p-3" style="display:none;">
                <div class="mb-3">
                    <img id="foto_qr"
                         src=""
                         alt="Foto del voluntario"
                         class="foto-voluntario">
                </div>

                <h4 class="mb-1" id="nombre_qr"></h4>
                <p class="text-muted mb-0" id="area_qr"></p>
            </div>

            {{-- ID REAL --}}
            <input type="hidden" id="id_registro_qr" name="id_registro" value="{{ old('id_registro') }}" required>

            {{-- MOTIVO --}}
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       id="motivo"
                       name="motivo"
                       placeholder="Motivo"
                       value="{{ old('motivo') }}"
                       required>
                <label for="motivo">Motivo</label>
            </div>

            {{-- ENCARGADO --}}
            <div class="form-floating mb-3">
                <select class="form-select" id="encargado" name="encargado" required>
                    <option value="" disabled selected>Selecciona un encargado</option>
                    @foreach([
                        "Ana Soto (Traspaleo F&V)",
                        "Sebastian (Cámara refrigerados)",
                        "Carlos Pérez (Salidas)",
                        "Diana (Panadería)",
                        "Blanca (Recibo)",
                        "Guillermo (Mantenimiento)",
                        "Esmeralda (Gte Almacén)",
                        "Jessica (X)",
                        "Jhonny (Tráfico)",
                        "Brenda González (R.R.H.H)",
                        "Claudia González (S.P)"
                    ] as $encargado)
                        <option value="{{ $encargado }}" {{ old('encargado') == $encargado ? 'selected' : '' }}>
                            {{ $encargado }}
                        </option>
                    @endforeach
                </select>
                <label for="encargado">Responsable</label>
            </div>

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-primary">Registrar entrada / salida</button>
                <a href="{{ route('extras.index') }}" class="btn btn-secondary">Mostrar horas extras</a>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const volunteers = @json($volunteers);

            function buscarVoluntario(id) {
                const voluntario = volunteers.find(v => v.id === parseInt(id));

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
                    document.getElementById('id_registro_qr').value = voluntario.id;
                } else {
                    document.getElementById('resultado_qr').style.display = 'none';
                    document.getElementById('id_registro_qr').value = '';
                }
            }

            document.getElementById('id_manual').addEventListener('input', function () {
                buscarVoluntario(this.value);
            });

            function onScanSuccess(decodedText) {
                document.getElementById('id_manual').value = decodedText;
                buscarVoluntario(decodedText);
            }

            const html5QrCodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: 250 },
                false
            );

            html5QrCodeScanner.render(onScanSuccess);
        });
    </script>
</x-app-layout>

