<div class="modal fade" id="modalDataOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleNewContact"><i class="lni lni-notepad"></i>Generar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" id="formNewOrder" novalidate>
                        <div class="row g-3 condicionesComerciales">
                            <h5 style="margin-bottom: 0px;"><b>Condiciones Comerciales</b></h5>
                            <hr style="margin-bottom:0px">
                            <div class="col-md-4">
                                <label for="purchase_order" class="form-label">Orden de Compra</label>
                                <input type="text" class="form-control" id="purchase_order" name="purchase_order" />
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <label for="advance_date" class="form-label">Fecha Anticipo</label>
                                <input type="date" class="form-control" id="advance_date" name="advance_date" />
                            </div>
                            <div class="col-md-3">
                                <label for="advance_value" class="form-label">Valor Anticipo</label>
                                <input type="text" class="form-control number text-center" id="advance_value" name="advance_value" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="policy" class="form-label">No Póliza</label>
                                <input type="text" class="form-control text-center" id="policy" name="policy" />
                            </div>
                        </div>

                        <h5 style="margin-bottom: 0px;"><b>Información para la entrega</b></h4>
                            <hr style="margin-bottom:0px">

                            <div class="col-md-3">
                                <label for="date_delivery" class="form-label">Fecha de Entrega</label>
                                <input type="date" class="form-control" id="date_delivery" name="date_delivery" />
                            </div>
                            <div class="col-md-6">
                                <label for="contact_delivery" class="form-label">Contacto para la Entrega</label>
                                <input type="text" class="form-control" id="contact_delivery" name="contact_delivery" />
                            </div>
                            <div class="col-md-4">
                                <label for="address_delivery" class="form-label">Dirección de Entrega</label>
                                <input type="text" class="form-control" id="address_delivery" name="address_delivery" />
                            </div>
                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input class="form-control" type="text" name="phone" id="phone">
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Ciudad</label>
                                <input class="form-control" type="text" name="city" id="city">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="city" class="form-label">Observaciones</label>
                                <input class="form-control" type="text" name="observation" id="observation">
                            </div>

                            <div class="col-12 mt-3" style="display: flex;justify-content:end">
                                <button type="button" class="btn btn-primary mr-3" id="btnCancelOrder" data-bs-dismiss="modal" style="margin-right: 15px;">Cancelar</button>
                                <button class="btn btn-primary" type="submit" id="btnSaveOrder">Crear Pedido</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>