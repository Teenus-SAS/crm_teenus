<div class="modal fade" id="modalCreateSeller" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewSeller" enctype="multipart/form-data" novalidate>

                        <div class="col-md-4" hidden>
                            <label for="id_user" class="form-label">idUser</label>
                            <input type="text" class="form-control id_user" id="id_user" name="id_user" required>
                        </div>

                        <div class="col-md-4">
                            <label for="userName" class="form-label">* Nombres</label>
                            <input type="text" class="form-control userName" id="userName" name="names" required>
                        </div>

                        <div class="col-md-4">
                            <label for="userLastnames" class="form-label"> * Apellidos</label>
                            <input type="text" class="form-control" id="userLastnames" name="lastnames" required>
                        </div>

                        <div class="col-md-4">
                            <label for="userPosition" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="userPosition" name="position">
                        </div>

                        <?php
                        $rol = $_SESSION['rol'];
                        if ($rol == 4) {  ?>
                            <div class="col-md-4">
                                <label for="position" class="form-label">rol</label>
                                <select class="form-select rol" name="rol" id="rol"></select>
                            </div>
                            <div class="col-md-2">
                                <label for="position" class="form-label access">¿Eliminar Pedidos?</label>
                                <select class="form-select text-center access" name="accessDeletePedidos" id="accessDeletePedidos">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        <?php } ?>

                        <?php
                        $rol = $_SESSION['rol'];
                        if ($rol == 1 || $rol == 2) {  ?>
                            <div class="col-md-4" hidden>
                                <label for="position" class="form-label rols">rol</label>
                                <input type="text" class="form-control" id="rols" name="rol" required value="2" />
                            </div>
                        <?php } ?>

                        <hr>

                        <div class="col-md-4">
                            <label for="userEmail" class="form-label">* Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control userEmail" id="userEmail" name="email" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="password" class="form-label">* Password</label>
                            <input type="password" class="form-control" id="password" min="8" name="password" required>
                        </div>
                        <hr>

                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit" id="btnCreateUser">Crear Usuario</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>