<div class="modal fade" id="modalCreateBudgets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" id="titleNewUser">Presupuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formBudgetSeller" novalidate>
                        <div class="col-md-4">
                            <label for="selectSeller" class="form-label">Asesor Comercial</label>
                            <select class="form-select selectSeller" name="seller" id="selectSellerBudget"></select>
                        </div>
                        <hr>
                        <div class="col-md-2">
                            <label for="year" class="form-label">Año</label>
                            <select class="form-select anio" name="year" id="year"></select>
                        </div>
                        <hr>

                        <div class="col-md-2">
                            <label for="january" class="form-label">Enero</label>
                            <input class="form-control number" id="jan" name="jan" required>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="february" class="form-label">Febrero</label>
                            <input class="form-control number" id="feb" name="feb" required>
                        </div>
                        <div class="col-md-2">
                            <label for="march" class="form-label">Marzo</label>
                            <input class="form-control number" id="mar" name="mar" required>
                        </div>

                        <div class="col-md-2">
                            <label for="april" class="form-label">Abril</label>
                            <input class="form-control number" id="apr" name="apr" required>
                        </div>
                        <div class="col-md-2">
                            <label for="may" class="form-label">Mayo</label>
                            <input class="form-control number" id="may" name="may" required>
                        </div>

                        <div class="col-md-2">
                            <label for="june" class="form-label">Junio</label>
                            <input class="form-control number" id="june" name="june" required>
                        </div>
                        <div class="col-md-2">
                            <label for="july" class="form-label">Julio</label>
                            <input class="form-control number" id="july" name="july" required>
                        </div>

                        <div class="col-md-2">
                            <label for="august" class="form-label">Agosto</label>
                            <input class="form-control number" id="aug" name="aug" required>
                        </div>
                        <div class="col-md-2">
                            <label for="september" class="form-label">Septiembre</label>
                            <input class="form-control number" id="sept" name="sept" required>
                        </div>

                        <div class="col-md-2">
                            <label for="october" class="form-label">Octubre</label>
                            <input class="form-control number" id="oct" name="oct" required>
                        </div>
                        <div class="col-md-2">
                            <label for="november" class="form-label">Noviembre</label>
                            <input class="form-control number" id="nov" name="nov" required>
                        </div>

                        <div class="col-md-2">
                            <label for="december" class="form-label">Diciembre</label>
                            <input class="form-control number" id="decem" name="decem" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="btnCreateBudget">Crear Presupuesto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>