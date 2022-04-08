<div class="modal fade" id="modalCreateTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewSchedule">Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewTask" novalidate>
                        <div class="col-md-4" hidden>
                            <input id="id_schedule" name="id_schedule" class="form-label">id_schedule</input>
                        </div>

                        <div class="col-md-4">
                            <label for="selectContactForms" class="form-label">Forma de Contacto</label>
                            <select class="form-select" id="selectContactForms" name="contactForms" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                            <div class="invalid-feedback">Ingrese la forma de contacto</div>
                        </div>

                        <div class="col-md-4">
                            <label for="selectCompanies" class="form-label">Empresa</label>
                            <select class="form-select" id="selectCompanies" name="company" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                            <div class="invalid-feedback">Ingrese la forma de contacto</div>
                        </div>

                        <div class="col-md-4">
                            <label for="selectContact" class="form-label">Contacto</label>
                            <select class="form-select" id="selectContact" name="contact" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                            <div class="invalid-feedback">Ingrese la forma de contacto</div>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaAccion" class="form-label">Fecha de Acción Comercial</label>
                            <input type="date" class="form-control" id="fechaAccion" name="fechaAccion" required>
                            <div class="invalid-feedback">Ingrese la fecha</div>
                        </div>

                        <!-- <div class="col-md-4"></div> -->

                        <div class="col-md-12">
                            <label for="descriptionAction" class="form-label">Descripción Acción Comercial</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="descriptionAction" name="descriptionAction" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">Ingrese la descripcion de la actividad.</div>
                            </div>
                        </div>


                        <?php //if ($_SESSION['rol'] == 1) {  ?>
                            <!-- <hr>
                            <div class="col-md-6">
                                <label for="selectSeller" class="form-label">Asesor Comercial</label>
                                <select class="form-select selectSeller" id="selectSeller" name="seller" required>
                                    <option selected disabled value="0">Seleccionar...</option>
                                </select>
                            </div>
                            <hr> -->
                        <?php //} ?>


                        <div class="col-12">
                            <!-- <button class="btn btn-primary" type="button" id="btnCreateUser">Crear Usuario</button> -->
                            <button class="btn btn-primary" type="submit" id="btnCreateTask">Crear Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>