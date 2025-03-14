<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Create Song</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="createTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="createTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="createArtist" class="form-label">Artist</label>
                        <input type="text" class="form-control" id="createArtist" name="artist" required>
                    </div>
                    <div class="mb-3">
                        <label for="createCategory" class="form-label">Category</label>
                        <select name="category_id" id="createCategory" class="form-select" required>
                            <option value="">Select Category</option>
                            <!-- Aquí puedes agregar las opciones de categorías dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="createImage" name="route_image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="createSong" class="form-label">Song</label>
                        <input type="file" class="form-control" id="createSong" name="route_song" accept="audio/*" required>
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalCreateWarning">An error occurred. The song has not been created.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalCreateButton">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm">
                    <div class="mb-3">
                        <label for="deleteName" class="form-label">Name</label>
                        <input readonly disabled type="text" class="form-control" id="deleteName" name="name">
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalDeleteWarning">An error ocurred. The product is still avaliable.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="editArtist" class="form-label">Artist</label>
                        <input type="text" class="form-control" id="editArtist" name="artist">
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select name="category" id="editCategory" class="form-select">
                            <option value="value1"></option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalEditWarning">An error ocurred. The product has not been edited.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalEditButton">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password">
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalViewWarning">An error ocurred. User not created.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalLoginUserButton">Login</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerModalLabel">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="registerName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="registerConfirmPassword" name="password_confirmation">
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalViewWarning">An error ocurred. User not created.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalRegisterUserButton">Register</button>
            </div> 
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewModalLabel">View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="viewForm">
                    <div class="mb-3">
                        <label for="viewId" class="form-label">ID</label>
                        <input disabled readonly type="text" class="form-control" id="viewId">
                    </div>
                    <div class="mb-3">
                        <label for="viewName" class="form-label">Name</label>
                        <input disabled readonly type="text" class="form-control" id="viewName">
                    </div>
                    <div class="mb-3">
                        <label for="viewArtist" class="form-label">Artist</label>
                        <input disabled readonly type="text" class="form-control" id="viewArtist">
                    </div>
                    <div class="mb-3">
                        <label for="viewCategory" class="form-label">Category</label>
                        <input disabled readonly type="text" class="form-control" id="viewCategory">
                    </div>
                </form>
            </div>
            <div class="alert alert-warning" role="alert" id="modalViewWarning">An error ocurred. Product not found.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>