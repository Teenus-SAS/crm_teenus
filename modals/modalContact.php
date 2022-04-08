<div class="modal fade" id="modalCreateContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleNewContact">Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewContact" novalidate>
                        <div class="col-md-4" hidden>
                            <label for="id_contact" class="form-label">id_contact</label>
                            <input type="text" class="form-control" id="id_contact" name="id_contact">
                        </div>
                        <div class="col-md-4">
                            <label for="names" class="form-label">Nombres</label>
                            <input type="text" class="form-control names" id="names" name="names" required>
                        </div>
                        <div class="col-md-4">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="col-md-4">
                            <label for="phone1" class="form-label">Teléfono 1</label>
                            <input type="text" class="form-control" id="phone1" name="phone1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="phone2" class="form-label">Teléfono 2</label>
                            <input type="text" class="form-control" id="phone2" name="phone2" required>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control email" id="email" name="email" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="position" class="form-label">Cargo</label>
                            <input type="text" class="form-control position" id="position" name="position" aria-describedby="inputGroupPrepend" required>
                        </div>
                        <div class="col-md-4">
                            <label for="companies" class="form-label">Empresa</label>
                            <select class="form-select" id="selectCompanies" name="company" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>

                        </div>
                        <div class="col-12 mt-3" style="display: flex;justify-content:end">
                            <!-- <button class="btn btn-primary" type="button" id="btnCreateUser">Crear Usuario</button> -->
                            <button class="btn btn-primary" type="submit" id="btnSaveContact">Crear Contacto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>