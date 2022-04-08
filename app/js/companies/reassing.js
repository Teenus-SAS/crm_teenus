/* Reasignar asesor comercial */
let id_company

$(document).on('click', '.reassignCompany', function(e) {
    id_company = this.id
    let company = $(this).parent().parent().children().eq(2).text();
    $('#nameCompany').html(company);
    $('#modalReassignSeller').modal('show')
})

$('.reassignSeller').click(function(e) {
    e.preventDefault();
    let id_seller = $('#selectSeller').val();

    $.ajax({
        url: `../../../api/reassignCompany/${id_company}/${id_seller}`,
        success: function(data) {
            if (data.success) {
                toastr.success(data.message)
                $('#modalReassignSeller').modal('hide')
                updateTable()
            }
            if (data.error)
                toastr.info(data.message)
        }
    });
});

/* Actualizar tabla */

function updateTable() {
    $('#tableCompanies').DataTable().clear()
    $('#tableCompanies').DataTable().ajax.reload()
}