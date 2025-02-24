<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editUserModalLabel">Editar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- El formulario ahora será manejado como POST con el método PATCH -->
                <form id="edit-user-form" method="POST" action="">
                    
                    @csrf
                    @method('PATCH') 

                    <!-- Campo Nombre -->
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>

                    <!-- Campo Correo Electrónico -->
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>

                    <!-- Campo Rol -->
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Rol</label>
                        <select class="form-select" id="edit-role" name="role" required>
                            <option value="user">Usuario</option>
                            
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="edit-password" name="password">
                    </div>

                    <!-- Campo Confirmar Contraseña -->
                    <div class="mb-3">
                        <label for="edit-password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
