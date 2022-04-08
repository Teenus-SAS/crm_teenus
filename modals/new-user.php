<div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="form-new-user" novalidate>

                        <div class="col-md-4">
                            <label for="names" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="names" name="names" required>
                        </div>

                        <div class="col-md-4">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>

                        <div class="col-md-4">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option selected disabled value="0">Seleccionar...</option>
                                <option value="1">Dirección</option>
                                <option value="2">Asesor Comercial</option>
                                <option value="3">Asistente Comercial</option>
                                <option value="4">Administrador</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" min="8" name="password" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="btnCreateUser">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>