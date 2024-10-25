<div class="modal fade" id="modalSalesClients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formAddSaleClient" enctype="multipart/form-data" novalidate>

                        <div class="col-md-4">
                            <label for="names" class="form-label">* Nombres</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>

                        <div class="col-md-4">
                            <label for="lastnames" class="form-label"> * Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>

                        <div class="col-md-4">
                            <label for="position" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="position" name="position">
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <label for="email" class="form-label">* Email</label>
                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control email" id="email" name="email" aria-describedby="inputGroupPrepend">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="cellphone" class="form-label">Número celular</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone">
                        </div>
                        <div class="col-md-5">
                            <label for="selectCompanies" class="form-label">Nombre Empresa</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <label for="cellphone" class="form-label">Ventas</label>
                            <input type="text" class="form-control" id="sales" name="sales">
                        </div>

                        <hr>

                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit" id="btnAddSaleClient">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>