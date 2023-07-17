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

        let row = $(this).parent().parent()[0]
        let data = tableBillings.row(row).data();
        // let data = tableBusiness.fnGetData(row)


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

        // Agregar una nueva clase
        // inputTerm.classList.add("col-md-2");

        // Si necesitas quitar una clase
        // inputTerm.classList.remove("col-md-4");
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

    function updateTable() {
        $('#tableBillings').DataTable().clear()
        $('#tableBillings').DataTable().ajax.reload();
    }
    
});
