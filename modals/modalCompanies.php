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
                        <div class="col-md-4">
                            <label for="nit" class="form-label">Nit</label>
                            <input type="number" class="form-control" id="nit" name="nit" min="8" required>
                        </div>
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-4">
                            <label for="selectCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="selectCategory" name="category" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="selectSubcategory" class="form-label">Subcategoria</label>
                            <select class="form-select" id="selectSubcategory" name="subcategory" required>
                                <option selected disabled value="0">Seleccionar...</option>
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