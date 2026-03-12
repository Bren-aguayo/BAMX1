<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
/* ===============================
   VARIABLES DE COLOR BAMX
================================ */
:root {
  --bamx-orange: #f57c00;
  --bamx-orange-dark: #ef6c00;
  --bamx-orange-soft: #fff3e0;
  --bamx-green-accent: #2bb673;
  --bamx-gray-text: #444;
}

/* ===============================
   NAVBAR BASE
================================ */
.navbar {
  background-color: #ffffff;
  padding: 0.6rem 1rem;
}

.navbar-nav {
  gap: 6px;
  align-items: center;
  flex-wrap: wrap;
}

/* ===============================
   LINKS NORMALES
================================ */
.navbar .nav-link:not(.dropdown-toggle) {
  background-color: var(--bamx-orange);
  color: #fff;
  border-radius: 10px;
  padding: 6px 14px;
  font-size: 0.88rem;
  font-weight: 500;
  transition: all 0.25s ease;
  white-space: nowrap;
}

.navbar .nav-link:not(.dropdown-toggle):hover {
  background-color: var(--bamx-orange-dark);
  transform: translateY(-1px);
}

/* ACTIVO */
.navbar .nav-link.active {
  background-color: var(--bamx-green-accent);
}

/* ===============================
   DROPDOWN TOGGLE
================================ */
.navbar .nav-link.dropdown-toggle {
  background-color: var(--bamx-orange);
  color: #fff;
  border-radius: 10px;
  padding: 6px 14px;
  font-size: 0.88rem;
  font-weight: 500;
  transition: all 0.25s ease;
}

.navbar .nav-link.dropdown-toggle:hover {
  background-color: var(--bamx-orange-dark);
}

/* ===============================
   DROPDOWN MENU
================================ */
.dropdown-menu {
  border-radius: 12px;
  border: none;
  padding: 6px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  min-width: 220px;
}

.dropdown-item {
  font-size: 0.85rem;
  padding: 8px 12px;
  border-radius: 8px;
  color: var(--bamx-gray-text);
  transition: background-color 0.2s ease;
}

.dropdown-item:hover {
  background-color: var(--bamx-orange-soft);
  color: #000;
}

/* ===============================
   AVATAR USUARIO
================================ */
.user-avatar-link {
  width: 84px;
  height: 84px;
  border-radius: 50%;
  background-color: var(--bamx-orange);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  text-decoration: none;
  transition: background-color 0.2s ease;
}

.user-avatar-link:hover {
  background-color: var(--bamx-orange-dark);
}

/* ===============================
   RESPONSIVE AJUSTES
================================ */
@media (max-width: 992px) {
  .navbar-nav {
    gap: 8px;
    margin-top: 10px;
  }
}

/* ===============================
   ICONOS EN NAV
================================ */
.nav-link i {
  margin-right: 6px;
  font-size: 0.95rem;
}

/* ===============================
   ESTADO ACTIVO (BOTONES)
================================ */
.navbar .nav-link.active,
.navbar .nav-item.show > .nav-link.dropdown-toggle {
  background-color: var(--bamx-green-accent);
  color: #fff !important;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* ===============================
   DROPDOWN ACTIVO
================================ */
.dropdown-item.active {
  background-color: var(--bamx-orange-soft);
  color: #000;
  font-weight: 600;
}

.navbar .dropdown-toggle::after {
  display: none !important;
}

/* ===============================
   HOVER UNIFICADO NAVBAR
================================ */

.navbar .nav-link:not(.dropdown-toggle):hover {
  background-color: var(--bamx-orange-dark);
  color: #fff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  transform: translateY(-2px);
}

.navbar .nav-link.dropdown-toggle:hover {
  background-color: var(--bamx-orange-dark);
  color: #fff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  transform: translateY(-2px);
}

.nav-item.dropdown:hover > .nav-link.dropdown-toggle {
  background-color: var(--bamx-orange-dark);
  color: #fff;
}
</style>

<nav class="navbar navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="../img/logo.png" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
        </a>

        <!-- Botón responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            <!-- MENÚ PRINCIPAL -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        @if(request()->routeIs('dashboard'))
                            <i class="bi bi-house-door-fill me-1"></i>
                        @endif
                        Principal
                    </a>
                </li>

                @auth

                    {{-- REGISTROS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado', 'guardia', 'despensas']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarRegistros" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarRegistros">
                                <li><a class="dropdown-item" href="{{ route('volunteers.index') }}">Ver registros</a></li>
                                <li><a class="dropdown-item" href="{{ route('volunteers.create') }}">Agregar registro</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- INGRESOS Y SALIDAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado', 'guardia', 'despensas']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarIngresoSalidas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ingresos y Salidas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarIngresoSalidas">
                                <li><a class="dropdown-item" href="{{ route('ingreso_salidas.index') }}">Ver asistencias</a></li>
                                <li><a class="dropdown-item" href="{{ route('ingreso_salidas.create') }}">Registrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('asistencias.exportar') }}">Exportar asistencias</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- ANTICIPADAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarAnticipadas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Anticipadas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarAnticipadas">
                                <li><a class="dropdown-item" href="{{ route('anticipadas.index') }}">Ver salidas anticipadas</a></li>
                                <li><a class="dropdown-item" href="{{ route('anticipadas.create') }}">Agregar salida anticipada</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- EXTRAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado', 'despensas']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarExtras" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Extras
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarExtras">
                                <li><a class="dropdown-item" href="{{ route('extras.index') }}">Ver horas extras</a></li>
                                <li><a class="dropdown-item" href="{{ route('extras.create') }}">Agregar extra</a></li>
                                <li><a class="dropdown-item" href="{{ route('extras.exportar') }}">Exportar horas extras</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- INCIDENTES --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarIncidentes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Incidentes
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarIncidentes">
                                <li><a class="dropdown-item" href="{{ route('incidentes.index') }}">Ver incidentes</a></li>
                                <li><a class="dropdown-item" href="{{ route('incidentes.create') }}">Agregar incidente</a></li>
                                <li><a class="dropdown-item" href="{{ route('incidentes.exportar') }}">Exportar incidentes</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- PERMITIDAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'encargado', 'guardia']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarPermitidas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Permitidas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarPermitidas">
                                <li><a class="dropdown-item" href="{{ route('permitidas.index') }}">Ver salidas permitidas</a></li>
                                <li><a class="dropdown-item" href="{{ route('permitidas.create') }}">Registrar salida permitida</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- ENTREGA DE DESPENSAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion', 'despensas']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDespensas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Entrega de Despensas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDespensas">
                                <li><a class="dropdown-item" href="{{ route('entregadespensas.index') }}">Ver entregas</a></li>
                                <li><a class="dropdown-item" href="{{ route('entregadespensas.create') }}">Registrar entrega</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- BAJAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarBajas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bajas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarBajas">
                                <li><a class="dropdown-item" href="{{ route('bajas.index') }}">Ver bajas</a></li>
                                <li><a class="dropdown-item" href="{{ route('bajas.create') }}">Agregar baja</a></li>
                                <li><a class="dropdown-item" href="{{ route('bajas.exportar') }}">Exportar bajas</a></li>
                            </ul>
                        </li>
                    @endif

                  


                    {{-- ÁREAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarAreas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Áreas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarAreas">
                                <li><a class="dropdown-item" href="{{ route('areas.index') }}">Ver áreas</a></li>
                                <li><a class="dropdown-item" href="{{ route('areas.create') }}">Agregar área</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- GUARDIAS --}}
                    @if(Auth::user()->tieneAlgunRol(['administracion']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarGuardias" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Guardias
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarGuardias">
                                <li><a class="dropdown-item" href="{{ route('guardias.index') }}">Ver guardias registrados</a></li>
                                <li><a class="dropdown-item" href="{{ route('guardias.create') }}">Registrar guardia</a></li>
                                <li><a class="dropdown-item" href="{{ route('entradaguardia.create') }}">Registrar entrada / salida</a></li>
                                <li><a class="dropdown-item" href="{{ route('entradaguardia.index') }}">Ver asistencias de guardias</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- USUARIOS --}}
                    @if(Auth::user()->esAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                Administrar usuarios
                            </a>
                        </li>
                    @endif

                @endauth
            </ul>

            <!-- PERFIL -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="user-avatar-link dropdown-toggle"
                           href="#"
                           id="userDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

