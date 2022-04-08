<div class="modal fade" id="modalCreateBusiness" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewBusiness" novalidate>
                        <div class="col-md-12" hidden>
                            <label for="id_business" class="form-label">Proyecto</label>
                            <input type="text" class="form-control" id="id_business" name="id_business">
                        </div>
                        <div class="col-md-12">
                            <label for="name_business" class="form-label">Proyecto</label>
                            <input type="text" class="form-control" id="name_business" name="name_business" required>
                        </div>
                        <div class="col-md-5">
                            <label for="selectCompanies" class="form-label">Nombre Empresa</label>
                            <select class="form-select" id="selectCompanies" name="company" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>

                        </div>
                        <div class="col-md-5">
                            <label for="selectContact" class="form-label">Contacto</label>
                            <select class="form-select" id="selectContact" name="contact" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="saleEstimated" class="form-label">Venta Estimada</label>
                            <input class="form-control text-center number" id="saleEstimated" name="saleEstimated" required>
                            <!-- <input-mask alias="currency" class="form-control" id="saleEstimated" name="saleEstimated" required></input-mask> -->
                        </div>
                        <div class="col-md-4">
                            <label for="selectSalesPhase" class="form-label">Etapa</label>
                            <select class="form-select" id="selectSalesPhase" name="selectSalesPhase" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="percentSalesPhase" class="form-label">%</label>
                            <input type="text" class="form-control" id="percentSalesPhase" name="" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="selectTerm" class="form-label">Plazo</label>
                            <select class="form-select" id="selectTerm" name="term" required>
                                <option selected disabled value="0">Seleccionar...</option>
                                <option value="1">Corto</option>
                                <option value="2">Mediano</option>
                                <option value="3">Largo</option>
                            </select>
                        </div>
                        <?php if ($_SESSION['rol'] == 1) {  ?>
                            <hr>
                            <div class="col-md-6">
                                <label for="selectSeller" class="form-label">Asesor Comercial</label>
                                <select class="form-select selectSeller" id="selectSeller" name="seller" required>
                                    <option selected disabled value="0">Seleccionar...</option>
                                </select>
                            </div>
                            <hr>
                        <?php } ?>
                        <div class="col-md-12">
                            <label for="businessObservations" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="businessObservations" name="businessObservations"></textarea>
                        </div>

                        <div class="col-12 mt-3" style="display: flex;justify-content:end">
                            <button class="btn btn-primary" type="submit" id="btnSaveBusiness">Crear Proyecto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>