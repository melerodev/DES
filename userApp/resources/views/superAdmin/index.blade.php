@extends('layouts.app')

@section('content')
<div class="bg-white container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-black">Panel de administrador</h1>

    <!-- Botón para abrir la modal de crear usuario -->
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createUserModal">
        Crear Nuevo Usuario
    </button>

    <!-- Incluir las modales -->
    @include('modal.create')
    @include('modal.edit', ['user' => $users])

    <!-- Lista de Usuarios -->
    <div class="bg-gray-100 shadow-md rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4 text-black">Usuarios registrados</h2>

        <table class="table table-bordered table-striped-columns text-black">
            <thead>
                <tr>
                    <th class="text-center border-black">ID</th>
                    <th class="text-center border-black">Nombre</th>
                    <th class="text-center border-black">Correo</th>
                    <th class="text-center border-black">Verificado</th>
                    <th class="text-center border-black">Rol</th>
                    <th class="text-center border-black">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at ? 'SI' : 'NO' }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="text-center">
                        <div class="flex justify-center space-x-2">

                            <!-- Botón para Editar -->
                            @if ($user->role === 'superAdmin')
                            <a href="{{ route('user.index') }}" class="btn btn-warning">
                                Editar
                            </a>
                            @else<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                onclick="fillEditModal('{{ $user->id }}', '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ addslashes($user->role) }}')">
                                Editar
                            </button>
                            @endif

                            <!-- Botón para Eliminar -->
                            @if ($user->role !== 'superAdmin')
                            <button onclick="deleteUser('{{ $user->id }}')" class="btn btn-danger">
                                Eliminar
                            </button>
                            @endif

                            @if (!$user->email_verified_at)
                            <button onclick="verifyUser('{{ $user->id }}')" class="btn btn-success">
                                Verificar
                            </button>
                            @endif

                            @if ($user->email_verified_at && $user->role !== 'superAdmin')
                            <button onclick="desVerifyUser('{{ $user->id }}')" class="btn btn-info">
                                Desverificar
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
<script>
    function verifyUser(userId) {
        // Construir la URL base
        let pathName = window.location.pathname;
        let pos = pathName.indexOf('/superAdmin');
        let basePath = (pos !== -1) ? pathName.substring(0, pos) : '';
        let actionUrl = window.location.origin + basePath + '/superAdmin/verify/' + userId;
        document.getElementById('edit-user-form').action = actionUrl;
        if (confirm('¿Estás seguro de que quieres verificar este usuario?')) {
            fetch(actionUrl, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    console.log(response);
                    if (response.ok) {
                        alert('Usuario verificado correctamente.');
                        location.reload();
                    } else {
                        alert('Hubo un problema al verificar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error al verificar:', error);
                    alert('Error al intentar verificar el usuario.');
                });
        }
    }

    function desVerifyUser(userId) {
        // Construir la URL base
        let pathName = window.location.pathname;
        let pos = pathName.indexOf('/superAdmin');
        let basePath = (pos !== -1) ? pathName.substring(0, pos) : '';
        let actionUrl = window.location.origin + basePath + '/superAdmin/desVerify/' + userId;
        document.getElementById('edit-user-form').action = actionUrl;
        if (confirm('¿Estás seguro de que quieres desverificar este usuario?')) {
            fetch(actionUrl, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    console.log(response);
                    if (response.ok) {
                        alert('Usuario desverificado correctamente.');
                        location.reload();
                    } else {
                        alert('Hubo un problema al desverificar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error al desverificar:', error);
                    alert('Error al intentar desverificar el usuario.');
                });
        }
    }

    function fillEditModal(id, name, email, role) {
        const roleField = document.getElementById('edit-role');
        const emailField = document.getElementById('edit-email');
        if (role === 'superAdmin') {
            roleField.disabled = true;
            emailField.readOnly = true;
        } else {
            roleField.disabled = false;
            emailField.readOnly = false;
        }

        document.getElementById('edit-name').value = name;
        emailField.value = email;
        roleField.value = role;

        let pathName = window.location.pathname;
        let pos = pathName.indexOf('/superAdmin');
        let basePath = (pos !== -1) ? pathName.substring(0, pos) : '';
        let actionUrl = window.location.origin + basePath + '/superAdmin/edit/' + id;
        document.getElementById('edit-user-form').action = actionUrl;
    }

    function deleteUser(userId) {
        let pathName = window.location.pathname;
        let pos = pathName.indexOf('/superAdmin');
        let basePath = (pos !== -1) ? pathName.substring(0, pos) : '';
        let actionUrl = window.location.origin + basePath + '/superAdmin/delete/' + userId;
        document.getElementById('edit-user-form').action = actionUrl;
        if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
            fetch(actionUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Usuario eliminado con éxito.');
                        location.reload();
                    } else {
                        alert('Hubo un problema al eliminar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar:', error);
                    alert('Error al intentar eliminar el usuario.');
                });
        }
    }
</script>
@endsection
