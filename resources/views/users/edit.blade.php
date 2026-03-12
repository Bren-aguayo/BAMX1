<x-app-layout>
    <h2>Editar Rol de Usuario</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-floating mb-3">
            <select name="rol" class="form-control" required>
                <option value="guardia" {{ $user->rol == 'guardia' ? 'selected' : '' }}>Guardia</option>
                <option value="gerente" {{ $user->rol == 'gerente' ? 'selected' : '' }}>Gerente</option>
                <option value="administracion" {{ $user->rol == 'administracion' ? 'selected' : '' }}>Administración</option>
            </select>
            <label for="rol">Rol</label>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</x-app-layout>