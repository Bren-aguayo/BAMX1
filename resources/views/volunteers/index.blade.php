<x-app-layout>
    <style>
        .volunteers-wrapper {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        }

        .table-container {
            position: relative;
            overflow: auto;
            max-height: 75vh;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }

        .table-volunteers {
            min-width: 2200px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .table-volunteers thead th {
            position: sticky;
            top: 0;
            z-index: 20;
            background: #f59e0b;
            color: white;
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
        }

        .table-volunteers td {
            vertical-align: top;
            font-size: 14px;
        }

        .sticky-col-1 {
            position: sticky;
            left: 0;
            z-index: 15;
            background: white;
            min-width: 80px;
            max-width: 80px;
        }

        .sticky-col-2 {
            position: sticky;
            left: 80px;
            z-index: 15;
            background: white;
            min-width: 95px;
            max-width: 95px;
        }

        .sticky-col-3 {
            position: sticky;
            left: 175px;
            z-index: 15;
            background: white;
            min-width: 220px;
            max-width: 220px;
            white-space: normal;
        }

        .sticky-right-1 {
            position: sticky;
            right: 110px;
            z-index: 15;
            background: white;
            min-width: 110px;
            max-width: 110px;
            text-align: center;
        }

        .sticky-right-2 {
            position: sticky;
            right: 0;
            z-index: 15;
            background: white;
            min-width: 110px;
            max-width: 110px;
            text-align: center;
        }

        .table-danger .sticky-col-1,
        .table-danger .sticky-col-2,
        .table-danger .sticky-col-3,
        .table-danger .sticky-right-1,
        .table-danger .sticky-right-2 {
            background: #f8d7da !important;
        }

        .table-volunteers thead .sticky-col-1,
        .table-volunteers thead .sticky-col-2,
        .table-volunteers thead .sticky-col-3,
        .table-volunteers thead .sticky-right-1,
        .table-volunteers thead .sticky-right-2 {
            background: #f59e0b !important;
            z-index: 25;
        }

        .volunteer-photo {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f59e0b;
        }

        .file-btn {
            display: inline-block;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 8px;
            text-decoration: none;
            border: 1px solid #0d6efd;
        }

        .name-cell {
            font-weight: 600;
        }

        .badge-vetado {
            display: inline-block;
            margin-top: 6px;
        }

        .toolbar-volunteers {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .scroll-top {
            overflow-x: auto;
            overflow-y: hidden;
            height: 18px;
            margin-bottom: 8px;
        }

        .scroll-top div {
            height: 1px;
        }

        .text-wrap-normal {
            white-space: normal;
            min-width: 150px;
        }
    </style>

    <div class="container py-4">
        <div class="volunteers-wrapper">
            <div class="toolbar-volunteers">
                <h2 class="mb-0">Lista de voluntarios</h2>

                <a href="{{ route('volunteers.create') }}" class="btn btn-warning text-white fw-bold">
                    Registrar voluntario
                </a>
            </div>

            <div class="scroll-top" id="scrollTop">
                <div id="scrollTopInner"></div>
            </div>

            <div class="table-container" id="tableContainer">
                <table class="table table-striped table-hover align-middle table-volunteers">
                    <thead>
                        <tr>
                            <th class="sticky-col-1">ID</th>
                            <th class="sticky-col-2">Foto</th>
                            <th class="sticky-col-3">Nombre completo</th>
                            <th>Género</th>
                            <th>Área</th>
                            <th>Fecha nacimiento</th>
                            <th>INE</th>
                            <th>Comprobante domicilio</th>
                            <th>Calle</th>
                            <th>Colonia</th>
                            <th>Municipio</th>
                            <th>CP</th>
                            <th>Certificado médico</th>
                            <th>Acuerdo</th>
                            <th>Autorización</th>
                            <th>Reglamento</th>
                            <th>Contacto emergencia</th>
                            <th>Teléfono</th>
                            <th>Fecha ingreso</th>
                            <th class="sticky-right-1">Editar</th>
                            <th class="sticky-right-2">Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($volunteers as $volunteer)
                            <tr class="{{ $volunteer->is_vetado ? 'table-danger' : '' }}">
                                <td class="sticky-col-1">{{ $volunteer->id }}</td>

                                <td class="sticky-col-2 text-center">
                                    @if($volunteer->foto)
                                        <img
                                            src="{{ asset('storage/' . $volunteer->foto) }}"
                                            alt="Foto de {{ $volunteer->nombre_completo }}"
                                            class="volunteer-photo"
                                        >
                                    @else
                                        <span class="text-muted small">Sin foto</span>
                                    @endif
                                </td>

                                <td class="sticky-col-3 name-cell {{ $volunteer->is_vetado ? 'text-danger fw-bold' : '' }}">
                                    {{ $volunteer->nombre_completo }}
                                    @if($volunteer->is_vetado)
                                        <br>
                                        <span class="badge bg-danger badge-vetado">Vetado</span>
                                    @endif
                                </td>

                                <td>{{ $volunteer->genero }}</td>

                                <td class="text-wrap-normal">
                                    @if($volunteer->area && is_object($volunteer->area))
                                        {{ $volunteer->area->nombre }}
                                    @else
                                        <span class="text-warning">
                                            Área no encontrada (ID: {{ $volunteer->area_id }})
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $volunteer->fecha_nacimiento }}</td>

                                <td>
                                    @if($volunteer->documento_identidad)
                                        <a href="{{ asset('storage/'.$volunteer->documento_identidad) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($volunteer->comprobante_domicilio)
                                        <a href="{{ asset('storage/'.$volunteer->comprobante_domicilio) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td class="text-wrap-normal">{{ $volunteer->calle }}</td>
                                <td class="text-wrap-normal">{{ $volunteer->colonia }}</td>
                                <td class="text-wrap-normal">{{ $volunteer->municipio }}</td>
                                <td>{{ $volunteer->cp }}</td>

                                <td>
                                    @if($volunteer->certificado_medico)
                                        <a href="{{ asset('storage/'.$volunteer->certificado_medico) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($volunteer->acuerdo)
                                        <a href="{{ asset('storage/'.$volunteer->acuerdo) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($volunteer->aut_exclusion_responsabilidad)
                                        <a href="{{ asset('storage/'.$volunteer->aut_exclusion_responsabilidad) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($volunteer->reglamento_voluntarios)
                                        <a href="{{ asset('storage/'.$volunteer->reglamento_voluntarios) }}" class="file-btn" download>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td class="text-wrap-normal">{{ $volunteer->nombre_contacto }}</td>
                                <td>{{ $volunteer->tel_emergencias }}</td>
                                <td>{{ $volunteer->fecha_ingreso }}</td>

                                <td class="sticky-right-1">
                                    <a href="{{ route('volunteers.edit', $volunteer) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        Editar
                                    </a>
                                </td>

                                <td class="sticky-right-2">
                                    <form action="{{ route('volunteers.destroy', $volunteer) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este voluntario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableContainer = document.getElementById('tableContainer');
            const scrollTop = document.getElementById('scrollTop');
            const scrollTopInner = document.getElementById('scrollTopInner');

            function syncWidths() {
                scrollTopInner.style.width = tableContainer.scrollWidth + 'px';
            }

            scrollTop.addEventListener('scroll', function () {
                tableContainer.scrollLeft = scrollTop.scrollLeft;
            });

            tableContainer.addEventListener('scroll', function () {
                scrollTop.scrollLeft = tableContainer.scrollLeft;
            });

            syncWidths();
            window.addEventListener('resize', syncWidths);
        });
    </script>
</x-app-layout>

