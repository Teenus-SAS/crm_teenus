<div class="modal fade" id="modalCreateCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewCompany" novalidate>
                        <div class="col-md-4" hidden>
                            <label for="id" class="form-label">Id</label>
                            <input type="number" class="form-control" id="id_company" name="id_company">
                        </div>
                        <div class="col-md-2">
                            <label for="nit" class="form-label">Nit</label>
                            <input type="number" class="form-control" id="nit" name="nit" min="8" required>
                        </div>
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col-md-2">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="col-md-2">
                            <label for="city" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="selectCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="selectCategory" name="category" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="selectSubcategory" class="form-label">Subcategoria</label>
                            <select class="form-select" id="selectSubcategory" name="subcategory" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="salesCompany" class="form-label">Ventas (miles de millones)</label>
                            <select class="form-select" id="salesCompany" name="salesCompany" required>
                                <option selected disabled value="0">Seleccionar...</option>
                                <option value="Menor a 1.000">Menor a 1.000</option>
                                <option value="Entre 1.000 y 2.000">Entre 1.000 y 2.000</option>
                                <option value="Entre 2.000 y 5.000">Entre 2.000 y 5.000</option>
                                <option value="Entre 5.000 y 10.000">Entre 5.000 y 10.000</option>
                                <option value="Entre 10.000 y 20.000">Entre 10.000 y 20.000</option>
                                <option value="Mayor a 20.000">Mayor a 20.000</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3" style="display: flex;justify-content:end">
                            <!-- <button class="btn btn-primary" type="button" id="btnCreateUser">Crear Usuario</button> -->
                            <button class="btn btn-primary" type="submit" id="btnSaveCompany">Crear Empresa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>