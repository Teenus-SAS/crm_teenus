<div class="modal fade" id="modalModifyProfileUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formUpdateSeller" enctype="multipart/form-data" novalidate>

                        <div class="col-md-4">
                            <label for="names" class="form-label">* Nombres</label>
                            <input type="text" class="form-control" id="names" name="names" required>
                        </div>

                        <div class="col-md-4">
                            <label for="lastnames" class="form-label"> * Apellidos</label>
                            <input type="text" class="form-control" id="lastnames" name="lastnames" required>
                        </div>

                        <div class="col-md-4">
                            <label for="position" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="position" name="position" disabled>
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <label for="email" class="form-label">* Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control email" id="email" name="email" aria-describedby="inputGroupPrepend" disabled required>
                            </div>
                        </div>

                        <div class="col-md-4" hidden>
                            <label for="email" class="form-label">* Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control email" id="email" name="email" aria-describedby="inputGroupPrepend">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="cellphone" class="form-label">Número celular</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone">
                        </div>

                        <hr>
                        <div class="col-md-4">
                            <label for="img" class="form-label"> Ingrese su foto </label>
                            <input type="file" class="form-control" id="file1" name="file1" />
                        </div>

                        <div class="col-sm-2">
                            <img src="" id="photo" width="80%" style="border-radius: 50%;" />
                        </div>
                        <!-- <div class="col-sm-2" id="updatebox">
                            <label for="file">
                                <div class="panel updatepanel">
                                    <div class="addbox"><span class="icon-add-50"></span></div>
                                    <input type="file" id="filePhoto" style="display: none" />
                                </div>
                            </label>
                        </div> -->

                        <div class="col-md-4">
                            <label for="img" class="form-label"> Ingrese la imagen de su firma </label>
                            <input type="file" class="form-control" id="file2" name="file2" />
                        </div>

                        <div class="col-sm-2">
                            <img src="" id="signature" width="80%" style="border-radius: 50%;" />
                        </div>
                        <!-- <div class="col-sm-3" id="updatebox">
                            <label for="file">
                                <div class="panel updatepanel">
                                    <div class="addbox"><span class="icon-add-50"></span></div>
                                    <input type="fileSignature" id="fileSignature" style="display: none" />
                                </div>
                            </label>
                        </div> -->

                        <hr>

                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit" id="btnUpdateUser">Actualizar Usuario</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>