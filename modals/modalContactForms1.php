<div class="modal fade" id="modalCreateCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="form-new-user" novalidate>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="validationCustom01" name="names" required>
                            <!-- <div class="valid-feedback">Correcto!</div> -->
                            <div class="invalid-feedback">Ingrese los nombres completos</div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="validationCustom02" name="lastname" required>
                            <!-- <div class="valid-feedback">Correcto!</div> -->
                            <div class="invalid-feedback">Ingrese los apellidos completos</div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Rol</label>
                            <select class="form-select" id="validationCustom03" name="rol" required>
                                <option selected disabled value="0">Seleccionar...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Comercial</option>
                                <option value="3">Director</option>
                            </select>
                            <div class="invalid-feedback">Seleccione el Rol del nuevo Usuario</div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustomUsername" class="form-label">Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">Ingrese un Email valido.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">Password</label>
                            <input type="password" class="form-control" id="validationCustom04" min="8" name="password" required>
                            <div class="invalid-feedback">Ingrese un password de +8 caracteres</div>
                        </div>

                        <div class="col-12">
                            <!-- <button class="btn btn-primary" type="button" id="btnCreateUser">Crear Usuario</button> -->
                            <button class="btn btn-primary" type="submit" id="btnCreateCompany">Crear Empresa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>