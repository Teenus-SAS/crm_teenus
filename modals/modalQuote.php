<div class="modal fade" id="modalCreateQuote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleNewContact"><i class="lni lni-notepad"></i> Nueva Cotización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewQuote" novalidate>
                        <div class="col-md-4" hidden>
                            <label for="id_quote" class="form-label">id_quote</label>
                            <input type="text" class="form-control" id="id_quote" name="id_quote">
                        </div>
                        <h5 style="margin-bottom: 0px;"><b>Cliente</b></h5>
                        <hr style="margin-bottom:0px">
                        <div class="col-md-4">
                            <label for="selectCompanies" class="form-label">Empresa</label>

                            <select class="form-select" id="selectCompanies" name="company" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="selectContact" class="form-label">Contacto</label>
                            <select class="form-select" id="selectContact" name="contact" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>
                        <hr style="margin-bottom:0px">
                        <h5 style="margin-bottom: 0px;"><b>Proyecto</b></h5>
                        <hr style="margin-bottom:0px">
                        <div class="col-md-4">
                            <select class="form-select" id="selectBusiness" name="business" required>
                                <option selected disabled value="0">Seleccionar...</option>
                            </select>
                        </div>

                        <hr style="margin-bottom:0px">
                        <h5 style="margin-bottom: 0px;"><b>Condiciones Comerciales</b></h5>
                        <hr style="margin-bottom:0px">
                        <div class="col-md-3">
                            <label for="selectPaymentMethods" class="form-label">Condiciones de Pago</label>
                            <select class="form-select" name="selectPaymentMethods" id="selectPaymentMethods"></select>
                            <!-- <input type="text" class="form-control" name="payment_conditions" id="payment_conditions"> -->
                        </div>
                        <div class="col-md-3">
                            <label for="time_quote" class="form-label">Validez de la Oferta</label>
                            <input type="text" class="form-control" name="time_quote" id="time_quote">
                        </div>
                        <div class="col-md-3">
                            <label for="guarantee" class="form-label">Garantia del Producto</label>
                            <input type="text" class="form-control" name="guarantee" id="guarantee">
                        </div>
                        <div class="col-md-3">
                            <label for="delivery_date" class="form-label">Fecha de Entrega</label>
                            <input type="date" class="form-control" name="delivery_date" id="delivery_date">
                        </div>

                        <hr style="margin-bottom:0px">
                        <h5 style="margin-bottom: 0px;"><b>Productos</b></h5>
                        <!-- <hr style="margin-bottom:0px"> -->
                        <!--<div>
                            <button class="btn btn-primary" id="btnAddNewProduct">Seleccionar Productos</button>
                        </div>-->

                        
                            <div class="col-md-3 mt-1">
                                <label for="selectProducts" class="form-label">Producto</label>
                                <input class="form-control text-center" type="text" name="product" id="products">

                            </div>

                            <div class="col-md-3 mt-1">
                                <label for="prices" class="form-label">Precio</label>
                                <input class="form-control text-center" type="text" name="price" id="price">
                            </div>


                        
                        <div class="mb-3">
                            <button class="btn btn-primary mt-3" id="btnAddProduct">Adicionar producto</button>
                        </div>
                        <hr />

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tableProductsQuote" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3" style="display: flex;justify-content:end">
                            <button class="btn btn-primary" type="submit" id="btnSaveQuote">Crear Cotización</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>