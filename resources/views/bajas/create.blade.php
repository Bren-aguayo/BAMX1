<x-app-layout>
    <br>

    <div class="major container" style="background-color:white;">
        <h2 style="text-align:center">Registrar baja</h2>
        <br>

        <form action="{{ route('bajas.store') }}" method="POST">
            @csrf

            {{-- 🔎 Escanear código --}}
            <div class="mb-3">
                <label class="form-label">Escanear gafete o ingresar ID</label>
                <input type="text"
                       id="codigo_voluntario"
                       class="form-control"
                       autofocus>
            </div>

            {{-- ID real que se enviará --}}
            <input type="hidden" name="volunteer_id" id="volunteer_id">

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
                <label class="form-label">Motivo</label>
                <textarea name="motivo"
                          class="form-control"
                          rows="3"
                          required></textarea>
            </div>

            <div style="margin: 10px;">
                <button type="submit" class="btn btn-danger">Registrar baja</button>
                <a href="{{ route('bajas.index') }}" class="btn btn-secondary">
                    Mostrar bajas
                </a>
            </div>
        </form>
    </div>

    {{-- 🔥 SCRIPT PARA BUSCAR VOLUNTARIO --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const inputCodigo = document.getElementById('codigo_voluntario');

            if (inputCodigo) {

                inputCodigo.addEventListener('input', function () {

                    let codigo = this.value;

                    if (codigo.length < 1) {
                        return;
                    }

                    fetch(`/buscar-voluntario/${codigo}`)
                        .then(response => response.json())
                        .then(data => {

                            if (data.success) {

                                document.getElementById('volunteer_id').value = data.volunteer.id;
                                document.getElementById('nombre_voluntario').value = data.volunteer.nombre_completo;

                                if (data.volunteer.area) {
                                    document.getElementById('area_voluntario').value = data.volunteer.area.nombre;
                                } else {
                                    document.getElementById('area_voluntario').value = 'Sin área';
                                }

                            } else {

                                document.getElementById('volunteer_id').value = '';
                                document.getElementById('nombre_voluntario').value = '';
                                document.getElementById('area_voluntario').value = '';

                            }

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                });

            }

        });
    </script>

</x-app-layout>