<div class="modal fade" id="modalCreateRemission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleNewContact">Remisión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="gridx2">
                            <label for="reference">Referencia</label>
                            <label for="product">Producto</label>
                            <select type="text" class="form-select selectProduct" id="reference" name="reference"></select>
                            <select type="text" class="form-select selectProduct" id="product" name="product"></select>
                        </div>

                        <div class="gridx4m mt-2">
                            <label for="quantityManufactured">Cant Fabricada</label>
                            <label for="quantityDelivered">Cant Entregada</label>
                            <label for="quantity">Cant para Entregar</label>
                            <label for=""></label>
                            <input type="number" class="form-control text-center" id="quantity" name="quantity" />
                            <input type="number" class="form-control text-center" id="quantityDelivered" name="quantityDelivered" />
                            <input type="number" class="form-control text-center" id="quantityDeliver" name="quantityDeliver" />
                            <button class="btn btn-primary" id="btnAddProductRemission">Adicionar Producto</button>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="text-center" style="color:#8DAC18">Productos Remisión</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tableProductsRemission">
                                <thead>
                                    <tr>
                                        <th class="text-center"><b>REFERENCIA</b></th>
                                        <th class="text-center"><b>DESCRIPCIÓN</b></th>
                                        <th class="text-center"><b>CANTIDAD ENTREGADA</b></th>
                                        <th class="text-center"><b>ACCIONES</b></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-1" id="btnCreateRemission">Crear Remisión</button>
            </div>
        </div>
    </div>
</div>
</div>