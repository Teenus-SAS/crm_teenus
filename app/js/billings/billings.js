$(document).ready(function () {
    salesPhase();

   $('#btnSaveBusiness').click(function(e) {
            e.preventDefault()

       let data = $('#formNewBusiness').serialize()
       data = `${data}&billing=true`;


       $.ajax({
           type: 'POST',
           url: '/api/addBusiness',
                data: data,
                success: function(response, jqXHR, statusCode) {
                    if (response.success == true) {
                        $('#modalCreateBusiness').modal('hide')
                        updateTable()
                        toastr.success(response.message)
                    } else if (response.error == true)
                        toastr.error(response.message)
                }
            })
   })
    
    /* Actualizacion Usuario */
    $(document).on('click', '.updateBusiness', function (e) {
        e.preventDefault()

        let inputsBills = document.getElementsByClassName('inputsBill');

        while (inputsBills.length > 0) { 
            inputsBills[0].remove();   
        }
        
        
        let row = $(this).parent().parent()[0]
        let data = tableBillings.row(row).data();

        $('#id_business').val(data.id_business)
        $('#name_business').val(data.name_business)
        
        $(`#selectCompanies option:contains(${data.company})`).prop('selected', true);
        contacts(data.company, data.contact)
        
        $('#saleEstimated').val(data.estimated_sale)
        $('#selectSalesPhase').val(data.id_phase)
        $('#selectSalesPhase').change()
        $(`#selectTerm option[value='${data.term}']`).prop("selected", true);
        
        $(`#selectContact option:contains(${data.asesor})`).prop('selected', true);
        
        $('#businessObservations').val(data.observation);

        let inputTerm = document.getElementById('inputTerm');

        inputTerm.className = "col-md-2";

        inputTerm.insertAdjacentHTML('afterend',
            `<div class="col-md-2 inputsBill">
                <label for="num_bill" class="form-label">N° Factura</label>
                <input type="number" class="form-control" id="num_bill" name="num_bill" value="${data.num_bill}">
             </div>
            <div class="col-md-2 inputsBill">
                <label for="date_bill" class="form-label">Fecha de Factura</label>
                <input type="date" class="form-control" id="date_bill" name="date_bill" value="${data.date_bill}">
             </div>
             `
        );

        $('.generalInputs').prop('disabled', true);
        $('#modalCreateBusiness').modal('show')
        $('#btnSaveBusiness').html('Actualizar Proyecto')
    });

    $(document).on('click', '.payBilling', function () {
        let row = $(this).parent().parent()[0]
        let data = tableBillings.row(row).data();

        bootbox.confirm({
            title: 'Pagar',
            message:
                'Está seguro de pagar este proyecto? Esta acción no se puede reversar.',
            buttons: {
                confirm: {
                    label: 'Si',
                    className: 'btn-success',
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger',
                },
            },
            callback: function (result) {
                if (result == true) {
                    $.get(
                        `/api/changePhaseBusiness/${data.id_business}`,
                        function (data, textStatus, jqXHR) {
                            if (data.success == true) {
                                updateTable();
                                toastr.success(data.message)
                            } else if (data.error == true)
                                toastr.error(data.message)
                        }
                    );
                }
            },
        });
    });

    function updateTable() {
        $('#tableBillings').DataTable().clear()
        $('#tableBillings').DataTable().ajax.reload();
    }
    
});
